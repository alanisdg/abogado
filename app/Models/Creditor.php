<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    protected $fillable = ['contract_id', 'name', 'creditor_amount', 'registration_date'];

    /**
     * Relations with contracts
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
