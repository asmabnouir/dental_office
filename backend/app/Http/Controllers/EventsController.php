<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
class EventsController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('auth')->except(['index']);
    }


    //fonctions Globales
    public function index(){
        $data=Event::all();
        foreach ($data as $event):
        $id= $event->id;
        $date=$event->event_date;
        $time=$event->start_time;
        $event->event_date=date('d/m/Y', strtotime($date));
        $event->start_time=date('h:i', strtotime($time));
        //$event->end_time = strval($event->start_time + 1);
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
    }

    //Fonctions Client

    public function select(Request $request){
        $event=Event::find($request->id);
        if($event->user_id === 0 ){
            $user = auth()->user($request->token);
            $user_id=$user->id;
            $event->user_id = $user_id;
            $event->save();
            return $event;
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

}