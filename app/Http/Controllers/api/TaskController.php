<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Day;
use App\Models\TaskAttachment;
use App\Models\TaskSubtask;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * title	group_id	assign_for_id	day_id	start_at	end_at	done_at	consent	note
     */
    public function forMeStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ]);

        $loggedUser = auth()->user();

        $task = Task::create([
            'title' => $request->title,
            'group_id' => $loggedUser->group_id,
            'assign_for_id' => $loggedUser->id,
            'day_id' => $request->day_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return response($task, 201);
    }

    public function forMeUpdate(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ]);

        $loggedUser = auth()->user();

        if ($task->assign_for_id == $loggedUser->id) {

            $task->update([
                'title' => $request->title,
                'day_id' => $request->day_id,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
            ]);

            return response(['message' => 'تم التحديث'], 200);
        }

        return response(['message' => 'لا تملك الصلاحية'], 403);
    }

    public function forMeDelete(Task $task)
    {

        $loggedUser = auth()->user();

        if ($task->assign_for_id == $loggedUser->id) {

            $task->delete();

            return response(['message' => 'تم الحذف'], 200);
        }

        return response(['message' => 'لا تملك الصلاحية'], 403);
    }


    /**
     * title	group_id	assign_for_id	assign_by_id	day_id	start_at	end_at	done_at	consent	note
     */
    public function forMyTeamStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'day_id' => 'required',
            'user_id' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ]);

        $loggedUser = auth()->user();

        $task = Task::create([
            'group_id'       => $loggedUser->group_id,
            'assign_by_id'   => $loggedUser->id,
            'title'          => $request->title,
            'assign_for_id'  => $request->user_id,
            'day_id'         => $request->day_id,
            'start_at'       => $request->start_at,
            'end_at'         => $request->end_at,
        ]);

        return response($task, 201);
    }

    /**
     * admin - super_admin
     */
    public function todayTasks()
    {
        $loggedUser = auth()->user();

        $todayDate = date('Y-m-d');

        $todayDay = Day::whereDate('en_date', $todayDate)->first();

        if ($loggedUser->user_type == 'admin') {

            $groupId = $loggedUser->group_id;

            $todayTasks = DB::table('tasks')
                ->select(
                    'tasks.title as taskTitle',
                    'tasks.start_at as taskStartAt',
                    'tasks.end_at as taskEndAt',
                    'tasks.done_at as taskDoneAt',
                    'days.title as dayTitle',
                    'days.ar_date as arDate',
                    'days.en_date as enDate',
                    'groups.title as groupTitle',
                    'assignBy.name as assignByName',
                    'assignFor.name as assignForName',
                    'assignFor.phone as phone',
                    'assignFor.user_type as userType',
                )
                ->join('days', 'tasks.day_id', 'days.id')
                ->leftJoin('users as assignFor', 'tasks.assign_for_id', 'assignFor.id')
                ->leftJoin('users as assignBy', 'tasks.assign_by_id', 'assignBy.id')
                ->leftJoin('groups', 'tasks.group_id', 'groups.id')
                ->where(['tasks.group_id' => $groupId, 'days.id' => $todayDay->id])
                ->get();
        }

        if ($loggedUser->user_type == 'super_admin') {

            $todayTasks = DB::table('tasks')
                ->select(
                    'tasks.title as taskTitle',
                    'tasks.start_at as taskStartAt',
                    'tasks.end_at as taskEndAt',
                    'tasks.done_at as taskDoneAt',
                    'days.title as dayTitle',
                    'days.ar_date as arDate',
                    'days.en_date as enDate',
                    'groups.title as groupTitle',
                    'assignBy.name as assignByName',
                    'assignFor.name as assignForName',
                    'assignFor.phone as phone',
                    'assignFor.user_type as userType',
                )
                ->join('days', 'tasks.day_id', 'days.id')
                ->leftJoin('users as assignFor', 'tasks.assign_for_id', 'assignFor.id')
                ->leftJoin('users as assignBy', 'tasks.assign_by_id', 'assignBy.id')
                ->leftJoin('groups', 'tasks.group_id', 'groups.id')
                ->where(['days.id' => $todayDay->id])
                ->get();
        }
        // return $todayTasks;

        return response(['todayTasks' => $todayTasks], 200);
    }
}
