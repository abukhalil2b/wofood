<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class TaskIndex extends Component
{
    public $tasks = [];

    public $today;

    public function mount(User $user)
    {
        $this->today = Carbon::today()->format('Y-m-d');

        $this->tasks = $user->tasks()->whereDate('due_date',$this->today)->get();
    }

    public function render()
    {
        return view('livewire.user.task-index');
    }
}
