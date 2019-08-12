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
    
 
        return view('schedules.index',compact ('schedules','users','tempDates','current','daysInMonth'));
    }

   
    /**     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current=\Auth::user();
        $schedules=Schedule::all();
        $users=User::all();
 //year=new Carbon(Schedule::first()->start);
     
  return view('schedules.create',compact ('schedules','users','current'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Schedule $schedule)
    {
       
    
    $users=User::all();
    $data= $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'start' => ['required','date_format:H:i'],
            'end' => ['required','date_format:H:i', 'after:start' ],
            
            
    ]); 
    
    $new=$schedule->create($data);
     $new->users()->attach($request->user);  
 
    
          return redirect(route('schedule.index'))->with('success', 'Pomyślnie dodano plan');
      
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

        $schedule->delete();  
        return redirect(route('schedule.index'))->with('success', 'Pomyślnie usunięto plan');
    }    

    

}
