<?php

namespace App\Http\Controllers\unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\units\Units; 
use App\Http\Requests\UnitValidationRequest;
class UnitController extends Controller
{
    /**
     * Display a listing of the Unit resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search!=''){
            $count=Units::where('unit_name','LIKE',"%{$request->search}%")->count();
            if($count==0){
            session()->flash("error","Units not found");
            return redirect(route('units.index'));
            }
            $list=Units::where('unit_name', 'LIKE', "%{$request->search}%")->orderBy('id','DESC')->simplePaginate(10);
            return view('unit.index',compact('list'));
        }
        $list=Units::orderBy('id','DESC')->simplePaginate(10);
        return view('unit.index',compact('list'));
    }

    /**
     * Show the form for creating a new Unit resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitValidationRequest $request)
    {
        $store=new Units;
        $store->unit_name=$request->unit_name;
        $store->unit_value=$request->unit_value;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('units.index'));
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
        $edit=Units::find($id);
        return view('unit.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitValidationRequest $request, $id)
    {
        Units::where('id',$id)->update([
            'unit_name'=>$request->unit_name,
            'unit_value'=>$request->unit_value,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('units.index'));
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
