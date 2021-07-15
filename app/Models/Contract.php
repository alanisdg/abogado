<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    // Status: 1 -> , 2 -> Settled (Finiquitado)
    protected $fillable =
        [
            'number_contract',
            'annex_code',
            'update_code',
            'user_id',
            'type_contract',
            'customer_id',
            'contract_date',
            'total_contract',
            'status',
            'first_installment_payment_date',
            'number_installments',
            'amount_fees',
            'first_payment_amount'
        ];
    /**
     * Relations with user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Relations with customers
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    /**
     * Relations with causes
     */
    public function causes()
    {
        return $this->hasMany(Cause::class, 'contract_id');
    }

    /**
     * Relations with collections
     */
    public function collections()
    {
        return $this->hasMany(Collection::class, 'contract_id');
    }

    /**
     * Updates
     */
    public function updates()
    {
        return $this->hasMany(Contract::class);
    }
}
