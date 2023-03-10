<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitnatureRequest extends FormRequest {

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
            'alias' => 'required|unique:visitnature,alias,'.$this->visitnature, 
		];
	}

	public function messages()
    {
        return [
            'alias.required' => 'Enter alias for visit nature',
			'alias.unique' => 'Alias visit nature must be unique',
        ];
    }
}
