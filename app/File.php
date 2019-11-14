<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
	 * City Table
	 * @var string $table
	 */
	protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'user_id', 'upload_id', 'folder', 'name'
	];

	/**
	 * Get uploaded file relationship
	 * @return App\Upload
	 */
	public function upload ()
	{
		return $this->belongsTo('App\Upload', 'upload_id');
	}

	/**
	 * Get the ownership of the file
	 * @return App\User
	 */
	public function user ()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
