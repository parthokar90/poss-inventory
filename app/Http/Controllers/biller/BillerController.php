<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\biller\Biller;
use Session;
use App\Http\Requests\BillerValidationRequest;
use App\Http\Requests\BillerUpdateRequest;

class BillerController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search!=''){
            $count=Biller::where('company','LIKE',"%{$request->search}%")->orWhere('email','LIKE',"%{$request->search}%")->orWhere('phone','LIKE',"%{$request->search}%")->count();
            if($count==0){
            session()->flash("error","Billers not found");
            return redirect(route('billers.index'));
            }
            $list=Biller::where('company','LIKE',"%{$request->search}%")->orWhere('email','LIKE',"%{$request->search}%")->orWhere('phone','LIKE',"%{$request->search}%")->simplePaginate(10);
            return view('biller.index',compact('list'));
        }
        $list=Biller::orderBy('id','DESC')->simplePaginate(10);
        return view('biller.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('biller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillerValidationRequest $request)
    {
        $image_name=null;
        if($request->hasFile('logo')){
             $image_name = time().'.'.$request->logo->getClientOriginalExtension();
             $request->logo->move(('biller_logo/'), $image_name);
        }
        $store=new Biller;
        $store->company=$request->company;
        $store->logo=$image_name;
        $store->email=$request->email;
        $store->phone=$request->phone;
        $store->vat_no=$request->vat_no;
        $store->gst_no=$request->gst_no;
        $store->postcode=$request->postcode;
        $store->country=$request->country;
        $store->city=$request->city;
        $store->state=$request->state;
        $store->address=$request->address;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('billers.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Biller::find($id);
        return view('biller.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BillerUpdateRequest $request, $id)
    {
        if($request->logo==''){
           $image_name=$request->d_logo;
        }else{
          $image_name = time().'.'.$request->logo->getClientOriginalExtension();
          $request->logo->move(('biller_logo/'), $image_name);
        }
        Biller::where('id',$id)->update([
            'company'=>$request->company,
            'logo'=>$image_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'vat_no'=>$request->vat_no,
            'gst_no'=>$request->gst_no,
            'postcode'=>$request->postcode,
            'country'=>$request->country,
            'city'=>$request->city,
            'state'=>$request->state,
            'address'=>$request->address,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('billers.index'));
    }

}
