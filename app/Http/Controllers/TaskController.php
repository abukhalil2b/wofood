<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
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
     * title	expected_duration	group_id	assign_for_id	assign_by_id	due_date	started_at	done_at	consent	note
     */
    public function forMeStore(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $loggedUser = auth()->user();

        if (!$request->due_date) {

            $request['due_date'] = Carbon::now()->format('Y-m-d');
        }


        Task::create([
            'title' => $request->title,
            'expected_duration' => $request->expected_duration,
            'due_date' => $request->due_date,
            'group_id' => $loggedUser->group_id,
            'assign_for_id' => $loggedUser->id,
        ]);

        return back();
    }


    public function forMyTeamStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'assign_for_id' => 'required'
        ]);

        $loggedUser = auth()->user();

        Task::create([
            'title' => $request->title,
            'expected_duration' => $request->expected_duration,
            'due_date' => $request->due_date,
            'group_id' => $loggedUser->group_id,
            'assign_for_id' => $request->assign_for_id,
            'assign_by_id' => $loggedUser->id,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }


    public function userTaskIndex($userId)
    {
        $loggedUser = auth()->user();

        //[x] super user can see any other user
        if ($loggedUser->id == 1) {

            $user = User::findOrFail($userId);

        } else {
            $user = User::where(['id' => $userId, 'group_id' => $loggedUser->group_id])->first();

            if (!$user) {
                abort(404);
            }
        }


        $today = Carbon::today()->format('Y-m-d');

        $totalTasks = Task::where('assign_for_id', $user->id)
            ->get();

        $todayTasks = Task::where('assign_for_id', $user->id)
            ->whereDate('due_date', '=', $today)
            ->get();

        $prevTasks = Task::where('assign_for_id', $user->id)
            ->whereDate('due_date', '<', $today)
            ->get();

        $nextTasks = Task::where('assign_for_id', $user->id)
            ->whereDate('due_date', '>', $today)
            ->get();



        return view('user.task.index', compact('user', 'totalTasks', 'todayTasks', 'prevTasks', 'nextTasks'));
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
