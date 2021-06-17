<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
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
    public function cause()
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
}
