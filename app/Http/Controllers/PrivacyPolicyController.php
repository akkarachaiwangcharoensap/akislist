<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    /**
     * Show the privacy policy page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$page = Page::PrivacyPolicy();

    	if (!$page) {
    		abort(404);
    	}

    	$metadata = array(
    		'title' => 'AkisList | Term Of Services'
    	);

        return view('privacy-policy', array(
        	'page' => $page,
        	'metadata' => $metadata
        ));
    }
}
