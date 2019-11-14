<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	/**
	 * Table
	 * @var $table
	 */
    protected $table = 'news';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content'
    ];

    /**
     * Get monthly news posts
     * @return Collection App\News
     */
    public static function monthly()
    {
    	$now = date('n');
    	$posts = News::where(DB::raw('MONTH(`created_at`)'), '=', $now)
    		->orderBy('created_at', 'desc')
    		->get();

    	return $posts;
    }

    /**
     * Get latest posts of a given number
     * @return Collection App\News
     */
    public static function top($number = 10)
    {
    	$posts = News::take($number)
    		->orderBy('created_at', 'desc')
    		->get();

    	return $posts;
    }
}
