<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\TopicResource;

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
        dd($this->pivot->progress_level_id);

        return [
          'id' => $this->id,
          'description' => $this->description,
          'criterion' => $this->criterion,
          'topic' => new TopicResource($this->topic),
          'progress_level' => new ProgressLevelResource($this->pivot->progress_level_id),
      ];
    }
}
