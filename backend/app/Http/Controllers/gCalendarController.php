<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
use Google_Client;
use Google_Service_Calendar;
class gCalendarController extends Controller
{
  public function index( ){
    //echo("hello word");
   $events = Event::get();
   return $events;
   //return json_encode($events);
  }
}
