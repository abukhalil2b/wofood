<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;

class MakeAsDone extends Component
{
    public $taskId;

    public $done_at;

    public function mount($taskId)
    {
        $this->taskId = $taskId;

        $task = Task::find($taskId);

        $this->done_at = $task->done_at;
    }

    public function makeAsDone()
    {
        $this->done_at = date('Y-m-d H:i:s');

        Task::where('id',$this->taskId)->update([
            'done_at' =>  $this->done_at
        ]);
    }

    public function render()
    {
        return view('livewire.task.make-as-done');
    }
}
