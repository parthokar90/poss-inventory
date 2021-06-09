<?php

namespace App\Http\Controllers\expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\expense\ExpenseAmount;
use App\expense\ExpenseCategory;
use App\warehouse\Warehouse;
use App\Http\Requests\ExpenseValidationRequest;


class ExpenseAmountController extends Controller
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
        if($request->cat_id!=''){
            $count=ExpenseAmount::where('category_id',$request->cat_id)->where('expense_date',$request->search_date)->count();
            if($count==0){
            session()->flash("error","No data found");
            return redirect(route('expense_amount.index'));
            }
            $category=ExpenseCategory::orderBy('id','DESC')->where('status',1)->get();
            $list=ExpenseAmount::where('category_id',$request->cat_id)->where('expense_date',$request->search_date)->orderBy('id','DESC')->simplePaginate(10);
            return view('expense_amount.index',compact('list','category'));
        }
        $category=ExpenseCategory::orderBy('id','DESC')->where('status',1)->get();
        $list=ExpenseAmount::orderBy('id','DESC')->simplePaginate(10);
        return view('expense_amount.index',compact('list','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=ExpenseCategory::orderBy('id','DESC')->where('status',1)->get();
        $warehouse=Warehouse::orderBy('id','DESC')->where('status',1)->get();
        return view('expense_amount.create',compact('category','warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseValidationRequest $request)
    {
        $image_name=null;
        if($request->hasFile('expense_attachment')){
             $image_name = time().'.'.$request->expense_attachment->getClientOriginalExtension();
             $request->expense_attachment->move(('expense_attachment/'), $image_name);
        }
        $store=new ExpenseAmount;
        $store->expense_date=$request->expense_date;
        $store->expense_amount=$request->expense_amount;
        $store->category_id=$request->category_id;
        $store->warehouse_id=$request->warehouse_id;
        $store->attachment=$image_name;
        $store->note=$request->note;
        $store->created_by=auth()->user()->id;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('expense_amount.index'));
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
        $category=ExpenseCategory::orderBy('id','DESC')->where('status',1)->get();
        $warehouse=Warehouse::orderBy('id','DESC')->where('status',1)->get();
        $edit=ExpenseAmount::find($id);
        return view('expense_amount.edit',compact('category','warehouse','edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseValidationRequest $request, $id)
    {
        if($request->expense_attachment==''){
           $image_name=$request->d_logo;
        }else{
          $image_name = time().'.'.$request->expense_attachment->getClientOriginalExtension();
          $request->expense_attachment->move(('expense_attachment/'), $image_name);
        }
        ExpenseAmount::where('id',$id)->update([
            'expense_date'=>$request->expense_date,
            'expense_amount'=>$request->expense_amount,
            'category_id'=>$request->category_id,
            'warehouse_id'=>$request->warehouse_id,
            'attachment'=>$image_name,
            'note'=>$request->note,
            'created_by'=>auth()->user()->id,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('expense_amount.index'));
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
