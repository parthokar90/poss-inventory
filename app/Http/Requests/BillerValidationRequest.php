<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillerValidationRequest extends FormRequest
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
            'company' => 'required',
            'logo' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'vat_no' => 'required',
            'gst_no' => 'required',
            'postcode' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
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
            'company.required'            => 'Please enter company name',
            'logo.required'               => 'Please select logo',
            'email.required'              => 'Please enter email',
            'phone.required'              => 'Please enter phone no',
            'vat_no.required'             => 'Please enter vat no',
            'gst_no.required'             => 'Please enter gst no',
            'postcode.required'           => 'Please enter postcode',
            'country.required'            => 'Please Enter country',
            'city.required'               => 'Please Enter city',
            'state.required'              => 'Please Enter state',
            'address.required'            => 'Please Enter address',
        ];
    }

}
