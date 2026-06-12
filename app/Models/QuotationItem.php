<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    protected $table = 'quotation_items';

    protected $fillable = [
        'quotation_id',
        'name',
        'description',
        'qty',
        'price',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
