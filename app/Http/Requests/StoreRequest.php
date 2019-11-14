<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array(
			'title' => array(
				'required',
				'min:3',
				'max:255',
				'not_regex:/[-!$%^&*@#()\\\\_+|~=`{}\[\]:";\'<>?,.\/]/mi'
			),
			'description' => 'required|min:3',
			'price' => 'required|between:0,99999999.99|numeric',
			'keywords' => array(
				'required',
				'min:1',
				'max:100',
			),
			'store_category_id' => 'required',
			'location' => 'required|min:3|max:255',
			'country_code' => 'required|min:1|max:2',
			'live' => '',
		);
    }

    public function messages()
    {
    	return array(
    		'title.not_regex' => 'No symbols are allowed.',
    		'keywords.not_regex' => 'No symbols are allowed.'
    	);
    }
}
