<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
        $users=User::all();
        $current= \Auth::user();
        $schedules=Schedule::all();
        $tempDates = Carbon::createFromDate($request->year, $request->month, 1);
        $daysInMonth=$tempDates->daysInMonth;
       

   //      for($day;$day<=$tempDates->daysInMonth;$day++) $days[$day]=$day;
        return view('schedules.index',compact ('schedules','users','tempDates','current','daysInMonth'));
    }

   
    /**     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $schedule=Schedule::findorFail($id);
        $schedules=Schedule::all();
        $users=User::all();
 //year=new Carbon(Schedule::first()->start);
     
  return view('schedules.create',compact ('schedules','users','schedule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
       
        $schedule= Schedule::findorFail($id);
        
        $data= $request->validate([
            'date' => ['required', 'date'],
            'start' => ['required' ],
            'end' => ['required' ],
            'type_of_day'=>['required'],
            
      ]); 
    $schedule->create($data);
  
  
       $schedule->users()->attach($request->user);
      
     
          
          return redirect(route('schedule.index'));
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    

}
