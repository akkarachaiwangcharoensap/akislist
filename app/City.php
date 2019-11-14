<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	/**
	 * City Table
	 * @var string $table
	 */
	protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name', 'country_code'
	];

	/**
	 * Get cities based on give country
	 *
	 * @param string $country
	 * @param (optional) int $limit
	 *
     * @return \Illuminate\Database\Eloquent\Collection $cities
	 */
	public static function getCities($country, $limit = 1000)
	{
		return Self::where('country_code', $country)
			->take($limit)
			->get();
	}

	/**
	 * Get cities by similar name
	 *
	 * @param string $name
	 * @param string $country
	 * @param (optional) int $limit
	 *
	 * @return \Illuminate\Database\Eloquent\Collection $cities
	 */
	public static function getSimilar($name, $country, $limit = 1000)
	{
		return Self::where('name', 'like', $name.'%')
			->where('country_code', $country)
			->take($limit)
			->get();
	}
}
