<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class TermOfServicesController extends Controller
{
    /**
     * Show the term of services page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$page = Page::TermOfServices();

    	if (!$page) {
    		abort(404);
    	}

    	$metadata = array(
    		'title' => 'AkisList | Term Of Services'
    	);
    	
        return view('term-of-services', array(
        	'page' => $page,
        	'metadata' => $metadata
        ));
    }
}
