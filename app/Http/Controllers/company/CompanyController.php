<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\company\Company;
use App\Http\Requests\CompanyValidationRequest;
use App\Http\Requests\CompanyUpdateRequest;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the company resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Company::orderBy('id','DESC')->first();
        return view('company.index',compact('list'));
    }

    /**
     * Show the form for creating a new company resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created company resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyValidationRequest $request)
    {
        $image_name = time().'.'.$request->company_logo->getClientOriginalExtension();
        $request->company_logo->move(('company_logo/'), $image_name);
        $store=new Company;
        $store->company_name=$request->company_name;
        $store->company_email=$request->company_email;
        $store->company_phone=$request->company_phone;
        $store->company_logo=$image_name;
        $store->company_address=$request->company_address;
        $store->country=$request->country;
        $store->company_city=$request->company_city;
        $store->company_state=$request->company_state;
        $store->company_postcode=$request->company_postcode;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('office.index'));
    }

    /**
     * Show the form for editing the company resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Company::find($id);
        return view('company.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        if($request->company_logo==''){
           $image_name=$request->d_logo;
        }else{
          $image_name = time().'.'.$request->company_logo->getClientOriginalExtension();
          $request->company_logo->move(('company_logo/'), $image_name);
        }
        Company::where('id',$id)->update([
            'company_name'=>$request->company_name,
            'company_email'=>$request->company_email,
            'company_phone'=>$request->company_phone,
            'company_logo'=>$image_name,
            'company_address'=>$request->company_address,
            'country'=>$request->country,
            'company_city'=>$request->company_city,
            'company_state'=>$request->company_state,
            'company_postcode'=>$request->company_postcode
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('office.index'));
    }
}
