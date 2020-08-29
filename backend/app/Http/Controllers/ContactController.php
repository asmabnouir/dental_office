<?php

use Illuminate\Support\Facades\Mail;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submitForm(Request $request){
        //Check that all requestes are valid
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
         if ($data){
            //Send email 
         \Mail::raw($request->message, function ($message) use($request) {
            $message->to('mydentaloffice.email@gmail.com')->subject('Dental _office contact from : '.$request->name);
              $message->from($request->email);
          });
         }

        return response()->json();
    }
    }