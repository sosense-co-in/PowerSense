<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'fax_no',
        'email',
        'website',
        'type',
        'industry',
        'no_of_emp',
        'sales_turnover',
        'desc',
        'ship_addr',
        'ship_city',
        'ship_state',
        'ship_country',
        'ship_zip',
        'bill_addr',
        'bill_city',
        'bill_state',
        'bill_country',
        'bill_zip',
        'created_by',
        'updated_by',
    ];

    // Define relationships here if needed
}
