<?php

namespace App\Traits;

use App\Role;

trait HasPermissionsTrait {
    
   public function roles() 
   {
      return $this->belongsToMany(Role::class, 'users_roles');
   }

   public function hasRole(...$roles) 
   {
        foreach($roles as $role) 
        {
            if($this->roles->contains('name', $role)) 
            {
                return true;
            }
        }

        return false;
    }
}