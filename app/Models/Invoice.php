<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'project_id',
        'invoice_number',
        'total',
        'paid_amount',
        'due_amount',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
