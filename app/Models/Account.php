<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'fax_no', 'email', 'website', 'type', 'industry', 'no_of_emp', 'sales_turnover', 'desc', 'ship_addr', 'ship_city', 'ship_state', 'ship_country', 'ship_zip', 'bill_addr', 'bill_city', 'bill_state', 'bill_country', 'bill_zip', 'created_by', 'updated_by'];
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'modified_by'); // Adjust field name if necessary
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id'); // Assumes 'owner_id' in accounts table links to users
    }
}
