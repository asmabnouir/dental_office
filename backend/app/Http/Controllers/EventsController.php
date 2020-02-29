<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
class EventsController extends Controller
{
    public function create(Request $request)
    {
        dd($request);
        $event = new Event;
        $event->event_date = $request->event_date;
        $event->start_time = $request->start_time;
        $event->save();
        return response()->json(['message' => 'your event is created ' ]);

        /*$event = Event::create([
            $event= $this->event->request('event_date'),
            $event= $this->event->request('start_time')
        ]);
        $event->save();
        return  response()->json(['message' => 'your event is created ' ]);*/

        //Event::create($request->all());
    }

    public function index(){
        return  Event::all();
    }
}