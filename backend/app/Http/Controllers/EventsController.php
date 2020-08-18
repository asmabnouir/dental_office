<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use \Illuminate\Support\Arr;
use App\Http\Controllers\gCalendarController;
class EventsController extends Controller
{


    //fonctions Globales
    public function index(){
        //get event from database 
        $data=Event::all();
        foreach ($data as $event):
        $id= $event->id;
        $date=$event->event_date;
        $time=$event->start_time;
        $event->event_date=date('d/m/Y', strtotime($date)); 
        $event->start_time=date('h:i', strtotime($time));
        //$event->end_time = strval($event->start_time + 1);
        endforeach;

        //get events frm google as an array 
        $controller = new gCalendarController;
        $gData = $controller->index();
        //convert the data from database to get an array
        $data= json_decode($data, true);

        /////////////////////////////work in progress/////////////////////////////
        //trying to find a solution for the delete from google calendar 

        //getDateTimes from  data
        $gDataDate= array();
         foreach ($gData as $event) {
            $gDataDate[]=  $event["dateTime"];
        }
        
        //check if all events in db are in google ( vérifier si l y a une suppression d'event dans google )
        $eventsToDelete= array();
        foreach ($data as $event) {
        $dateTime = $event['event_date'] . ' ' . $event['start_time'] ;
        $check = in_array($dateTime, $gDataDate);
        if($check === false){
            $eventsToDelete[]= $event['id'];
        }
        }
        //delete the event from db 
         //find the id of the event to delete in the app 
         foreach ($eventsToDelete as $id) {
         $event=Event::find($id);
         $event->delete();
         }
        
        //var_dump($eventsToDelete);


        
        $finalData = array_merge( $data, $gData);
        return response()->json($finalData); //$final data is a merged array of data from database and google data 

    }

    
}