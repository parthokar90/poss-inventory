<?php

namespace App\Http\Controllers\taxrate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\tax\Taxrate;
use Session;
use App\Http\Requests\TaxrateValidationRequest;

class TaxrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search!=''){
            $count=Taxrate::where('name','LIKE',"%{$request->search}%")->count();
            if($count==0){
              session()->flash("error","Tax rate not found");
              return redirect(route('taxrate.index'));
            }
            $list=Taxrate::where('name', 'LIKE', "%{$request->search}%")->orderBy('id','DESC')->simplePaginate(10);
            return view('taxrate.index',compact('list'));
        }
        $list=Taxrate::orderBy('id','DESC')->simplePaginate(10);
        return view('taxrate.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('taxrate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxrateValidationRequest $request)
    {
        $store=new Taxrate;
        $store->name=$request->name;
        $store->type=$request->type;
        $store->rate=$request->rate;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('taxrate.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Taxrate::find($id);
        return view('taxrate.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaxrateValidationRequest $request, $id)
    {
        
        Taxrate::where('id',$id)->update([
            'name'=>$request->name,
            'type'=>$request->type,
            'rate'=>$request->rate,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('taxrate.index'));
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
