<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	/**
	 * Table
	 * @var string $table
	 */
    protected $table = 'pages';

    /**
     * Term of services page
     * @var const int TERM_OF_SERVICES
     */
    public const TERM_OF_SERVICES = 1;

    /**
     * Privacy policy page
     * @var const PRIVACY_POLICY
     */
    public const PRIVACY_POLICY = 2;

    /**
     * Credits page
     * @var const CREDITS
     */
    public const CREDITS = 3;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content'
    ];

    /**
     * Get term of services page
     * @return App\Page
     */
    public static function TermOfServices()
    {
    	return Page::find(Page::TERM_OF_SERVICES);
    }

    /**
     * Get privacy policy page
     * @return App\Page
     */
    public static function PrivacyPolicy()
    {
    	return Page::find(Page::PRIVACY_POLICY);
    }

    /**
     * Get credits page
     * @return App\Page
     */
    public static function Credits()
    {
    	return Page::find(Page::CREDITS);
    }
}


