<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'company_name' => 'required',
            'company_email' => 'required',
            'company_phone' => 'required',
            'country' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_postcode' => 'required',
            'company_address' => 'required',
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
            'company_name.required'            => 'Please enter company name',
            'company_email.required'           => 'Please enter company email',
            'company_phone.required'           => 'Please enter phone no',
            'country.required'                 => 'Please enter country name',
            'company_city.required'            => 'Please enter city',
            'company_state.required'           => 'Please enter state',
            'company_postcode.required'        => 'Please enter postcode',
            'company_address.required'         => 'Please Enter company address',
        ];
    }

}
