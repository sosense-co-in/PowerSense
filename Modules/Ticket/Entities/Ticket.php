<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'customer_id',
        'assigned_to',
    ];

    public function customer() {
        return $this->belongsTo(\App\Models\User::class, 'customer_id');
    }

    public function assignee() {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }
}
