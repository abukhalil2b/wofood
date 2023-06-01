<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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

            return $tasks;
    }

}
