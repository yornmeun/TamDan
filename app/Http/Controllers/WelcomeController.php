<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Task;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $totalRevenue = (float) Invoice::query()->sum('paid_amount');
        $activeProjects = Project::query()
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->count();

        $latestPayment = Invoice::query()
            ->where('paid_amount', '>', 0)
            ->latest('updated_at')
            ->first();

        $monthlyRevenue = $this->getMonthlyRevenue();
        $maxMonthlyRevenue = max(array_column($monthlyRevenue, 'total')) ?: 1;

        $recentClients = Client::query()
            ->latest()
            ->limit(3)
            ->get(['id', 'name', 'company_name']);

        $clientCount = Client::count();
        $completedProjects = Project::query()->where('status', 'completed')->count();
        $quotationCount = Quotation::count();

        return view('welcome', [
            'stats' => [
                'clients' => $clientCount,
                'users' => User::count(),
                'projects' => Project::count(),
                'activeProjects' => $activeProjects,
                'completedProjects' => $completedProjects,
                'quotations' => $quotationCount,
                'invoices' => Invoice::count(),
                'tasks' => Task::count(),
                'totalRevenue' => $totalRevenue,
                'totalInvoiced' => (float) Invoice::query()->sum('total'),
                'overdueInvoices' => Invoice::query()->where('status', 'overdue')->count(),
            ],
            'formatted' => [
                'totalRevenue' => $this->formatMoney($totalRevenue),
                'totalRevenueCompact' => $this->formatMoneyCompact($totalRevenue),
                'latestPayment' => $this->formatMoney($latestPayment?->paid_amount ?? 0),
                'clients' => $this->formatCount($clientCount),
                'completedProjects' => $this->formatCount($completedProjects),
                'quotations' => $this->formatCount($quotationCount),
            ],
            'hero' => [
                'managedRevenue' => $totalRevenue,
                'activeProjects' => $activeProjects,
                'latestPayment' => $latestPayment?->paid_amount ?? 0,
            ],
            'monthlyRevenue' => $monthlyRevenue,
            'maxMonthlyRevenue' => $maxMonthlyRevenue,
            'recentClients' => $recentClients,
            'features' => $this->getFeatures(),
            'plans' => $this->getPlans(),
        ]);
    }

    protected function getMonthlyRevenue(int $months = 5): array
    {
        $results = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $total = (float) Invoice::query()
                ->whereYear('updated_at', $date->year)
                ->whereMonth('updated_at', $date->month)
                ->sum('paid_amount');

            $results[] = [
                'label' => $date->format('M'),
                'total' => $total,
            ];
        }

        return $results;
    }

    protected function getFeatures(): array
    {
        return [
            [
                'icon' => 'groups',
                'title' => 'Client Management',
                'description' => 'Centralize client profiles, contact details, and notes. Track every relationship from first contact through delivery.',
                'count' => Client::count(),
                'countLabel' => 'clients',
            ],
            [
                'icon' => 'view_kanban',
                'title' => 'Task Tracking',
                'description' => 'Break projects into assignable tasks with due dates and status tracking so your team always knows what is next.',
                'count' => Task::count(),
                'countLabel' => 'tasks',
            ],
            [
                'icon' => 'description',
                'title' => 'Quotation Engine',
                'description' => 'Build itemized quotations, send proposals, and convert accepted quotes into projects without re-entering data.',
                'count' => Quotation::count(),
                'countLabel' => 'quotations',
            ],
            [
                'icon' => 'credit_card',
                'title' => 'Smart Invoicing',
                'description' => 'Generate invoices from projects, track paid and due amounts, and monitor overdue billing in one place.',
                'count' => Invoice::count(),
                'countLabel' => 'invoices',
            ],
            [
                'icon' => 'payments',
                'title' => 'Revenue Tracking',
                'description' => 'See collected revenue across all invoices and keep a clear picture of what has been paid versus what is outstanding.',
                'count' => Invoice::query()->where('paid_amount', '>', 0)->count(),
                'countLabel' => 'payments recorded',
            ],
            [
                'icon' => 'bar_chart',
                'title' => 'Business Dashboard',
                'description' => 'Monitor clients, projects, quotations, and invoices from a unified admin dashboard built for service businesses.',
                'count' => Project::count(),
                'countLabel' => 'projects',
            ],
        ];
    }

    protected function getPlans(): array
    {
        return collect(config('plans.plans', []))
            ->map(function (array $plan) {
                $plan['price_label'] = $plan['price'] === 0
                    ? '$0'
                    : '$'.number_format($plan['price']);

                return $plan;
            })
            ->all();
    }

    protected function formatMoney(float $amount): string
    {
        return '$'.number_format($amount, 2);
    }

    protected function formatMoneyCompact(float $amount): string
    {
        if ($amount >= 1_000_000) {
            return '$'.rtrim(rtrim(number_format($amount / 1_000_000, 1), '0'), '.').'M+';
        }

        if ($amount >= 1_000) {
            return '$'.rtrim(rtrim(number_format($amount / 1_000, 1), '0'), '.').'k+';
        }

        return '$'.number_format($amount, 0);
    }

    protected function formatCount(int $count): string
    {
        if ($count >= 1_000_000) {
            return rtrim(rtrim(number_format($count / 1_000_000, 1), '0'), '.').'M+';
        }

        if ($count >= 1_000) {
            return rtrim(rtrim(number_format($count / 1_000, 1), '0'), '.').'k+';
        }

        return (string) $count;
    }
}
