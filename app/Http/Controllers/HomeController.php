<?php

namespace App\Http\Controllers;

use App\Page;
use App\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Jobs\ProcessResetPassword;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('home');
    }

    /**
     * Show the getting started page
     *
     * @return Illumiate\Http\Response
     */
    public function showGettingStarted()
    {
    	$metadata = array(
    		'title' => 'AkisList | Getting Started'
    	);

    	return view('getting-started', array(
    		'metadata' => $metadata
    	));
    }

    /**
     * Show the credits page
     *
     * @return Illuminate\Http\Response
     */
    public function showCredits()
    {
    	// credit page
    	$page = Page::credits();

    	$metadata = array(
    		'title' => 'AkisList | Credits'
    	);

    	return view('credits', array(
    		'page' => $page,
    		'metadata' => $metadata
    	));
    }

    /**
     * Show news page
     *
     * @return Illuminate\Http\Response
     */
    public function showNews()
    {
    	// news posts
    	$posts = News::top(10);

    	$metadata = array(
    		'title' => 'AkisList | News'
    	);

    	return view('news', array(
    		'posts' => $posts,
    		'metadata' => $metadata
    	));
    }
}
