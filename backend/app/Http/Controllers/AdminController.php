<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    $this->middleware('auth.role:admin');
}
    //fonction sur events admin
    public function create(Request $request)
    {
        $event = new Event;
        $date=$request->event_date;
        $time=$request->start_time;
        $date=date('Y-m-d', strtotime($date));
        $time=date('h:i:s', strtotime($time));
        $event->event_date = $date;
        $event->start_time = $time;
        $event->user_id=0;
        $event->save();
        return response($event);
    }

}
