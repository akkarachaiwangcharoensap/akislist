<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\Http\Requests\NewsRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{	
	/**
	 * Show news posts
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$news = News::all();

    	return view('admin.news.news', array(
    		'news' => $news
    	));
    }

    /**
     * Show news post page
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showPost($id)
    {
    	$post = News::find($id);

    	if (!$post) {
    		abort(404);
    	}

    	return view('admin.news.post', array(
    		'post' => $post
    	));
    }

    /**
     * Show news edit post page
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showEdit($id)
    {
    	$post = News::find($id);

    	if (!$post) {
    		abort(404);
    	}

    	return view('admin.news.edit', array(
    		'post' => $post
    	));
    }

    /**
     * Show new news post page
     * @return \Illuminate\Http\Response
     */
    public function showNew()
    {
    	return view('admin.news.new');
    }

    /**
     * Create a new news post
     *
     * @param NewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function add(NewsRequest $request)
    {
    	$validated = $request->validated();

    	$user = Auth::user();

    	if (!$user->can('user.admin.news.add')) {
    		abort(403, 'Access denied');
    	}

    	// Create new post
    	News::create($validated);

    	$posts = News::all();

    	return redirect()->route('admin.news', array(
    		'posts' => $posts
    	))->with('success', 'A news post is created.');
    }

    /**
     * Save a news post
     *
     * @param int $id
     * @param NewsRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function save(NewsRequest $request, $id)
    {
    	$validated = $request->validated();

    	$post = News::find($id);

    	if (!$post) {
    		abort(404);
    	}

    	$user = Auth::user();

    	if (!$user->can('user.admin.news.update')) {
    		abort(403, 'Access denied');
    	}

    	// Update news post
    	$post->update($validated);

    	return redirect()->route('admin.news.post.edit', array(
    		'post' => $post
    	))->with('success', 'A news post is updated.');
    }

    /**
     * Delete a news post
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	$post = News::find($id);

    	if (!$post) {
    		abort(404);
    	}

    	$user = Auth::user();

    	if (!$user->can('user.admin.news.delete')) {
    		abort(403, 'Access denied');
    	}

    	// Delete news post
    	$post->delete();

    	$posts = News::all();

    	return redirect()->route('admin.news', array(
    		'posts' => $posts
    	))->with('success', 'A news post is deleted.');
    }
}
