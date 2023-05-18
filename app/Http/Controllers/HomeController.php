<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
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

        if($loggedUser->user_type == 'normal'){
            abort(403,'لاتملك الصلاحية');
        }

        //[ ] super user can see any other user
        if ($loggedUser->id == 1) {

            $users = User::all();
        } else {

            $users = User::where('group_id', $loggedUser->group_id)
                ->whereNot('id', 1)
                ->get();
        }


        return view('user.index', compact('users'));
    }

    public function userShow(User $user)
    {
        $loggedUser = auth()->user();

        if ($loggedUser->group_id == $user->group_id) {

            return view('user.show', compact('user'));
        }
    }

    public function userSearch(Request $request)
    {
        $loggedUser = auth()->user();

        $search = $request->search;

        if ($loggedUser->id == 1) {

            $users = User::where('name', 'like', '%' . $search . '%')
                ->get();
        } else {

            $users = User::where('group_id', $loggedUser->group_id)
                ->where('name', 'like', '%' . $search . '%')
                ->get();
        }

        return view('user.index', compact('users'));
    }


}
