<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\supplier\Supplier; 
use App\Http\Requests\SupplierValidationRequest;
class SupplierController extends Controller
{
    /**
     * Display a listing of the supplier resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search!=''){
            $count=Supplier::where('supplier_name','LIKE',"%{$request->search}%")->orWhere('supplier_phone','LIKE',"%{$request->search}%")->orWhere('supplier_email','LIKE',"%{$request->search}%")->orWhere('postcode','LIKE',"%{$request->search}%")->count();
            if($count==0){
            session()->flash("error","Supplier not found");
            return redirect(route('supplier.index'));
            }
            $list=Supplier::where('supplier_name','LIKE',"%{$request->search}%")->orWhere('supplier_phone','LIKE',"%{$request->search}%")->orWhere('supplier_email','LIKE',"%{$request->search}%")->orWhere('postcode','LIKE',"%{$request->search}%")->simplePaginate(10);
            return view('supplier.index',compact('list'));
        }
        $list=Supplier::orderBy('id','DESC')->simplePaginate(10);
        return view('supplier.index',compact('list'));
    }

    /**
     * Show the form for creating a new supplier resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierValidationRequest $request)
    {
        $store=new Supplier;
        $store->supplier_name=$request->supplier_name;
        $store->supplier_email=$request->supplier_email;
        $store->supplier_phone=$request->supplier_phone;
        $store->supplier_address=$request->supplier_address;
        $store->country=$request->country;
        $store->city=$request->city;
        $store->state=$request->state;
        $store->postcode=$request->postcode;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('supplier.index'));
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
        $edit=Supplier::find($id);
        return view('supplier.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierValidationRequest $request, $id)
    {
        Supplier::where('id',$id)->update([
            'supplier_name'=>$request->supplier_name,
            'supplier_email'=>$request->supplier_email,
            'supplier_phone'=>$request->supplier_phone,
            'supplier_address'=>$request->supplier_address,
            'country'=>$request->country,
            'city'=>$request->city,
            'state'=>$request->state,
            'postcode'=>$request->postcode,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('supplier.index'));
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
