<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class ClientController extends Controller
{
    public function __construct()
    {
     // $this->middleware('auth.role:client');
    }
    
     //api/event

    public function select(Request $request){
        $event=Event::find($request->id);
        //get the dateTime for google events 
            $date=$event->event_date;
            $time=$event->start_time;
            $date=date('Y-m-d', strtotime($date));
            $time=date('h:i:s', strtotime($time));
            $dateTime = $date.' '.$time;
        //select event in app 
        if($event->user_id === 0 ){
            $user = auth()->user($request->token);
            $user_id=$user->id;
            $event->user_id = $user_id;
            $event->save();
            //return $event;
        //select event in google 
            $controller = new gCalendarController;
            $controller->select_gEevent($dateTime);
        }
    }
    public function unselect(Request $request){
        $user_id = auth()->user($request->token)->id;
        $event=Event::find($request->id);
        if($event->user_id === $user_id){
        $event->user_id = 0;
        $event->save();
        return $event;
        }
    }

     //api/users
     public function submitForm(Request $request){
        $user = auth()->user($request->token);
        $user->age= $request->age;
        $user->text= $request->text;
        $user->save();
       return $user;
    }

}
