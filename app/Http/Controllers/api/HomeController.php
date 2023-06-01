<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $loggedUser = auth()->user();

        $todayDate = date('Y-m-d');

        $todayDay = Day::whereDate('en_date', $todayDate)->first();

        if (!$todayDay) {
            $response = ['message' => 'خارج نطاق الخطة'];
            return response($response, 403);
        }

        $totalTasks = Task::where('assign_for_id', $loggedUser->id)
            ->with(['day'])
            ->get();

        $todayTasks = Task::where('assign_for_id', $loggedUser->id)
            ->with(['day'])
            ->where('day_id', '=', $todayDay->id)
            ->get();

        $prevTasks = Task::where('assign_for_id', $loggedUser->id)
            ->with(['day'])
            ->where('day_id', '<', $todayDay->id)
            ->get();

        $nextTasks = Task::where('assign_for_id', $loggedUser->id)
            ->with(['day'])
            ->where('day_id', '>', $todayDay->id)
            ->get();

        $response = [
            'totalTasks' => $totalTasks,
            'todayTasks' => $todayTasks,
            'prevTasks' => $prevTasks,
            'nextTasks' => $nextTasks,
        ];

        return response($response, 200);
    }



    public function userIndex()
    {
        $loggedUser = auth()->user();

        $groupTitle = $loggedUser->group->title;

        if ($loggedUser->user_type == 'normal') {

            abort(403, 'لاتملك الصلاحية');
        }

        if ($loggedUser->user_type == 'admin') {

            $users = User::where('group_id', $loggedUser->group_id)
                ->with(['group'])
                ->whereNot('id', 1)
                ->whereNot('id', $loggedUser->id)
                ->get();
                
                $title = 'قائمة أعضاء ' . $groupTitle;
            }
            
            if ($loggedUser->user_type == 'super_admin') {
                
                $users = User::whereNot('id', 1)
                ->with(['group'])
                ->whereNot('id', $loggedUser->id)
                ->get();

            $title = 'قائمة كل الأعضاء';
        }

        return compact('users', 'title');
    }

    public function todaySubtasks()
    {

        $loggedUser = auth()->user();

        $todayDate = date('Y-m-d');

        if ($loggedUser->user_type == 'admin') {

            $groupId = $loggedUser->group_id;

            $todayTasks = DB::table('task_subtasks')
                ->select(
                    'days.title as dayTitle',
                    'days.ar_date as dayArDate',
                    'days.en_date as dayEnDate',
                    'task_subtasks.created_at as subtasksCreatedAt',
                    'users.name as assignForName',
                    'tasks.title as taskTitle',
                    'task_subtasks.title as subtaskTitle'
                )
                ->leftJoin('tasks', 'task_subtasks.task_id', '=', 'tasks.id')
                ->leftJoin('days', 'task_subtasks.task_id', '=', 'days.id')
                ->leftJoin('users', 'tasks.assign_for_id', '=', 'users.id')
                ->where('users.group_id', $groupId)
                ->whereDate('task_subtasks.created_at', $todayDate)
                ->get();
        }

        if ($loggedUser->user_type == 'super_admin') {
            $todayTasks = DB::table('task_subtasks')
                ->select(
                    'days.title as dayTitle',
                    'days.ar_date as dayArDate',
                    'days.en_date as dayEnDate',
                    'task_subtasks.created_at as subtasksCreatedAt',
                    'users.name as assignForName',
                    'tasks.title as taskTitle',
                    'task_subtasks.title as subtaskTitle'
                )
                ->leftJoin('tasks', 'task_subtasks.task_id', '=', 'tasks.id')
                ->leftJoin('days', 'task_subtasks.task_id', '=', 'days.id')
                ->leftJoin('users', 'tasks.assign_for_id', '=', 'users.id')
                ->whereDate('task_subtasks.created_at', $todayDate)
                ->get();
        }

        return $todayTasks;
    }

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

        return $todayTasks;
    }


    public function lateTasks()
    {
        $today = Carbon::now()->format('Y-m-d');

        $loggedUser = auth()->user();

        if ($loggedUser->user_type == 'admin') {

            $groupId = $loggedUser->group_id;

            $lateTasks = DB::table('tasks')
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
                ->whereNull('tasks.done_at')
                ->whereDate('days.en_date','<', $today)
                ->where('assignFor.id', $groupId)
                ->get();
        }

        if ($loggedUser->user_type == 'super_admin') {

            $lateTasks = DB::table('tasks')
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
                ->whereNull('tasks.done_at')
                ->whereDate('days.en_date','<', $today)
                ->get();
        }

        return $lateTasks;
    }


    public function userSearch(Request $request)
    {
        $search = $request->search;

        $loggedUser = auth()->user();

        $groupTitle = $loggedUser->group->title;

        if ($loggedUser->user_type == 'normal') {

            abort(403, 'لاتملك الصلاحية');
        }

        if ($loggedUser->user_type == 'admin') {

            $users = User::where('group_id', $loggedUser->group_id)
                ->with(['group'])
                ->whereNot('id', 1)
                ->whereNot('id', $loggedUser->id)
                ->where('name', 'like', '%' . $search . '%')
                ->get();

            $title = 'قائمة أعضاء ' . $groupTitle;
        }

        if ($loggedUser->user_type == 'super_admin') {

            $users = User::whereNot('id', 1)
                ->with(['group'])
                ->whereNot('id', $loggedUser->id)
                ->where('name', 'like', '%' . $search . '%')
                ->get();

            $title = 'قائمة كل الأعضاء';
        }

        return compact('users', 'title');
    }
}
