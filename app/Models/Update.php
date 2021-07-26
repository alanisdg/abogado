<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    protected $fillable = [
        'contract_id',
        'type',
        // Change creditor
        'creditor_id',
        // Account holder change
        'customer_id',
        'holder_amount',
        // Change strategy
        'contract_amount',
        'number_installments',
        'amount_fees',
        'payment_date_installment',
        // Change payment date
        'change_payment_date',
        // Deceased
        'deceased_new_payment_amount',
        'deceased_amount_fees',
        'deceased_quota_amount',
        'deceased_new_payment_date',
        // General
        'observations'
    ];

    /**
     * Relations with contract
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Relations with cutomers
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relatiosn with
     */
    public function creditor()
    {
        return $this->belongsTo(Creditor::class);
    }
}
