<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskSubtask;
use Illuminate\Http\Request;

class TaskSubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Task $task)
    {
        $subtasks = TaskSubtask::where('task_id',$task->id)->get();
        
        return view('task.subtask.index',compact('subtasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function delete(TaskSubtask $subtask)
    {
        $subtask->delete();

        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        TaskSubtask::create([
            'title' =>$request->title,
            'task_id' =>$request->task_id
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskSubtask $taskSubtask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskSubtask $taskSubtask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskSubtask $taskSubtask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskSubtask $taskSubtask)
    {
        //
    }
}
