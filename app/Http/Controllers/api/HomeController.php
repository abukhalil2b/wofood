<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Task;
use Illuminate\Http\Request;

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
            ->get();

        $todayTasks = Task::where('assign_for_id', $loggedUser->id)
            ->where('day_id', '=', $todayDay->id)
            ->get();

        $prevTasks = Task::where('assign_for_id', $loggedUser->id)
            ->where('day_id', '<', $todayDay->id)
            ->get();

        $nextTasks = Task::where('assign_for_id', $loggedUser->id)
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
}
