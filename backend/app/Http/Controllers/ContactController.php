<?php

use Illuminate\Support\Facades\Mail;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submitForm(Request $request){
      
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        //Mail::to( config('mydentaloffice.email@gmail.com') )->send( new ContactEmail($request->only(['name', 'email', 'message'])) );
       /* \Mail::raw('mailtestBdy', function($message) {
            $message->to('mydentaloffice.email@gmail.com', 'testname')->subject
               ('test email subject');
            $message->from('xyz@gmail.com','Virat Gandhi');
         });*/
         if ($data){
         \Mail::raw($request->message, function ($message) use($request) {
            $message->to('mydentaloffice.email@gmail.com')->subject('Dental _office contact from : '.$request->name);
              $message->from();
          });
         }

        return response()->json(" mail ok ");
    }
    }