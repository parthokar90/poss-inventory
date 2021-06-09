<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductValidationRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $req='';
        if($request->v_check!=null){
           if($request->varient_id==null){
               $req='required';
           }
        }
             return [
            'varient_id' => $req,
            'product_name' => 'required',
            'product_cost' => 'required',
            'product_price' => 'required',
            'product_alert_qty' => 'required',
            'product_brand' => 'required',
            'product_cat_id' => 'required',
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
            'varient_id.required'        => 'Please Select One Variant',
            'product_name.required'      => 'Please Enter Name',
            'product_cost.required'      => 'Please Enter Cost',
            'product_price.required'     => 'Please Enter Price',
            'product_alert_qty.required' => 'Please Enter Alert Quantity',
            'product_brand.required'     => 'Please Select Brand',
            'product_cat_id.required'    => 'Please Select Category',
        ];
    }
}
