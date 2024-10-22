<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmcContract extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(ContractItems::class, 'contract_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
