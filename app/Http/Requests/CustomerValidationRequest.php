<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerValidationRequest extends FormRequest
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
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'customer_address' => 'required',
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
            'customer_name.required'            => 'Please enter customer name',
            'customer_email.required'           => 'Please enter customer email',
            'customer_phone.required'           => 'Please enter phone no',
            'country.required'                  => 'Please enter country name',
            'city.required'                     => 'Please enter city',
            'state.required'                    => 'Please enter state',
            'postcode.required'                 => 'Please enter postcode',
            'customer_address.required'         => 'Please Enter customer address',
        ];
    }

}
