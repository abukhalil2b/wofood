<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function dashboard()
    {
        $loggedUser = auth()->user();

        $today = Carbon::today()->format('Y-m-d');

        $totalTasks = Task::where('assign_for_id', $loggedUser->id)
            ->get();

        $todayTasks = Task::where('assign_for_id', $loggedUser->id)
            ->whereDate('due_date', '=', $today)
            ->get();

        $prevTasks = Task::where('assign_for_id', $loggedUser->id)
            ->whereDate('due_date', '<', $today)
            ->get();

        $nextTasks = Task::where('assign_for_id', $loggedUser->id)
            ->whereDate('due_date', '>', $today)
            ->get();


        return view('dashboard', compact('totalTasks', 'todayTasks', 'prevTasks', 'nextTasks'));
    }


    public function userIndex()
    {
        $loggedUser = auth()->user();

        //[x] super user can see any other user
        if ($loggedUser->id == 1) {

            $users = User::all();
        } else {

            $users = User::where('group_id', $loggedUser->id)
                ->whereNot('id', $loggedUser->id)
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

        $users = User::where('group_id', $loggedUser->id)
            ->whereNot('id', $loggedUser->id)
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        return view('user.index', compact('users'));
    }

    public function userStore(Request $request)
    {
        // return $request->all();
        $request->validate([
            'user_type' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric|unique:users',
        ]);

        $loggedUser = auth()->user();

        if ($loggedUser->id == 1) {
            die('لايمكن اضافة العضو بهذا الحساب');
        }

        if ($loggedUser->user_type != 'admin') {
            abort(403);
        }

        User::create([
            'user_type' => $request->user_type,
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->phone),
            'group_id' => $loggedUser->group_id,
        ]);

        return back();
    }


    public function groupIndex()
    {

        $groups = Group::all();

        return view('group.index', compact('groups'));
    }

    public function groupStore(Request $request)
    {
        Group::create($request->validate(['title' => 'required']));

        return back();
    }

    public function groupUserIndex(Group $group)
    {
        $loggedUser = auth()->user();

        if ($loggedUser->id != 1) {
            abort(403);
        }

        $groups = Group::all();

        $users = User::where('group_id', $group->id)->get();

        return view('group.user.index', compact('users','groups'));
    }

    public function shfitToOtherGroup(Request $request)
    {
        $loggedUser = auth()->user();

        if ($loggedUser->id != 1) {
            abort(403);
        }

        if ($ids = $request->userIds) {
            User::whereIn('id', $ids)->update([
                'group_id' => $request->group_id
            ]);
        }
        return back();
    }
}
