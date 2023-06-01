<?php

namespace App\Http\Controllers\api;

use App\Models\TaskSubtask;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskSubtaskController extends Controller
{
    public function store(Request $request)
    {
        return TaskSubtask::create([
            'title' =>$request->title,
            'task_id' =>$request->task_id
        ]);
    }
}
