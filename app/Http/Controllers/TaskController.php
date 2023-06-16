<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Day;
use App\Models\TaskAttachment;
use App\Models\TaskSubtask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{


    /**
     * title - group_id - assign_for_id - assign_by_id - day_id - start_at - end_at - done_at	consent	note
     */
    public function forMeStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'taskcat_id'=>'required'
        ]);

        $loggedUser = auth()->user();

        Task::create([
            'title' => $request->title,
            'group_id' => $loggedUser->group_id,
            'assign_for_id' => $loggedUser->id,
            'day_id' => $request->day_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'taskcat_id' => $request->taskcat_id,
        ]);

        return back();
    }


    public function forMyTeamStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'day_id' => 'required',
            'user_id' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'taskcat_id'=>'required'
        ]);

        $loggedUser = auth()->user();

        Task::create([
            'group_id'       => $loggedUser->group_id,
            'assign_by_id'   => $loggedUser->id,
            'title'          => $request->title,
            'assign_for_id'  => $request->user_id,
            'day_id'         => $request->day_id,
            'start_at'       => $request->start_at,
            'end_at'         => $request->end_at,
            'taskcat_id' => $request->taskcat_id,
        ]);

        return back();;
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {

        return view('task.show', compact('task'));
    }

    public function userDayIndex(User $user)
    {
        $days = Day::withCount([
            'tasks' => function ($task) use ($user) {
                $task->where('assign_for_id', $user->id);
            },
            'taskAttachments' => function ($taskAttachment) use ($user) {
                $taskAttachment->where('assign_for_id', $user->id);
            },
            'taskSubtasks' => function ($taskSubtask) use ($user) {
                $taskSubtask->where('assign_for_id', $user->id);
            }
        ])
        ->whereActive(1)
        ->get();

        return view('user.day.index', compact('user', 'days'));
    }

    public function userDayShow(User $user, Day $day)
    {
        $tasks = Task::where([
            'assign_for_id' => $user->id,
            'day_id' => $day->id
        ])->get();

        return view('user.day.show', compact('tasks', 'user', 'day'));
    }


    public function edit(Task $task,Day $day)
    {
        return view('task.edit', compact('task','day'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {

        $task->update([
            'title' => $request->title,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);

        return redirect()->route('day.show',$request->day_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Task $task,Day $day)
    {

        $loggedUser = auth()->user();

        if ($loggedUser->id == $task->assign_for_id) {

            $task->delete();
            
             //delete attachment
             $taskAttachment = TaskAttachment::where('task_id',$task->id)->first();

            if($taskAttachment){
                Storage::delete($taskAttachment->url);
                $taskAttachment->delete();
            }
           
            //delete subtask
            TaskSubtask::where('task_id',$task->id)->delete();

            
        } elseif ($loggedUser->user_type == 'admin' || $loggedUser->user_type == 'super_admin') {

            $task->delete();

            //delete attachment
            $taskAttachment = TaskAttachment::where('task_id',$task->id)->first();
            
            if($taskAttachment){
                Storage::delete($taskAttachment->url);
                $taskAttachment->delete();
            }

            //delete subtask
            TaskSubtask::where('task_id',$task->id)->delete();
        }
return back();
        // return redirect()->route('day.show',$day->id);
    }
}
