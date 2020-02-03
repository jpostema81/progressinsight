<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TopicResource;
use App\ProgressLevel;

class LearningGoalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'description' => $this->description,
          'criterion' => $this->criterion,
          'topic' => new TopicResource($this->topic),
          'progress_level' => new ProgressLevelResource(ProgressLevel::find($this->pivot->progress_level_id)),
      ];
    }
}
