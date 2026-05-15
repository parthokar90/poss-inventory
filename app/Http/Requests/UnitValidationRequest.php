<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitValidationRequest extends FormRequest
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
        return [
            'unit_name' => 'required',
            'unit_value' => 'required',
        ];
    }
    /**
     * Get the validation custom message that apply to the view.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unit_name.required'       => 'Please enter unit name',
            'unit_value.required'      => 'Please enter unit value',
        ];
    }

}
