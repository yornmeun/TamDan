<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Task;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class DashboardWidget extends StatsOverviewWidget
{
    // protected ?string $heading = 'Business Summary';

    protected int | string | array $columnSpan = 'full';

    // protected ?string $description = 'At-a-glance totals for your clients, projects, quotations, invoices, and tasks.';

    protected function getStats(): array
    {
        $clientQuery = $this->getClientQuery();
        $projectQuery = $this->getProjectQuery();
        $quotationQuery = $this->getQuotationQuery();
        $invoiceQuery = $this->getInvoiceQuery();
        $taskQuery = $this->getTaskQuery();

        return [
            Stat::make(__('client.client'), $clientQuery->count())
                ->description(__('client.client_total'))
                ->icon(Heroicon::UserGroup)
                ->url(route('filament.admin.resources.clients.index'))
                ->color('primary'),
            Stat::make(__('project.project'), $projectQuery->count())
                ->description(__('project.project_total'))
                ->icon(Heroicon::OutlinedClipboardDocumentList)
                ->url(route('filament.admin.resources.projects.index'))
                ->color('success'),
            Stat::make(__('quotation.quotation'), $quotationQuery->count())
                ->url(route('filament.admin.resources.quotations.index'))
                ->description(__('quotation.quotation_total'))
                ->icon(Heroicon::OutlinedClipboard)
                ->color('warning'),
            Stat::make(__('invoice.invoice'), $invoiceQuery->count())
                ->url(route('filament.admin.resources.invoices.index'))
                ->description(__('invoice.invoice_total'))
                ->icon(Heroicon::OutlinedCurrencyDollar)
                ->color('secondary'),
            Stat::make(__('invoice.invoice_overdue'), $invoiceQuery->where('status', 'overdue')->count())
                ->description(__('invoice.invoice_overdue'))
                ->url(route('filament.admin.resources.invoices.index',  [
                    'filters[status][value]' => 'overdue',
                ]))
                ->icon(Heroicon::OutlinedClock)
                ->color('danger'),
            // Stat::make('Tasks', $taskQuery->count())
            //     ->description('Open tasks')
            //     ->icon(Heroicon::OutlinedRectangleStack)
            //     ->color('info'),
        ];
    }

    protected function getClientQuery(): Builder
    {
        $query = Client::query();

        if (! $this->isSuperAdmin() && $userId = $this->getCurrentUserId()) {
            $query->where('user_id', $userId);
        }

        return $query;
    }

    protected function getProjectQuery(): Builder
    {
        $query = Project::query();

        if (! $this->isSuperAdmin() && $userId = $this->getCurrentUserId()) {
            $query->whereHas('client', fn (Builder $query) =>
                $query->where('user_id', $userId)
            );
        }

        return $query;
    }

    protected function getQuotationQuery(): Builder
    {
        $query = Quotation::query();

        if (! $this->isSuperAdmin() && $userId = $this->getCurrentUserId()) {
            $query->whereHas('client', fn (Builder $query) =>
                $query->where('user_id', $userId)
            );
        }

        return $query;
    }

    protected function getInvoiceQuery(): Builder
    {
        $query = Invoice::query();

        if (! $this->isSuperAdmin() && $userId = $this->getCurrentUserId()) {
            $query->whereHas('project.client', fn (Builder $query) =>
                $query->where('user_id', $userId)
            );
        }

        return $query;
    }

    protected function getTaskQuery(): Builder
    {
        $query = Task::query();

        if (! $this->isSuperAdmin() && $userId = $this->getCurrentUserId()) {
            $query->where('assigned_to', $userId);
        }

        return $query;
    }

    protected function getCurrentUserId(): ?int
    {
        return auth()->id();
    }

    protected function isSuperAdmin(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }
}
