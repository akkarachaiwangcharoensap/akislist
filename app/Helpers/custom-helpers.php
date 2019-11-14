<?php

if (! function_exists('reverse_str_slug')) {
    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string  $slug
     * @param  string  (optional) $separator
     * @return string
     */
    function reverse_str_slug($slug, $separator = '-')
    {
        return ucwords(str_replace($separator, ' ', $slug));
    }

    /**
     * Generate a URL string based on the given upload
     *
     * @param App\Upload $upload
     * @return string $url
     */
    function upload_url($upload)
    {
    	return route('request.files.file.get', array(
    		'folder' => $upload->file->folder,
    		'name' => $upload->file->name
    	));
    }

    /**
     * Shorten or turn "Burnaby, British Columbia" into "Burnaby, BC"
     *
     * @param string $location
     * @return string
     */
    function shorten_location($location)
    {
    	$exploded = explode(', ', $location);

    	$city = isset($exploded[0]) ? $exploded[0] : null;
    	$province = isset($exploded[1]) ? $exploded[1] : null;
    	
    	// If not exploding, returns the string
    	if (isset($province) == null || isset($city) == null) {
    		return $location;
    	}

    	$capitalLetters = array();
    	preg_match_all('/[A-Z]+/m', $province, $capitalLetters);

    	$capitalLetters = collect($capitalLetters)->flatten();

    	$letters = '';
    	$capitalLetters->each(function ($capitalLetter) use (&$letters) {
    		$letters = $letters.$capitalLetter;
    	});

    	$province = $letters;
    	$location = $city . ', ' . $province;

    	return $location;
    }
}