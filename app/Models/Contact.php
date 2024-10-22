<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'account_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the account that owns the contact.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the user that created the contact.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that updated the contact.
     */
    public function modefied_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Add any additional relationships or methods as needed
}
