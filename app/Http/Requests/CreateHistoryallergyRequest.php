<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHistoryallergyRequest extends FormRequest {

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
		return [
            'user_id' => 'not_in:0', 
			'allergy_id' => 'required|not_in:0' 
		];
	}

	public function messages()
    {
        return [
			'user_id.not_in' => 'Choose user',
			'allergy_id.not_in' => 'Choose allergy'
        ];
    }
}
