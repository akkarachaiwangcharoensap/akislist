<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
	/**
	 * Table
	 * @var string $table
	 */
	protected $table = 'provinces';

	/**
	 * Get a province by its name, and country
	 *
	 * @param string $name
	 * @param string $country
	 *
	 * @return App\Province $province
	 */
	public static function getBy($name, $country)
	{
		$name = reverse_str_slug($name);

		$province = Self::where('name', $name)
			->where('code', 'like', $country.'%')
			->first();
		
		$code = explode('.', $province->code);
		$province->code = $code[1];
		
		return $province;
	}

	/**
	 * Get province / state code
	 *
	 * @param string $countryCode
	 * @return \Illuminate\Database\Eloquent\Collection $codes
	 */
	public function getAll($countryCode)
	{
		$provinces = $this->where('code', 'like', $countryCode.'%')->get();

		$provinces = $provinces->filter(function ($province) {
			$code = explode('.', $province->code);
			$province->code = $code[1];

			return true;
		});

		return $provinces;
	}
}
