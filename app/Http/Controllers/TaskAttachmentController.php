<?php

namespace App\Http\Controllers;

use App\Models\TaskAttachment;
use Illuminate\Http\Request;

class TaskAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        if ($request->hasFile('attachment')) {

            $filename = time() . '.' . $request->attachment->getClientOriginalExtension();

            $fileUrl = $request->file('attachment')->storeAs('attachment/' . $request->task_id, $filename);

            TaskAttachment::create([
                'title' => $request->title,
                'url' => $fileUrl,
                'task_id' => $request->task_id
            ]);

            return back()->with(['status' => 'success', 'message' => 'تم']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskAttachment $taskAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskAttachment $taskAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskAttachment $taskAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskAttachment $taskAttachment)
    {
        //
    }
}
