<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
