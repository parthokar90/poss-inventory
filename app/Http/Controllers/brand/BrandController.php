<?php

namespace App\Http\Controllers\brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\brand\Brand;
use Session;
use App\Http\Requests\BrandValidationRequest;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the Brand resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search!=''){
        $count=Brand::where('name','LIKE',"%{$request->search}%")->count();
        if($count==0){
          session()->flash("error","Brand not found");
          return redirect(route('brand.index'));
        }
        $list=Brand::where('name','LIKE',"%{$request->search}%")->simplePaginate(10);
        return view('brand.index',compact('list'));
       }
        $list=Brand::orderBy('id','DESC')->simplePaginate(10);
        return view('brand.index',compact('list'));
    }

    /**
     * Show the form for creating a new Brand resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created Brand resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandValidationRequest $request)
    {
        $image_name=null;
        if($request->hasFile('brand_logo')){
             $image_name = time().'.'.$request->brand_logo->getClientOriginalExtension();
             $request->brand_logo->move(('brand_logo/'), $image_name);
        }
        $store=new Brand;
        $store->name=$request->name;
        $store->image=$image_name;
        $store->slug=lcfirst($request->name);
        $store->description=$request->description;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('brand.index'));
    }

    /**
     * Show the form for editing the Brand resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Brand::find($id);
        return view('brand.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandValidationRequest $request, $id)
    {
        if($request->brand_logo==''){
           $image_name=$request->d_logo;
        }else{
          $image_name = time().'.'.$request->brand_logo->getClientOriginalExtension();
          $request->brand_logo->move(('brand_logo/'), $image_name);
        }
        Brand::where('id',$id)->update([
            'name'=>$request->name,
            'image'=>$image_name,
            'slug'=>lcfirst($request->name),
            'description'=>$request->description,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('brand.index'));
    }

}
