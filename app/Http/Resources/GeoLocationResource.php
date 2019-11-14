<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeoLocationResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
	    	'id' => $this->geoname_id,
        	'name' => $this->name,
        	'asciiname' => $this->asciiname,
        	'latitude' => $this->latitude,
        	'longitude' => $this->longitude,
        	'feature_class' => $this->feature_class,
        	'country' => $this->country_code,
        	'province' => $this->admin1_code,
        	'timezone' => $this->timezone
		];
    }
}
