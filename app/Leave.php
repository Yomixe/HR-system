<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
 protected $table='users_leaves';
   public function user()
   {
       return $this->belongsTo(User::class,'user_id') ;
    }
    public function leavetype()
    {
        return $this->belongsTo(LeaveType::class,'type_of_leave_id');  
     }
}
