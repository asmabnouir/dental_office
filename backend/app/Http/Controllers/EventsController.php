<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
class EventsController extends Controller
{


    //fonctions Globales
    public function index(){
        $data=Event::all();
        foreach ($data as $event):
        $id= $event->id;
        $date=$event->event_date;
        $time=$event->start_time;
        $event->event_date=date('m/d/Y', strtotime($date)); //when i do 'm/d/Y' it's returning d/m/Y !!!!
        $event->start_time=date('h:i', strtotime($time));
        //$event->end_time = strval($event->start_time + 1);
        endforeach;
        return $data->tojson(); //$data is an object converted to json
       // return  Event::all();
    }

    
}