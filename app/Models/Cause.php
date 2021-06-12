<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    /**
     * Relations with contracts
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
