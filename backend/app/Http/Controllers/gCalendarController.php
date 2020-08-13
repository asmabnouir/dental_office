<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
use Google_Client;
use Google_Service_Calendar;
class gCalendarController extends Controller
{

  public function index(){
    //get all events 
    $events = Event::get();
    //get all eventsnames
   /* $eventNameList=array();
   foreach ($events as $event){
    $eventNameList[] = $event->summary;
   }
   return response()->json($eventNameList);*/
   return $events;
  }
  public function getFreeEvents(){
    $events = Event::get();
    $freeEvents=array();
    foreach ($events as $event){
        if($event->transparency == "transparent"){
            $freeEvents[] = $event->start->dateTime; 
        };
       }
       return response()->json($freeEvents);
  }

  public function createGEvent($DateTime){
    $event = new Event;
    $event->name = 'RdvFree';
    $event->startDateTime = $DateTime;
    $event->endDateTime = Carbon::now()->addMinute(30);
    $event->transparency = 'transparent';
    //$event->save();
  }

  public function FindEventByDatetTime( $dateTime){
    $events = Event::get();
    $e=null;
    foreach ($events as $event){
        if( $event->start->dateTime == $dateTime){
            $e = $event->id;
        };
       }
       return response()->json($e);
  }

  public function delete($eventId){
    $event = Event::find($eventId);

    $event->delete();
  }
}
