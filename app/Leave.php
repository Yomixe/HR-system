<?php

namespace App;
use App\LeaveStatus;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Leave extends Model
{
   
  protected $guarded=['id'];
  protected $table='users_leaves';
  public function user()
  {
      return $this->belongsTo(User::class,'user_id') ;
  }
  public function leavetype()
  {
      return $this->belongsTo(LeaveType::class,'type_of_leave_id');  
  }
 
  public function status()
  {
      return $this->belongsTo(LeaveStatus::class,'user_id')->where('type_of_leave_id',$this->type_of_leave_id);  
  }
  
  public function updateStatus($userId, $leaveTypeId, $startDate, $endDate,$type)
  {
      $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
      $endDate = Carbon::createFromFormat('Y-m-d', $endDate);
      $days = $endDate->diffInDays($startDate);
     $days=$days+1;
      $employeeLeaveStatus=LeaveStatus::firstOrNew(['user_id'=>$userId , 'type_of_leave_id'=> $leaveTypeId ]);
      if(!$employeeLeaveStatus) {
      $leaveType= $this->leavetype->where('type_of_leave_id',$leaveTypeId);
      $employeeLeaveStatus=LeaveStatus::create([
      'user_id'=>$userId,
      'type_of_leave_id'=>$leaveTypeId,
      'total_used'=>$days,
    
      ]);  
      return $employeeLeaveStatus;  
       }
       if($type==0)
       $this->addStatus($employeeLeaveStatus,$days);
       else
       $this->substractStatus($employeeLeaveStatus,$days); 


    }
    public function addStatus($employeeLeaveStatus,$days)
    {
        $employeeLeaveStatus->total_used+=$days;
        $employeeLeaveStatus->save();
        return $employeeLeaveStatus;
    }

    public function substractStatus($employeeLeaveStatus,$days)
    {
        $employeeLeaveStatus->total_used-=$days;
        $employeeLeaveStatus->save();
        return $employeeLeaveStatus;
    }
  
}
