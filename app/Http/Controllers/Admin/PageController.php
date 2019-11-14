<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Page;

use App\Http\Requests\PageRequest;

use App\Events\UserBanned;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Show the reported sale items
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$pages = Page::all();

    	return view('admin.pages.pages', array(
    		'pages' => $pages
    	));
    }

    /**
     * Show new page
     * @return \Illuminate\Http\Response
     */
    public function showNew()
    {
    	return view('admin.pages.new');
    }

    /**
     * Show page
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function showPage($id)
    {
    	$page = Page::find($id);

    	// Make sure page is found
    	if (!$page) {
    		abort (404);
    	}

    	$user = Auth::user();
    	
    	// make sure the user has the permission to view the page
    	if (!$user->can('user.admin.page.view')) {
    		abort (403, 'Access denied');
    	}

    	return view('admin.pages.page', array(
    		'page' => $page
    	));
    }

    /**
     * Show edit page
     *
     * @param int id
     * @return \Illuminate\Http|Response
     */
    public function showEdit($id)
    {
    	$page = Page::find($id);

    	// Make sure page is found
    	if (!$page) {
    		abort (404);
    	}

    	$user = Auth::user();
    	
    	// make sure the user has the permission to view the page
    	if (!$user->can('user.admin.page.view')) {
    		abort (403, 'Access denied');
    	}

    	return view('admin.pages.edit', array(
    		'page' => $page
    	));
    }

    /**
     * Add new page
     * 
     * @param PageRequest
     * @return \Illuminate\Http\Response
     */
    public function add(PageRequest $request)
    {
    	$validated = $request->validated();
    	$user = Auth::user();

    	// Make sure the user has the permission to add new page
    	if (!$user->can('user.admin.page.add')) {
    		abort(403, 'Access denied');
    	}

    	Page::create($validated);

    	$pages = Page::all();

    	return redirect()->route('admin.pages', array(
    		'pages' => $pages
    	));
    }

    /**
     * Save the page
     *
     * @param PageRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function save(PageRequest $request, $id)
    {
    	$validated = $request->validated();
    	$user = Auth::user();

    	if (!$user->can('user.admin.page.update')) {
    		abort(403, 'Access denied');
    	}

    	$page = Page::find($id);

    	if (!$page) {
    		abort(404);
    	}

    	$page->update($validated);

    	return back()->with('success', 'Page is updated.');
    }

    /**
     * Delete the page
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	$user = Auth::user();

    	if (!$user->can('user.admin.page.delete')) {
    		abort(403, 'Access denied');
    	}

    	$page = Page::find($id);

    	if (!$page) {
    		abort(404);
    	}

    	// permanently delete the page
    	$page->delete();

    	$pages = Page::all();

    	return redirect()->route('admin.pages', array(
    		'pages' => $pages
    	))->with('success', 'Page is deleted.');
    }
}









