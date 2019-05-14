<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Roles extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public function users() {
        return $this->belongsToMany(User::class,'users_has_roles','role_id','user_id')->withTimestamps();
    }
    
}
