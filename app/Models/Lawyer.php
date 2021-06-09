<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    protected $table = "lawyers";
    protected $fillable = ["lawyer_rut", "lawyer_first_name", "lawyer_last_name", "charge"];
}
