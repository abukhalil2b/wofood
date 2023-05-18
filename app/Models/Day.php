<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Day extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function taskAttachments(): HasManyThrough
    {
        return $this->hasManyThrough(TaskAttachment::class, Task::class);
    }

    public function taskSubtasks(): HasManyThrough
    {
        return $this->hasManyThrough(TaskSubtask::class, Task::class);
    }
}
