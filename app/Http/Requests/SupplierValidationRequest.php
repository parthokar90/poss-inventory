<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierValidationRequest extends FormRequest
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
            'supplier_name' => 'required',
            'supplier_email' => 'required',
            'supplier_phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'supplier_address' => 'required',
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
            'supplier_name.required'            => 'Please enter supplier name',
            'supplier_email.required'           => 'Please enter supplier email',
            'supplier_phone.required'           => 'Please enter phone no',
            'country.required'                  => 'Please enter country name',
            'city.required'                     => 'Please enter city',
            'state.required'                    => 'Please enter state',
            'postcode.required'                 => 'Please enter postcode',
            'supplier_address.required'         => 'Please Enter supplier address',
        ];
    }

}
