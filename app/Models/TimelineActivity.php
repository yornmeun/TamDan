<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineActivity extends Model
{
    protected $table = 'timeline_activities';

    protected $fillable = [
        'client_id',
        'type',
        'description',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
