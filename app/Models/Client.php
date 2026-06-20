<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $fillable = [
        'name',
        'company_name',
        'phone',
        'email',
        'address',
        'notes',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function invoices(): HasManyThrough
    {
        return $this->hasManyThrough(
            Invoice::class,
            Project::class,
            'client_id',   // Foreign key on projects table
            'project_id',  // Foreign key on invoices table
            'id',          // Local key on clients table
            'id'           // Local key on projects table
        );
    }
}
