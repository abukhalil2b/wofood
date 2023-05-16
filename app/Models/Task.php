<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function assignfor()
    {
       return $this->belongsTo(User::class,'assign_for_id');
    }
 
    public function assignby()
    {
       return $this->belongsTo(User::class,'assign_by_id');
    }
}
