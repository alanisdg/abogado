<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    protected $fillable = ['contract_id', 'number_rit', 'court', 'matter', 'status','percent'];
    /**
     * Relations with contracts
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    /**
     * Relations with task
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
