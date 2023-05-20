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


    public function todaySubtasks(){

        $todayTasks = TaskSubtask::all();
        
        return view('user.today.subtasks',compact('todayTasks'));
    }

    public function todayAttachments(){

        $todayAttachments = TaskAttachment::all();
        
        return view('user.today.attachments',compact('todayAttachments'));
    }

    
    public function todayTasks()
    {
        $today = Carbon::now()->format('Y-m-d');

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
            'users.name as assignFor',
            'users.phone as phone',
            'users.user_type as userType',
        )
        ->join('days','tasks.day_id','days.id')
        ->leftJoin('users','tasks.assign_for_id','users.id')
        ->leftJoin('groups','tasks.group_id','groups.id')
        ->whereDate('days.en_date',$today)
        ->get();

        // return $todayTasks;

        return view('user.today.tasks',compact('todayTasks'));
    }

}
