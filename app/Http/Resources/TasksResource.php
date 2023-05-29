<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'groupTitle' => $this->group->title,
            'assign_for_name' => $this->assignfor ? $this->assignfor->name : null,
            'assign_by_name' => $this->assignby ? $this->assignby->name : null,
            'day' => $this->day,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'done_at' => $this->done_at,
            'note' => $this->note,
            'taskAttachments' => $this->taskAttachments,
            'taskSubtasks' => $this->taskSubtasks

        ];
    }
}
