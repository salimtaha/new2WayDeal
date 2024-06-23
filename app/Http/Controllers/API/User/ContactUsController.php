<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate(
            [
                'subject'=>'required|string|max:255',
                'message'=>'required|string'
            ]
        );

        $contact = Contact::create(
            [
                'name'=>auth()->user()->name,
                'email'=>auth()->user()->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
                'ip_address' => $request->ip()
            ]
        );

        return SendResponse(200, 'Message Sent Successfully', $contact);
    }
}
