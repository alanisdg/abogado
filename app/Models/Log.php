<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "action","target_id","contract_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->belongsTo(Pending::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
