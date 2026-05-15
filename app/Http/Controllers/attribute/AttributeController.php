<?php

namespace App\Http\Controllers\attribute;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\varients\Varients;
use Session;
use App\Http\Requests\AttributeValidationRequest;


class AttributeController extends Controller
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
            $count=Varients::where('varient_name','LIKE',"%{$request->search}%")->count();
            if($count==0){
            session()->flash("error","Attribute not found");
            return redirect(route('attribute.index'));
            }
            $list=Varients::where('varient_name', 'LIKE', "%{$request->search}%")->orderBy('id','DESC')->simplePaginate(10);
            return view('attribute.index',compact('list'));
        }
        $list=Varients::orderBy('id','DESC')->simplePaginate(10);
        return view('attribute.index',compact('list'));
    }

    /**
     * Show the form for creating a new Brand resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attribute.create');
    }

    /**
     * Store a newly created Brand resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeValidationRequest $request)
    {
        $store=new Varients;
        $store->varient_name=$request->varient_name;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('attribute.index'));
    }

    /**
     * Show the form for editing the Brand resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Varients::find($id);
        return view('attribute.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeValidationRequest $request, $id)
    {
        Varients::where('id',$id)->update([
            'varient_name'=>$request->varient_name,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('attribute.index'));
    }
}
