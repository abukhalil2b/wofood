<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Taskcat;
use Illuminate\Http\Request;

class TaskcatController extends Controller
{
    public function index(Group $group)
    {
        $taskcats = Taskcat::where('group_id',$group->id)->get();

        return view('super_admin.group.taskcat.index',compact('taskcats','group'));
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
        
        $request->validate([
            'title' => 'required',
            'group_id' => 'required'
        ]);

        Taskcat::create([
            'title' => $request->title,
            'group_id' => $request->group_id
        ]);

        return back();

    }


    /**
     * Display the specified resource.
     */
    public function show(Taskcat $taskcat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Taskcat $taskcat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Taskcat $taskcat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Taskcat $taskcat)
    {
        //
    }
}
