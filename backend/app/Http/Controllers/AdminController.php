<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\gCalendarController;
use App\Event;
use App\User;
class AdminController extends Controller 
{

    
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
{
}
    // events admin functions
    public function create(Request $request)
    {
        $event = new Event;
        $date=$request->date;
        $time=$request->time;
        $date=date('Y-m-d', strtotime($date));
        $time=date('H:i:s', strtotime($time));
        $event->event_date = $date;
        $event->start_time = $time;
        $event->user_id=0;
        $event->save();
        $dateTime = $date.' '.$time;
        $controller = new gCalendarController;
        $controller->createGEvent($dateTime);
        return response($event);
    }

    public function delete(Request $request)
    {   
        //Use gCalendarController
        $controller = new gCalendarController;
        $typeId = gettype($request->id);
        //case event come from google calendar 
        if($typeId == "string" ){
            //no event coming from google is saved in db
            //delete only on google calendar 
            $controller->gEventDelete($request->id); 
        }else{
        //find the id of the event to delete in the app 
        $event=Event::find($request->id);
        //get the dateTime from the event in the app
        $date = $event->event_date ; 
        $time = $event->start_time;
        //convert the dateTime to the format accepted from google Calendar
        $dateTime = $date.' '.$time;
        //call the function from gcalendarControlelr to find the eventid in google Calendar
        $eventId = $controller->Find_g_EventByDatetTime($dateTime);
        $controller->gEventDelete($eventId);
        //delete the event in the app
        $event->delete();
        }
    }

    public function eventAddUser(Request $request)
    {  $user_id= $request->userId;
        $eventId= $request->id;
        //Use gCalendarController
        $controller = new gCalendarController;
        $typeId = gettype($request->id);
        //case event come from google calendar 
        if($typeId == "string" ){
            $gEvent= $controller->findEventById($eventId);  
            //format Goggle date time 
            $startTime = $gEvent->start->dateTime;
            $utc_date = $startTime;
            $timestamp = strtotime($utc_date);
            $date =new \DateTime();
            $date->setTimestamp($timestamp);
            $date->setTimezone(new \DateTimeZone('Europe/Paris'));
            $date= Carbon::parse($gEvent->start->dateTime)->format('Y-m-d') ;
            $time= Carbon::parse($gEvent->start->dateTime)->format('H:i:s') ;

            if($gEvent->transparency == "transparent" ){
                //select in google calendar
                $controller->select_gEevent($eventId, $user_id);
                 // save the slected event in the app database
                 $event = new Event;
                 $event->event_date = $date;
                 $event->start_time = $time;
                 $event->user_id=$user_id;
                 $event->save();
            }
        }else if($typeId == "integer" ){
        //select event in app
        $event=Event::find($eventId);
        $date=$event->event_date;
        $time=$event->start_time;
        $date=date('Y-m-d', strtotime($date));
        $time=date('H:i:s', strtotime($time));
        $dateTime = $date.' '.$time;
        $event->user_id = $user_id;
        $event->save();
        $gevent = $controller->Find_g_EventByDatetTime($dateTime);
        $controller->select_gEevent($gevent, $user_id);
    }
    }

    
    //api/user
    public function usersIndex(Request $request)
    {
        $users = User::all();
        return $users;

    }

}
