<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function taskcats()
    {
        return $this->hasMany(Taskcat::class);
    }
}
