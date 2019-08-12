<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
  

    protected $guarded = [];
    public function users() {
        return $this->belongsToMany(User::class,'users_has_roles','role_id','user_id')->withTimestamps();
    }
    
}
