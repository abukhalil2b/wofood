<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{


    /**
     * title	group_id	assign_for_id	assign_by_id	day_id	start_at	end_at	done_at	consent	note
     */
    public function forMeStore(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $loggedUser = auth()->user();

        Task::create([
            'title' => $request->title,
            'group_id' => $loggedUser->group_id,
            'assign_for_id' => $loggedUser->id,
            'day_id' => $request->day_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return back();
    }


    public function forMyTeamStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'day_id' => 'required',
            'user_id' => 'required',
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
            'tasks' => function ($task) use($user){
                $task->where('assign_for_id', $user->id);
            },
            'taskAttachments' => function ($taskAttachment) use($user){
                $taskAttachment->where('assign_for_id', $user->id);
            }
            ,
            'taskSubtasks' => function ($taskSubtask) use($user){
                $taskSubtask->where('assign_for_id', $user->id);
            }
        ])->get();
        
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


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Task $task)
    {

        $loggedUser = auth()->user();

        if ($loggedUser->id == $task->assign_for_id) {

            $task->delete();
        } elseif ($loggedUser->user_type == 'admin') {

            $task->delete();
        }

        return redirect()->route('dashboard');
    }
}
