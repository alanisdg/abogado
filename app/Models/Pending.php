<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    protected $fillable = [
        'interview_date',
        'second_date',
        'rut',
        'email',
        'names',
        'surnames',
        'balance_dd',
        'phone',
        'creditor_1',
        'creditor_balance_1',
        'creditor_2',
        'creditor_balance_2',
        'heritage',
        'active_demand',
        'active_demands',
        'demand_1',
        'state_1',
        'demand_2',
        'state_2',
        'status',
        'civil_status',
        'profession',
        'nationality',
        'commune',
        'region',
        'address',
        'home_phone'
    ];
}
