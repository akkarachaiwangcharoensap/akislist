<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Utility\File\Visibility;
use App\File;

class Upload extends Model
{
    /**
	 * Table
	 * @var string $table
	 */
	protected $table = 'uploads';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'sale_item_id', 'url', 'file_name', 'file_type', 'unique_string'
    ];

    /**
     * Get the uploaded file
     * @return App\File
     */
    public function file ()
    {
    	return $this->hasOne('App\File');
    }

    /**
     * Validate image extension
     *
     * @param array $images
     * @return bool
     */
    public static function validateImages ($images)
    {	
    	// allow these extensions
    	$extensions = array('image/jpeg', 'image/png', 'image/jpg');

    	$pass = false;
    	$i = 0;
    	
    	foreach ($images['type'] as $type) {
			$size = $images['size'][$i];

			foreach ($extensions as $extension) {
				if ($type == $extension) {
					$pass = true;
					break;
				}
			}
			// Max size: 24 MB
			if ($size < 25165824) {

				$pass = true;
				break;
			}

			$i++;
		}

    	return $pass;
    }

    /**
     * Upload a file to cloud
     *
     * @param array $file
     * @return void
     */
    public static function uploadToCloud ($file)
    {
    	$user = Auth::user ();
    	$disk = Storage::disk('gcs');

    	$name = $file['unique_string'] . '-' . $file['name'];
    	$location = $user->unique_string . '/images/' . $name;

    	// Creating a file on cloud
    	$disk->put($location, $file['content'], Visibility::ALL);

    	$message = array(
    		'success' => array(
	    		'message' => 'File(s) uploaded.',
	    		'image' => $file['url']
	    	)
    	);

    	return json_encode($message);
    }

    /**
     * Delete a file from cloud
     *
     * @param string $url
     * @return void
     */
    public static function deleteFile ($url)
    {
    	$user = Auth::user();
    	$disk = Storage::disk('gcs');

    	return json_encode($url);
    }
}









