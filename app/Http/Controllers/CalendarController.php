<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Calendar;
use App\Leave;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];
        $currentId = \Auth::user()->id;
        if(\Auth::user()->hasRole('Pracownik'))  $data = Leave::all()->where('user_id',$currentId);
        else $data = Leave::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
              
                   
                $events[] = Calendar::event(
                    
                    $value->user['first_name']." ".$value->user['last_name'] ."-".$value->leavetype->name,
                    
                   
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.' +1 day'),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#f05050',
	                    
	                ]
                );
            }
        }
        $calendar = Calendar::addEvents($events)->setOptions(['lang' => 'pl']);
        return view('calendar.index', compact('calendar'));
    }

}