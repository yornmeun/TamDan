<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = 'invoice_items';
    protected $fillable = [
        'invoice_id',
        'name',
        'description',
        'qty',
        'price',
        'deleted_at',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
