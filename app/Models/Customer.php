<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $fillable = [
        "rut",
        "customer",
        "civil_status",
        "profession",
        "nationality",
        "commune",
        "region",
        "address",
        "phone",
        "home_phone",
        "email"
    ];
    /**
     * Relations with contracts
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'customer_id');
    }
}
