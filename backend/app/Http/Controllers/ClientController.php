<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class ClientController extends Controller
{
    public function __construct()
    {
    }
    
     //api/event

    public function select(Request $request){
        $typeId = gettype($request->id);
        $controller = new gCalendarController;
        //case event come from google calendar 
        if($typeId == "string" ){
            $date=date('Y-m-d', strtotime($request->date));
            $time=date('H:i:s', strtotime($request->time));
             $dateTime = $date.' '.$time;
          //trouver l'event in calendar
            $gEvent= $controller->findEventById($request->id);
            if($gEvent->transparency == "transparent" ){
                $user = auth()->user($request->token);
                $user_id=$user->id;
            //select event in google
            $controller->select_gEevent($request->id, $user_id);

                // save the slected event in the app database
                $event = new Event;
                $event->event_date = $date;
                $event->start_time = $time;
                $event->user_id=$user_id;
                $event->save();
            }
        
        }else if($typeId == "integer" ) {
            $event=Event::find($request->id);
        //get the dateTime for google events 
            $date=$event->event_date;
            $time=$event->start_time;
            $date=date('Y-m-d', strtotime($date));
            $time=date('H:i:s', strtotime($time));
            $dateTime = $date.' '.$time;
        //select event in app
       if($event->user_id === 0 ){
            $user = auth()->user($request->token);
            $user_id=$user->id;
            $event->user_id = $user_id;
            $event->save();
        //select event in google 
            $controller = new gCalendarController;
                
        //call the event by start time
            $eventId= $controller->Find_g_EventByDatetTime($dateTime);
            $controller->select_gEevent($eventId, $user_id);
            }
    }
    }
    public function unselect(Request $request){
        $user_id = auth()->user($request->token)->id;
        $event=Event::find($request->id);
        //get the dateTime for google events 
        $date=$event->event_date;
        $time=$event->start_time;
        $date=date('Y-m-d', strtotime($date));
        $time=date('H:i:s', strtotime($time));
        $dateTime = $date.' '.$time;
        //unselect event in the app
        if($event->user_id === $user_id){
        $event->user_id = 0;
        $event->save();

        //select event in google 
        $controller = new gCalendarController;
        $controller->unselect_gEevent($dateTime);

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
