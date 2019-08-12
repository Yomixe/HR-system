<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use App\LeaveStatus;
use App\Leave;
use DataTables;
use Validator;
use Auth;
use App\User;
use App\Mail\MailLeaveApproach;
use Illuminate\Support\Facades\Mail;
class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentId = \Auth::user()->id;
       $leavetypes=LeaveType::all();
        if (request()->ajax()) {
            $data = Leave::latest()->where('user_id',$currentId);
            return Datatables::of($data)
             ->addIndexColumn()
            ->addColumn('action', function($row){
                if($row->confirm==0){
                $btn = '<a href="javascript:void(0);" id="edit-leave" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning edit-leave">Edytuj</a>';
                $btn = $btn.' <a href="javascript:void(0);" id="delete-leave" data-toggle="tooltip" data-original-title="Delete" data-id="'.$row->id.'" class="delete btn btn-danger">Usuń    </a>';
                
  
                return $btn;
                }
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
        return view('leave.index-employee', compact('leavetypes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
    $currentId = \Auth::user()->id;
    $leaveId = $request->leave_id;
    $validate=
        ['start_date' => ['required', 'date' ],
         'end_date' => ['required', 'date' ,'after_or_equal:start_date' ],
         'comment'=>['max:255']

    ];
   
    $leave_arr   =  
    
    [
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'confirm'=>0,
    'comment'=>$request->comment,
    'user_id'=>$currentId,
    'type_of_leave_id'=>$request->type_of_leave_id,
    ];
;  
    $error = Validator::make($leave_arr, $validate);
    if($error->fails())
    {
        return \Response::json(['errors' => $error->errors()->all()]);
    }
    $leave=Leave::updateOrCreate(  ['id' => $leaveId],$leave_arr);


    $currentDepartment=Auth::user()->departments->id;
    $people=User::where('department_id', $currentDepartment)->get();
    foreach($people as $person)

{
    if($person->hasAnyRole("Kierownik"))
    {
        Mail::to($person->email)->send(new MailLeaveApproach); 
        
    }
}


    return \Response::json(['success' => 'Prośba została wysłana.']);
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
    $leave->delete();

    return \Response::json(['success' => 'Prośba została usunięta']);
}



    
       

   
}
