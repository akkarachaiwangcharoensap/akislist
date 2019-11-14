<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	/**
	 * Table
	 * @var string $table
	 */
	protected $table = 'contacts';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'contact_reason', 'message', 'ip'
    ];

    /**
     * Get contact reason
     * @return App\ContactReason
     */
    public function reason()
    {
    	return $this->belongsTo('App\ContactReason', 'contact_reason');
    }
}
