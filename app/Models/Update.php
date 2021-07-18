<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    protected $fillable = [
        'contract_id',
        'type',
        'current_creditor',
        'new_creditor',
        'new_headline',
        'new_headline_rut',
        'observations'
    ];

    /**
     * Relations with contract
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
