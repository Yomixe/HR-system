<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveStatus extends Model
{
   protected $table='status_leave';
   protected $guarded=['id'];
  

  public function leavetype()
  {
      return $this->belongsTo(LeaveType::class,'type_of_leave_id');  
  }

  public function user()
  {
      return $this->belongsTo(User::class,'user_id');  
  }



  
}
