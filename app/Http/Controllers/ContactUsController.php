<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use App\ContactReason;
use App\Contact;

use App\Http\Requests\ContactRequest;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Show the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$contactReasons = ContactReason::all()->pluck('name', 'id');

    	$metadata = array(
    		'title' => 'AkisList | Contact Us'
    	);

        return view('contact-us', array(
        	'contactReasons' => $contactReasons,
        	'metadata' => $metadata
        ));
    }

    /**
     * Send contact message
     * 
     * @param ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function send(ContactRequest $request)
    {
    	// validate incoming requests
    	$validated = $request->validated();

    	$ip = $_SERVER['REMOTE_ADDR'];
    	$options = array(
    		'ip' => $ip
    	);

    	$data = array_merge($validated, $options);

    	// Create new contact
    	$contact = Contact::create($data);

    	// Send confirmation message to the requester
    	Mail::send('templates.mail.contact-message-response', [], function ($message) use ($data) {
    		$message->subject('Customer Support');
    		$message->to($data['email']);
    	});

    	// Send email message to us
    	Mail::send('templates.mail.contact-message', ['contact' => $contact], function ($message) use ($contact) {
    		$message->subject($contact->reason->name);
    		$message->to(config('mail.from.address'));
    	});

    	return redirect()->route('contact')->with('success', 'Your message is sent successfully.');
    }
}


