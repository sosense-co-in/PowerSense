<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractItems extends Model
{
    use HasFactory;
    public function contract()
    {
        return $this->belongsTo(AmcContract::class, 'contract_id');
    }
}
