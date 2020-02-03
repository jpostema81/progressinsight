<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningGoal extends Model
{
    /**
       * The event map for the model.
       *
       * @var array
       */
    protected $dispatchesEvents = [
      // 'created' => UserSaved::class,
      // 'deleted' => UserDeleted::class,
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_learning_goals')
            ->withPivot('progress_level_id')
            ->join('progress_levels', 'progress_level_id', 'progress_levels.id')
            ->select('learning_goals.*', 'progress_levels.id AS pivot_progress_level_id', 'progress_levels.name AS pivot_progress_level_name');
    }

    public function topic() {
        return $this->belongsTo('App\Topic');
    }
}
