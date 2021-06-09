<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\customer\Customer; 
use App\Http\Requests\CustomerValidationRequest;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the customer resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search!=''){
            $count=Customer::where('customer_name','LIKE',"%{$request->search}%")->orWhere('customer_phone','LIKE',"%{$request->search}%")->orWhere('customer_email','LIKE',"%{$request->search}%")->orWhere('postcode','LIKE',"%{$request->search}%")->count();
            if($count==0){
            session()->flash("error","Customer not found");
            return redirect(route('customer.index'));
            }
            $list=Customer::where('customer_name','LIKE',"%{$request->search}%")->orWhere('customer_phone','LIKE',"%{$request->search}%")->orWhere('customer_email','LIKE',"%{$request->search}%")->orWhere('postcode','LIKE',"%{$request->search}%")->simplePaginate(10);
            return view('customer.index',compact('list'));
        }
        $list=Customer::orderBy('id','DESC')->simplePaginate(10);
        return view('customer.index',compact('list'));
    }

    /**
     * Show the form for creating a new customer resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerValidationRequest $request)
    {
        $store=new Customer;
        $store->customer_name=$request->customer_name;
        $store->customer_email=$request->customer_email;
        $store->customer_phone=$request->customer_phone;
        $store->customer_address=$request->customer_address;
        $store->country=$request->country;
        $store->city=$request->city;
        $store->state=$request->state;
        $store->postcode=$request->postcode;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('customer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Customer::find($id);
        return view('customer.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerValidationRequest $request, $id)
    {
        Customer::where('id',$id)->update([
            'customer_name'=>$request->customer_name,
            'customer_email'=>$request->customer_email,
            'customer_phone'=>$request->customer_phone,
            'customer_address'=>$request->customer_address,
            'country'=>$request->country,
            'city'=>$request->city,
            'state'=>$request->state,
            'postcode'=>$request->postcode,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('customer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
