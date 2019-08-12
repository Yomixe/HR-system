<?php

namespace App\Http\Controllers;

use App\Leave;
use App\LeaveType;
use App\LeaveStatus;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailLeaveAccept;
use Carbon\Carbon;
class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
  
    {
        $users=User::all();
        $leavetypes=LeaveType::all();
          $current = \Auth::user();
          if($current->departments){
          $currentDepartment=\Auth::user()->departments->name; 
          }
       $current= \Auth::user();
       $count[]="";
    foreach($users as $user){
      
    

        if($user->departments){
        if($current->departments){
            
    if( $currentDepartment==$user->departments['name']){
        $count[]+=$user->id;
    }}}
    
    
    }

    unset($count[0]);
//dd($count);

if (request()->ajax()) {
   
   
    if($current->hasAnyRole('Admin')){
    
  $data=  Leave::latest()->get();
    
    }
    else $data=  Leave::query()->whereIn('user_id',$count);
    
		   
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning edit-leave">Edytuj</a>';
                $btn = $btn.' <a href="javascript:void(0);" id="delete-leave" data-toggle="tooltip" data-original-title="Delete" data-id="'.$row->id.'" class="delete btn btn-danger">Usuń    </a>';
                if($row->confirm==0)
                {
                   $btn = $btn.' <a href="javascript:void(0);"  id="confirm-leave" data-toggle="tooltip" data-original-title="Confirm" data-id="'.$row->id.'" class="confirm-leave btn btn-info">Potwierdź </a>';
                }
  
                return $btn;
            })
            ->editColumn('user_id',function($leave) {
                return  $leave->user['first_name']." ".$leave->user['last_name'] ;
            })
            ->editColumn('type_of_leave_id',function($leave) {
                return  $leave->leavetype->name;
            })
            ->editColumn('confirm',function($leave) {
                return  $leave->confirm==0 ? "Prośba" : "Urlop potwierdzony";
            })
            ->rawColumns(['action'])
           
            ->make(true);
      
       }
    
 
 
        return view('leave.index', compact('users','current','leavetypes'));
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Leave $leave)
    {
        $leaveId = $request->leave_id;
        $validate=
        ['start_date' => ['required', 'date' ],
         'end_date' => ['required', 'date' ,'after_or_equal:start_date', ],
         'comment'=>['max:255']

    ];
   
    $leave_arr   =  
    
    [
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'confirm'=>1,
    'comment'=>$request->comment,
    'user_id'=>$request->user_id,
    'type_of_leave_id'=>$request->type_of_leave_id,
    ];
;  
    $leavetype=LeaveType::where('id',$request->type_of_leave_id )->first();
   
    $status=LeaveStatus::where('type_of_leave_id',$request->type_of_leave_id )->where('user_id',$request->user_id )->first();
    if(isset($status))  $value=$status->total_used;
    else $value=0;
    $startDate = Carbon::createFromFormat('Y-m-d', $request->end_date);
    $endDate = Carbon::createFromFormat('Y-m-d',   $request->start_date);
    $error = Validator::make($leave_arr, $validate);
    if($status) $pozostalo=$leavetype->available_days-$status->total_used;
    else $pozostalo=$leavetype->available_days;
    
    $start=$leavetype->start_date;
    $end=$leavetype->end_date;
    if($error->fails())
    {
        return \Response::json(['errors' => $error->errors()->all()]);
    }
    


    if($leavetype->start_date>$request->start_date OR $leavetype->end_date<$request->end_date )
    {
        return \Response::json(['error' => 'Urlop nie mieści się w zakresie urlopu '.$leavetype->name.' (od '.$start.' do '.$end.')']);
    }
    elseif($endDate->diffInDays($startDate)+1+$value>$leavetype->available_days)
    {
        return \Response::json(['error' => 'Nie można dodać, przekroczono limit, pozostało jedynie '. $pozostalo.'dni do wykorzystania.']);
    }
    else
    {
       
        $leave=Leave::updateOrCreate(  ['id' => $leaveId],$leave_arr);

    }
    $leave->updateStatus($leave->user_id, $leave->type_of_leave_id,$leave->start_date, $leave->end_date,0); 
   

    return \Response::json(['success' => 'Urlop dodany']);
}
      
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $leave  = Leave::where(['id'=>$id])->first();
        $leave->updateStatus($leave->user_id, $leave->type_of_leave_id,$leave->start_date, $leave->end_date, 1); 
        return \Response::json($leave);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $leave=Leave::FindOrFail($id);
        $leave->updateStatus($leave->user_id, $leave->type_of_leave_id,$leave->start_date, $leave->end_date,1); 
        $leave->delete();
        
        return \Response::json(['success' => 'Usunięto urlop']);  
    }


    public function confirm($id,User $user)
    {
        $leave=Leave::FindOrFail($id);
        $leave->confirm=1;
        $leave->save();

        $user->where('id',$leave->user_id)->first();
        $user->mail;
        Mail::to( $user->where('id',$leave->user_id)->first()->email)->send(new MailLeaveAccept); 


        return \Response::json(['success' => 'Zakceptowano prośbę']);        
    }
}
