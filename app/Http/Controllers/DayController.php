<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Taskcat;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function index()
    {
        $loggedUser = auth()->user();

        $days = Day::withCount([
            'tasks' => function ($task) use($loggedUser){
                $task->where('assign_for_id', $loggedUser->id);
            },
            'taskAttachments' => function ($taskAttachment) use($loggedUser){
                $taskAttachment->where('assign_for_id', $loggedUser->id);
            }
            ,
            'taskSubtasks' => function ($taskSubtask) use($loggedUser){
                $taskSubtask->where('assign_for_id', $loggedUser->id);
            }
        ])
        ->whereActive(1)
        ->get();

        return view('day.index', compact('days'));
    }

    public function show(Day $day)
    {
        $loggedUser = auth()->user();
        
        if($loggedUser->user_type == 'super_admin'){
            $taskcats = Taskcat::all();
        }else{
  $taskcats = Taskcat::where('group_id',$loggedUser->group_id)->get();
        }
      

        $tasks = Task::where([
            'assign_for_id' => $loggedUser->id,
            'day_id' => $day->id
        ])->get();

        return view('day.show', compact('day', 'tasks','taskcats'));
    }
}
