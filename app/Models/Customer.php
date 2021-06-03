<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['dni', 'name', 'surname', 'email', 'phone', 'address', 'status'];
}
