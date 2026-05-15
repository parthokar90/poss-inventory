<?php

namespace App\Http\Controllers\warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\warehouse\Warehouse; 
use App\Http\Requests\WareHouseValidationRequest;

class WareHouseController extends Controller
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
         $count=Warehouse::where('name','LIKE',"%{$request->search}%")->count();
        if($count==0){
          session()->flash("error","Warehouse not found");
          return redirect(route('warehouse.index'));
        }
        $list=Warehouse::where('name', 'LIKE', "%{$request->search}%") ->orderBy('id','DESC')->simplePaginate(10);
        return view('warehouse.index',compact('list'));
        }
    
        $list=Warehouse::orderBy('id','DESC')->simplePaginate(10);
        return view('warehouse.index',compact('list'));
    }

    /**
     * Show the form for creating a new customer resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WareHouseValidationRequest $request)
    {
        $store=new Warehouse;
        $store->name=$request->name;
        $store->email=$request->email;
        $store->phone=$request->phone;
        $store->address=$request->address;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('warehouse.index'));
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
        $edit=Warehouse::find($id);
        return view('warehouse.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WareHouseValidationRequest $request, $id)
    {
        Warehouse::where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('warehouse.index'));
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
