<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GeoLocation;
use App\Province;
use App\City;

use App\Http\Resources\GeoLocationResource;
use App\Http\Resources\CityResource;

class GeoLocationController extends Controller
{
    /**
     * @deprecated
     *
     * Get geolocations
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection $geolocations
     */
    public function index(Request $request)
    {
    	$json = json_encode(new GeoLocationResource(GeoLocation::all()));
    	return $json;
    }

    /**
     * Get geo location based on a given name
     * 
     * @param Request $request
     * @return json $geolocations
     */
    public function similar(Request $request)
    {
    	$data = $request->all();

    	$country = $data['country'];
    	$name = $data['name'];

    	$geolocations = null;

    	if (isset($name) && isset($country)) {
    		$cities = CityResource::collection(City::getSimilar($name, $country, 8));
    	}
    	
    	return $cities;
    }
}









