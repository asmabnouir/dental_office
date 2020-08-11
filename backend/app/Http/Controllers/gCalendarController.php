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
            $freeEvents[] = $event ; 
        };
       }
       return response()->json($freeEvents);
  }
}
