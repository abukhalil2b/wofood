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

    public function toggleDone()
    {
        

        $task = Task::find($this->taskId);

        if ($task->done_at == null) {

            $this->done_at = date('Y-m-d H:i:s');

            $task->update([
                'done_at' =>  $this->done_at
            ]);
        } else {

            $this->done_at = null;

            $task->update([
                'done_at' =>  null
            ]);
        }
    }


    public function render()
    {
        return view('livewire.task.make-as-done');
    }
}
