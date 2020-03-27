<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role:client');
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
