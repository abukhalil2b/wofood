<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DayIndexResource extends JsonResource
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
            'ar_date' => $this->ar_date,
            'en_date' => $this->en_date,
            'tasks_count' => $this->tasks_count,
            'task_attachments_count' => $this->task_attachments_count,
            'task_subtasks_count' => $this->task_subtasks_count,
            'url'=> route('day.show',$this->id)
        ];
    }
}
