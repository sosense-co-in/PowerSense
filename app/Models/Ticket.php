<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'subject',
        'content',
        'priority_id',
        'tkt_category_id', // Use 'tkt_category_id' as per your database schema
        'status_id',
        'user_id',
        'agent_id',
    ];

    /**
     * Relationships
     */

    // Priority of the ticket
    public function priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    // Status of the ticket
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // Category of the ticket
    public function category()
    {
        return $this->belongsTo(TktCategory::class, 'tkt_category_id');
    }

    // The user who created the ticket
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // The agent assigned to the ticket
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
