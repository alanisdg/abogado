<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ["contract_id", "installment_number", "payment_date", "amount", "status"];
    /**
     * Relations with contract
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
