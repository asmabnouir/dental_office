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
        $event->event_date=date('D M d Y h:i:s', strtotime($date));
        $event->start_time=date('G', strtotime($time));
        $event->end_time = strval($event->start_time + 1);
        endforeach;
        return $data->tojson(); //$data is an object converted to json
       // return  Event::all();
    }
    //fonction admin 
    public function create(Request $request)
    {
        $event = new Event;
        $date=$request->event_date;
        $time=$request->start_time;
        $date=date('Y-m-d', strtotime($date));
        $time=date('h:i:s', strtotime($time));
        $event->event_date = $date;
        $event->start_time = $time;
        $event->save();
        return response($event);
        //Event::create($request->all());
    }

    //Fonctions Client
    public function select(Request $request){
        $date=$request->event_date;
        $time=$request->start_time;
        $date=date('Y-m-d', strtotime($date));
        $time=date('h:i:s', strtotime($time));
    }
}