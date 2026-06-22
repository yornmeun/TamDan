<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceItem;

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
        'user_id',
        'tax',
        'discount',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
