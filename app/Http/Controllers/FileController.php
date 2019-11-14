<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

use App\File;

class FileController extends Controller
{
	/**
	 * Get a file from cloud
	 *
	 * @param string $folder
	 * @param string $name
	 *
	 * @return Image
	 */
    public function get ($folder, $name)
    {
    	$disk = Storage::disk('gcs');
    	$location = $folder . '/' . $name;

    	$file = File::where('folder', $folder)
    		->where('name', $name)
    		->first();

    	$upload = $file->upload;
    	$url = $upload->url;
    	$type = $upload->file_type;

    	// Read file from url
    	$file = file_get_contents($url);

    	return Response::make($file, 200)
    		->header('Content-Type', $type);
    }

    /**
     * Delete a file from cloud
     *
     * @param string $folder
     * @param string $name
     *
     * @return bool
     */
    public function delete ($folder, $name)
    {
    	$user = Auth::user();
    	$disk = Storage::disk('gcs');

    	$folder = $user->unique_string;
    	$location = $folder . '/' . $name;

    	$file = File::where('folder', $folder)
    		->where('name', $name)
    		->first();

    	if ($file->user->id != $user->id) {
    		abort(403);
    	}

    	$types = array(
    		'image/png' => '.png',
    		'image/jpeg' => '.jpeg',
    		'image/jpg' => '.jpg'
    	);

    	$upload = $file->upload;

    	$type = $types[$upload->file_type];
    	// https://storage.googleapis.com/akislist/public/uploads/images/{folder}/{name}
    	$target = $folder.'/images/'.$upload->unique_string.'-'.$upload->file_name.$type;

    	$upload->delete();

    	// Remove file from url
    	return json_encode($disk->delete($target));
    }

}
