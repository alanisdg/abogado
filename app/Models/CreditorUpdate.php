<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditorUpdate extends Model
{
    protected $fillable = ['update_id', "current_creditor", "new_creditor", "observations"];

    public function updates()
    {
        return $this->belongsTo(Update::class);
    }
}
