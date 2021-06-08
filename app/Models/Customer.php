<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $fillable = ["rut", "first_name", "last_name", "address", "phone", "email"];
}
