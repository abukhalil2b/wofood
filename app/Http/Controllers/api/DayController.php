<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DayIndexResource;
use App\Http\Resources\TasksResource;
use App\Models\Day;
use App\Models\Task;



class DayController extends Controller
{
    public function index()
    {
        $loggedUser = auth()->user();

        $days = Day::withCount([
            'tasks' => function ($task) use ($loggedUser) {
                $task->where('assign_for_id', $loggedUser->id);
            },
            'taskAttachments' => function ($taskAttachment) use ($loggedUser) {
                $taskAttachment->where('assign_for_id', $loggedUser->id);
            },
            'taskSubtasks' => function ($taskSubtask) use ($loggedUser) {
                $taskSubtask->where('assign_for_id', $loggedUser->id);
            }
        ])
            ->whereActive(1)
            ->get();
        // route('day.show',$day->id)
        return $days;
        return DayIndexResource::collection($days);
    }

    public function show(Day $day)
    {
        $loggedUser = auth()->user();

        $tasks = Task::where([
            'assign_for_id' => $loggedUser->id,
            'day_id' => $day->id
        ])->get();
        // return $tasks;
        $tasksResource = TasksResource::collection($tasks);

        $response = [
            'day' => $day,
            'tasks' => $tasksResource
        ];
        return response($response, 200);

    }
}
