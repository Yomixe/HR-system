<?php

namespace App\Http\Controllers;





use Illuminate\Http\Request;

use Charts;

use App\User;
use DataTables;
use DB;
use App\LeaveType;
use App\Leave;
use App\LeaveStatus;
use Intervention\Image\Gd\Shapes\EllipseShape;

class ChartController extends Controller
{
    public function newusers()
    {
    	$users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
    				->get();
        $chart = Charts::database($users, 'bar', 'highcharts')
			      ->title("Nowi zarejestrowani użytkownicy")
			      ->elementLabel("Całkowita liczba")
			      ->dimensions(1000, 500)
			      ->responsive(false)
			      ->groupByMonth(date('Y'), true);
        return view('charts.newusers',compact('chart'));
	}
	
    public function leaves(Request $request)
    {
		$currentId = \Auth::user()->id;
		$status=LeaveStatus::where(['user_id'=>$currentId])->get();
		
		if(isset($status)) {
		$chart = Charts::multi('bar', 'chartjs')	
		->title("Dostępny urlop")
		->dimensions(0, 500)
		->responsive(false)
		->colors(['lightgreen','lightblue','pink','purple','gray'] );
		foreach($status as $st){	
		$chart->dataset($st->leavetype->name."(max:".$st->leavetype->available_days.")" ,[$st->leavetype->available_days-$st->total_used  ])
		->labels(["Pozostało"]);
	 	}
		return view('charts.leaves',compact('chart','status'));
		
	}

  
}	


public function leavesforManager(Request $request)


	{	
		$current = \Auth::user();
		if($current->departments) {
		$currentDepartment=\Auth::user()->departments->name;
		
		$users=User::all();
	
		$count[]="";
		foreach($users as $user){
			
		if( $currentDepartment==$user->departments['name']){
			$count[]+=$user->id;
		}}
		unset($count[0]);		
	}
		if (request()->ajax()) {	
			$currentId = \Auth::user();
			if($current->hasAnyRole('Admin')){
    
				$data=  Leave::latest()->get();
				  
				  }
				  else $data=  Leave::query()->whereIn('user_id',$count);
       

			return Datatables::of($data)
            ->addIndexColumn()
			->editColumn('user_id',function($leave) {
                return  $leave->user['first_name']." ".$leave->user['last_name'] ;
            })
            ->editColumn('type_of_leave_id',function($leave) {
                return  $leave->leavetype->name;
			})
			->addColumn('available_days',function($leave) {
                return  $leave->leavetype->available_days;
            })
			->addColumn('available',function($leave) {
                return  $leave->leavetype->available_days-$leave->total_used;
            })
            ->rawColumns(['action'])
            ->make(true);
	
		}
        return view('charts.leavesforManager', compact('users','currentId'));

		
	}}