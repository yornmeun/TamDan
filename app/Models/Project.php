<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'client_id',
        'quotation_id',
        'title',
        'description',
        'status',
        'start_date',
        'due_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getProgressAttribute(): int
    {
        $total = $this->tasks()->count();

        if ($total === 0) {
            return 0;
        }

        $completed = $this->tasks()
            ->where('status', 'done')
            ->count();

        return (int) round(($completed / $total) * 100);
    }

    public function getProjectStatusAttribute(?string $status): string
    {
        return match ($status) {
            'not_started' => __('project.status_not_started'),
            'in_progress' => __('project.status_in_progress'),
            'completed' => __('project.status_completed'),
            'on_hold' => __('project.status_on_hold'),
            'cancelled' => __('project.status_cancelled'),          
        };
    }

    public function getStatusColorAttribute(?string $status): string
    {
        return match ($status) {
            'not_started' => 'bg-gray-100 text-gray-600',
            'in_progress' => 'bg-indigo-100 text-indigo-600',
            'completed' => 'bg-green-100 text-green-600',
            'on_hold' => 'bg-yellow-100 text-yellow-600',
            'cancelled' => 'bg-red-100 text-red-600',
            default => 'bg-gray-100 text-gray-600',
        };
    }
}
