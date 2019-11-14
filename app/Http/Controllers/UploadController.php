<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Upload;
use App\File;
use App\SaleItem;

class UploadController extends Controller
{
    /**
     * Get geolocations
     * 
     * @param Request $request
     * @param string $random
     *
     * @return \Illuminate\Database\Eloquent\Collection $geolocations
     */
    public function uploadImage (Request $request, $random)
    {
    	$files = $_FILES['files'];
    	
    	$user = Auth::user();

    	$saleItem = SaleItem::byAuthorOne($random);

    	if (isset($saleItem) == false || empty($saleItem)) {
    		abort(403);
    	}

    	$validated = Upload::validateImages ($files);

    	// Server validation files
    	if (!$validated) {
    		$error = array(
    			'error' => array(
	    			'message' => 'Please verify your file(s)',
	    			'size' => '24 MB',
	    			'allows' => ['jpg', 'jpeg', 'png']
    			)
    		);

    		return json_encode($error);
    	}

    	$disk = Storage::disk('gcs');
    		
    	for ($i = 0; $i < count($files['name']); $i++) {

    		$fullname = $files['name'][$i];

    		$exploded = explode('.', $fullname);

    		$name = str_slug($exploded[0]);
    		$extension = $exploded[1];

    		$type = $files['type'][$i];
    		$content = file_get_contents($files['tmp_name'][$i]);
    		
    		$uploadRandom = rand(32, 64);
    		$uploadRandomString = str_random($uploadRandom);

			// {user_string}/images/{upload_string}/{image_name}    		
    		$url = $disk->url($user->unique_string .'/images/' . $uploadRandomString.'-'.$name.'.'.$extension);

    		// Upload mass assignment
    		$upload = array(
    			'user_id' => $user->id,
    			'sale_item_id' => $saleItem->id,
    			'file_name' => $name,
    			'file_type' => $type,
    			'url' => $url,
    			'unique_string' => $uploadRandomString
    		);

    		// Create a new upload
    		$upload = Upload::create($upload);

    		// Generate a new sequence for global files
    		$fileRandom = rand(32, 86);
    		$fileRandomString = str_random($fileRandom);

	    	// File mass assignment
	    	$file = array(
	    		'user_id' => $user->id,
	    		'folder' => $user->unique_string,
	    		'upload_id' => $upload->id,
	    		'name' => $fileRandomString
	    	);

	    	$file = File::create($file);

	    	// Cloud file mass assignment
	    	// /files/{folder}/{name}
    		$url = config('app.url').'/files/'.$user->unique_string.'/'.$fileRandomString;
	    	$cloudFile = array(
    			'name' => $name.'.'.$extension,
    			'content' => $content,
    			'unique_string' => $uploadRandomString,
    			'url' => $url
			);

    		// upload file to cloud storage
    		return Upload::uploadToCloud($cloudFile);
    	}

    	return json_encode(array('message' => 'unknown'));
    }
}









