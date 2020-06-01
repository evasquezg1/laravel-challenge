<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;

class MailSend extends Controller
{
    public function mailsend(Request $request){

    	$details = [
    		'titulo' => $request->input('titulo'),
    		'descripcion' => $request->input('descripcion'),
    		'fecha' => $request->input('fecha'),
    	];

    	\Mail::to($request->input('email'))->send(new SendMail($details));
    	return view('emails.thanks');
    }
}
