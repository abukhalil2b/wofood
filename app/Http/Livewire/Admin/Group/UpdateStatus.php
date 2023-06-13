<?php

namespace App\Http\Livewire\Admin\Group;

use App\Models\Group;
use Livewire\Component;

class UpdateStatus extends Component
{
    public Group $group;

    public $status;

    public function active()
    {
        $this->status = 1;

        $this->group->active = $this->status;

        $this->group->save();
    }

    public function deactive()
    {
        $this->status = 0;

        $this->group->active = $this->status;
        
        $this->group->save();
    }

    public function mount($groupId)
    {
        $this->group = Group::find($groupId);

        $this->status = $this->group->active;
    }

    public function render()
    {
        return view('livewire.admin.group.update-status');
    }
}
