<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{  
    
    protected $table='work_schedule';
    protected $guarded=[];
    protected $dates = ['start_date','end_date'];
  
    public function users() {
        return $this->belongsToMany(User::class,'schedules_users','work_schedule_id','user_id')->withTimestamps();
        
    }
}
