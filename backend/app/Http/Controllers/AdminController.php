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
    //$this->middleware('auth.role:admin');
}
    //fonction sur events admin
    public function create(Request $request)
    {
        $event = new Event;
      $date=$request->date;
       //$date= "17-04-2020";
        var_dump($date);
        $time=$request->time;
        $date=date('Y-m-d', strtotime($date));
        $time=date('h:i:s', strtotime($time));
        var_dump($date);
        $event->event_date = $date;
        $event->start_time = $time;
        $event->user_id=0;
        $event->save();
        return response($event);
    }

    public function delete(Request $request)
    {
        $event=Event::find($request->id);
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
