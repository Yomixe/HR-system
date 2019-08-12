<?php

namespace App\Http\Controllers;

use App\LeaveType;
use Illuminate\Http\Request;
use Datatables;
use Validator;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
  
    {
       

        if (request()->ajax()) {
           
                    $data= LeaveType::latest()->get();
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                   $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning edit-type">Edytuj</a>';

                   $btn = $btn.' <a href="javascript:void(0);" id="delete-type" data-toggle="tooltip" data-original-title="Delete" data-id="'.$row->id.'" class="delete btn btn-danger">Usuń    </a>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
      
        return view('leavetypes.index');
    }
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typeId = $request->type_id;
        $validate=
        ['start_date' => ['required', 'date' ],
         'end_date' => ['required', 'date' ,'after_or_equal:start_date' ],
         'name'=>['max:255'],
         'available_days'=>['integer'],

    ];
   
    $type_arr   =  
    
    ['name' => $request->name,
    'available_days' => $request->available_days,
    'start_date' => $request->start_date,
    'end_date' => $request->end_date
    ];        
;  
    $error = Validator::make($type_arr, $validate);
    if($error->fails())
    {
        return \Response::json(['errors' => $error->errors()->all()]);
    }
    $leave=LeaveType::updateOrCreate(  ['id' => $typeId],$type_arr);
   

    return \Response::json(['success' => 'Urlop dodany']);
}
   

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type  = LeaveType::where(['id'=>$id])->first();
        
        return \Response::json($type);
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type=LeaveType::FindOrFail($id);
        $type->delete();
 
        return \Response::json(['success' => 'Usunięto typ urlopu']);
    }
}
