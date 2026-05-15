<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WareHouseValidationRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
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
            'name.required'        => 'Please enter name',
            'phone.required'       => 'Please enter phone',
            'email.required'       => 'Please enter email',
            'address.required'     => 'Please enter address',
        ];
    }

}
