<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Province;

use App\Utility\Geography\Province as GeographyProvince;
use App\Utility\Geography\Country;

class GeoLocation extends Model
{
	/**
     * Users Table
     * @var string $table
     */
    protected $table = 'geolocations';

    /**
     * Feature Class Identification
     * @var const CityClass
     */
    public const CityClass = 'P';

    /**
     * Get city based on a given name
     *
     * @param string $name
     * @param string $country
     *
     * @return GeoLocation $city
     */
    public function getCity ($name, $country, $province)
    {
    	/**
    	 * feature_class: Class ID to identify the property. Refer to readme.txt from geonames
    	 * name: name of the city
    	 * country_code: Code of the country 
    	 * admin1_code: province / state code
    	 */
    	$city = $this
    		->where('name', $name)
    		->where('country_code', $country)
    		->where('feature_class', 'like', '%'.GeoLocation::CityClass.'%')
    		->where('admin1_code', $province)
    		->first();

    	$province = Province::where('code', $country.'.'.$province)
    		->first();

    	$city['province'] = $province;
    	
    	return $city;
    }

    /**
     * Get similar cities based on a given name
     *
     * @param string $name
     * @param string $country
     *
     * @return \Illuminate\Database\Eloquent\Collection $cities
     */
    public function getSimilarCities ($name, $country, $province)
    {
    	/**
    	 * feature_class: Class ID to identify the property. Refer to readme.txt from geonames
    	 * name: name of the city
    	 * country_code: Code of the country 
    	 * admin1_code: province / state code
    	 */
    	$cities = $this
    		->where('name', 'like', $name.'%')
    		->where('country_code', $country)
    		->where('feature_class', 'like', '%'.GeoLocation::CityClass.'%')
    		->where('admin1_code', $province)
    		->get();

    	$province = Province::where('code', $country.'.'.$province)
    		->first();

    	foreach ($cities as $city) {
    		$city['province'] = $province;
    	}
    	
    	return $cities;
    }

    /**
     * Get cities based on a given country code
     * 
     * @param string $country
     * @param int limit 
     *
     * @return \Illuminate\Database\Eloquent\Collection $cities
     */
    public function getCities ($country, $limit = 1000)
    {
    	/**
    	 * feature_class: Class ID to identify the property. Refer to: readme.txt from geonames
    	 * country_code: Code of the country
    	 * admin1_code: province / state code
    	 */
		$cities = $this
			->where('feature_class', 'like', '%'.GeoLocation::CityClass.'%')
			->where('country_code', $country)
			->take($limit)
			->get();

		return $cities;
    }

    /**
     * Get province with a given name and the country
     *
     * @return App\Province
     */
    public function getProvince()
    {
    	$code = $this->country_code.'.'.$this->admin1_code;

    	$province = Province::where('code', $code)
    		->first();

    	return $province;
    }

    /**
     * Get provinces based on a given country code
     *
     * @param string $countryCode
     * @return \Illuminate\Database\Eloquent\Collection $provinces
     */
    public function getProvinces ($countryCode)
    {
    	return (new Province)->getAll($countryCode);
    }

    /**
     * Get user's location based on the given up
     *
     * @param string ip
     * @return json response
     */
    public static function get ($ip)
    {
    	$token = '35c5d4b14596d4';
    	$api = 'https://ipinfo.io/' . $ip;//?token='.$token;

    	$curl = curl_init();

    	// Set url to send a request to
    	curl_setopt($curl, CURLOPT_URL, $api);

    	// Return response as a string
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    	// Send a request
    	$response = curl_exec($curl);

    	// Close the connection
    	curl_close($curl);

    	$json = json_decode($response);

    	return $json;
    }

}







