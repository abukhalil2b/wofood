<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   protected $guarded = [];

   public function group()
   {
      return $this->belongsTo(Group::class);
   }

   public function assignfor()
   {
      return $this->belongsTo(User::class, 'assign_for_id');
   }

   public function assignby()
   {
      return $this->belongsTo(User::class, 'assign_by_id');
   }

   public function day()
   {
      return $this->belongsTo(Day::class);
   }

   public function taskAttachments()
   {
      return $this->hasMany(TaskAttachment::class);
   }

   public function taskSubtasks()
   {
      return $this->hasMany(TaskSubtask::class);
   }

   
}
