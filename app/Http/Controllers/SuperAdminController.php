<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Day;
use App\Models\Group;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{


    /**-----   user tasks   ----- */

    public function orderbyTaskCount()
    {
        $tasks = Task::select('users.name', DB::raw('COUNT(assign_for_id) as count'), 'groups.title as group_title')
            ->join('users', 'tasks.assign_for_id', '=', 'users.id')
            ->join('groups', 'users.group_id', 'groups.id')
            ->groupby('assign_for_id')
            ->get();

            return view('super_admin.user.orderby_task_count',compact('tasks'));
    }

    /**-----   day   ----- */
    public function dayIndex()
    {
        $days = Day::all();

        return view('super_admin.day.index', compact('days'));
    }

    public function dayShow(Day $day)
    {
        return view('super_admin.day.show', compact('day'));
    }

    public function dayUpdate(Day $day, Request $request)
    {
        $day->update([
            'ar_date' =>  $request->ar_date,
            'title' =>  $request->title
        ]);

        return redirect()->route('super_admin.day.index');
    }

    public function dayStore(Request $request)
    {
        $enDate = $request->en_date;



        function getDayName($dayOfWeek)
        {

            switch ($dayOfWeek) {
                case 6:
                    return 'السبت';
                case 0:
                    return 'الأحد';
                case 1:
                    return 'الإثنين';
                case 2:
                    return 'الثلاثاء';
                case 3:
                    return 'الأربعاء';
                case 4:
                    return 'الخميس';
                case 5:
                    return 'الجمعة';
                default:
                    return '';
            }
        }

        $dayName = getDayName(date('w', strtotime($enDate)));

        Day::create([
            'en_date' => $enDate,
            'title' => $dayName,
            'ar_date' => $request->ar_date,
        ]);

        return back();
    }

    /**-----   group   ----- */


    public function groupIndex()
    {

        $groups = Group::whereNot('id', 1)->get();

        return view('super_admin.group.index', compact('groups'));
    }

    public function groupStore(Request $request)
    {

        Group::create($request->validate(['title' => 'required']));

        return back();
    }

    public function groupUserIndex(Group $group)
    {


        $groups = Group::whereNot('id', 1)->get();

        $users = User::where('group_id', $group->id)->get();

        return view('super_admin.group.user.index', compact('users', 'groups', 'group'));
    }

    public function groupUserStore(Request $request)
    {
        // return $request->all();
        $request->validate([
            'user_type' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric|unique:users',
        ]);

        $loggedUser = auth()->user();

        if ($loggedUser->user_type == 'admin' || $loggedUser->user_type == 'super_admin') {

            User::create([
                'user_type' => $request->user_type,
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->phone),
                'group_id' => $request->group_id,
            ]);

            return back();
        }
        abort(403);
    }

    public function groupUserShow(User $user)
    {
        return view('super_admin.group.user.show', compact('user'));
    }

    public function groupUserUpdate(Request $request, User $user)
    {
        // return $request->all();
        $request->validate([
            'user_type' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric|unique:users',
        ]);

        $user->update([
            'name' => $request->name,
            'user_type' => $request->user_type,
        ]);

        return back();
    }

    public function groupUserPasswordUpdate(Request $request, User $user)
    {

        $user->update([
            'password' => Hash::make($user->phone),
        ]);

        return back();
    }


    public function shfitToOtherGroup(Request $request)
    {
        $request->validate([
            'group_id' => 'required'
        ]);

        if ($ids = $request->userIds) {
            User::whereIn('id', $ids)->update([
                'group_id' => $request->group_id
            ]);
        }
        return back();
    }
}
