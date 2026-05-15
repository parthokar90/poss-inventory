<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValidationRequest extends FormRequest
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
            'varient_name' => 'required',
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
            'varient_name.required'      => 'Please enter attribute',
        ];
    }

}
