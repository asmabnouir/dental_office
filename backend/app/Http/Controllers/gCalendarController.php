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
    //$event->startDateTime = Carbon::create($DateTime);
    
    $event->startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $DateTime, 'Europe/Paris');
    $event->endDateTime=  Carbon::createFromFormat('Y-m-d H:i:s', $DateTime, 'Europe/Paris')->addMinute(30);
   /* $event->startDateTime = $DateTime;
    $event->endDateTime = Carbon::now()->addMinute(30);*/
    $event->transparency = 'transparent';
    $event->save();
  }

  public function Find_g_EventByDatetTime($dateTime){
    $events = Event::get();
    $e=null;
    foreach ($events as $event){
      //convertir le start dateTime en format Y-m-d H:i:s
      $startTime = $event->start->dateTime;
      $utc_date = $startTime;
      $timestamp = strtotime($utc_date);
      $date =new \DateTime();
      $date->setTimestamp($timestamp);
      $date->setTimezone(new \DateTimeZone('Europe/Paris'));
      $startTime = $date->format('Y-m-d H:i:s');
      //  trouver l'id de l'event slectionné 
      if( $startTime == $dateTime){ 
          $e = $event->id;
        };
       }
       return $e ;
       
  }

  public function gEventDelete($eventId){
   // $eventId= $this->Find_g_EventByDatetTime($dateTime);
    $event = Event::find($eventId);
    $event->delete();
    //return response()->json($event);
  }
}
