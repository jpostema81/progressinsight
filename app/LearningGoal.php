<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningGoal extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
