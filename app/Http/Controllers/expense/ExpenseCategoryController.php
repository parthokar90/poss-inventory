<?php

namespace App\Http\Controllers\expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\expense\ExpenseCategory;
use App\Http\Requests\CategoryValidationRequest;

class ExpenseCategoryController extends Controller
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
            $count=ExpenseCategory::where('category_name','LIKE',"%{$request->search}%")->count();
            if($count==0){
            session()->flash("error","Category not found");
            return redirect(route('expense.index'));
            }
            $list=ExpenseCategory::where('category_name', 'LIKE', "%{$request->search}%")->orderBy('id','DESC')->simplePaginate(10);
            return view('expense_category.index',compact('list'));
        }
        $list=ExpenseCategory::orderBy('id','DESC')->simplePaginate(10);
        return view('expense_category.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValidationRequest $request)
    {
        $store= new ExpenseCategory;
        $store->category_name=$request->category_name;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('expense.index'));
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
        $edit=ExpenseCategory::find($id);
        return view('expense_category.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryValidationRequest $request, $id)
    {
        ExpenseCategory::where('id',$id)->update([
            'category_name'=>$request->category_name,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('expense.index'));
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
