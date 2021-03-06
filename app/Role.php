<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot', 'created_at', 'updated_at',
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'users_roles');
    }

    public function invitations() 
    {
        return $this->belongsToMany(Invitation::class, 'invitations_roles');
    }
}
