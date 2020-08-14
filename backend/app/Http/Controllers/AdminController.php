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
    //$this->middleware('auth.role:admin');
}
    //fonction sur events admin
    public function create(Request $request)
    {
        $event = new Event;
        $date=$request->date;
        var_dump($date);
        $time=$request->time;
        $date=date('Y-m-d', strtotime($date));
        $time=date('h:i:s', strtotime($time));
        var_dump($date);
        $event->event_date = $date;
        $event->start_time = $time;
        $event->user_id=0;
        $event->save();
        $dateTime = Carbon::parse($date.$time)->locale('fr');

        $controller = new gCalendarController;
        $controller->createGEvent($dateTime);
        return response($event);
    }

    public function delete(Request $request)
    {   //find the id of the event to delete in the app 
        $event=Event::find($request->id);
        //get the dateTime from the event in the app
        $date = $event->event_date ; 
        $time = $event->start_time;
        //convert the dateTime to the format accepted from google Calendar
        $dateTime = Carbon::parse($date.$time)->locale('fr');
        //call the function from gcalendarControlelr to find the eventid in google Calendar
        $controller = new gCalendarController;
        $g_eventd = $controller->Find_g_EventByDatetTime($dateTime);
        //Delete the event in google Calendar 
        $controller->gEventDelete($dateTime);
        //delete the event in the app 
        $event->delete();


    }

    public function eventAddUser(Request $request)
    {
        $user_id= $request->userId;
        $event= $request->id;
        $event=Event::find($event);
        $event->user_id = $user_id;
        $event->save();

    }

    
    //api/user
    public function usersIndex(Request $request)
    {
        $users = User::all();
        return $users;

    }

}
