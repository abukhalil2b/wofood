<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\User;
use Carbon\Carbon;
use App\Models\TaskSubtask;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class HomeController extends Controller
{


    public function dashboard()
    {
        // return phpinfo();
        $loggedUser = auth()->user();

        $today = Carbon::today()->format('Y-m-d');

        $day = Day::whereDate('en_date', $today)->first();

        if (!$day) {
            abort(403, 'خارج نطاق الخطة');
        }

        $totalTasks = Task::where('assign_for_id', $loggedUser->id)
            ->get();

        $todayTasks = Task::where('assign_for_id', $loggedUser->id)
            ->where('day_id', '=', $day->id)
            ->get();

        $prevTasks = Task::where('assign_for_id', $loggedUser->id)
            ->where('day_id', '<', $day->id)
            ->get();

        $nextTasks = Task::where('assign_for_id', $loggedUser->id)
            ->where('day_id', '>', $day->id)
            ->get();


        return view('dashboard', compact('totalTasks', 'todayTasks', 'prevTasks', 'nextTasks'));
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
                ->whereNot('id', 1)
                ->whereNot('id', $loggedUser->id)
                ->get();

            $title = 'قائمة أعضاء ' . $groupTitle;
        }

        if ($loggedUser->user_type == 'super_admin') {

            $users = User::whereNot('id', 1)
                ->whereNot('id', $loggedUser->id)
                ->get();

            $title = 'قائمة كل الأعضاء';
        }

        return view('user.index', compact('users', 'title'));
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
                ->whereNot('id', 1)
                ->whereNot('id', $loggedUser->id)
                ->where('name', 'like', '%' . $search . '%')
                ->get();

            $title = 'قائمة أعضاء ' . $groupTitle;
        }

        if ($loggedUser->user_type == 'super_admin') {

            $users = User::whereNot('id', 1)
                ->whereNot('id', $loggedUser->id)
                ->where('name', 'like', '%' . $search . '%')
                ->get();

            $title = 'قائمة كل الأعضاء';
        }

        return view('user.index', compact('users', 'title'));
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

        return view('user.today.subtasks', compact('todayTasks'));
    }

    public function todayAttachments()
    {

        $loggedUser = auth()->user();

        $todayDate = date('Y-m-d');

        if ($loggedUser->user_type == 'admin') {

            $groupId = $loggedUser->group_id;

            $todayAttachments = DB::table('task_attachments')
                ->select(
                    'days.title as dayTitle',
                    'days.ar_date as dayArDate',
                    'days.en_date as dayEnDate',
                    'task_attachments.created_at as attachmentCreatedAt',
                    'users.name as assignForName',
                    'tasks.title as taskTitle',
                    'task_attachments.url',
                    'task_attachments.title as attachmentTitle'
                )
                ->leftJoin('tasks', 'task_attachments.task_id', '=', 'tasks.id')
                ->leftJoin('days', 'task_attachments.task_id', '=', 'days.id')
                ->leftJoin('users', 'tasks.assign_for_id', '=', 'users.id')
                ->where('users.group_id', $groupId)
                ->whereDate('task_attachments.created_at', $todayDate)
                ->get();
        }

        if ($loggedUser->user_type == 'super_admin') {
            $todayAttachments = DB::table('task_attachments')
                ->select(
                    'days.title as dayTitle',
                    'days.ar_date as dayArDate',
                    'days.en_date as dayEnDate',
                    'task_attachments.created_at as attachmentCreatedAt',
                    'users.name as assignForName',
                    'tasks.title as taskTitle',
                    'task_attachments.url',
                    'task_attachments.title as attachmentTitle'
                )
                ->leftJoin('tasks', 'task_attachments.task_id', '=', 'tasks.id')
                ->leftJoin('days', 'task_attachments.task_id', '=', 'days.id')
                ->leftJoin('users', 'tasks.assign_for_id', '=', 'users.id')
                ->whereDate('task_attachments.created_at', $todayDate)
                ->get();
        }

        return view('user.today.attachments', compact('todayAttachments'));
    }

    //[ ] this is result need check
    public function todayTasks()
    {
        $today = Carbon::now()->format('Y-m-d');

        $loggedUser = auth()->user();

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
                ->whereDate('days.en_date', $today)
                ->where('assignFor.id', $groupId)
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
                ->whereDate('days.en_date', $today)
                ->get();
        }
        // return $todayTasks;

        return view('user.today.tasks', compact('todayTasks'));
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
        // return $lateTasks;

        return view('user.late.tasks', compact('lateTasks'));
    }
}
