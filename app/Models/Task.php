<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['cause_id', 'description', 'responsible', 'deadline', 'date_realization', 'status'];
    /**
     * Relations with cause
     */
    public function cause()
    {
        return $this->belongsTo(Cause::class);
    }
}
