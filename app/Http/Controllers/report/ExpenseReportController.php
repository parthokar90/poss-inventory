<?php

namespace App\Http\Controllers\report;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\expense\ExpenseCategory;
use App\expense\ExpenseAmount;
use App\company\Company;
use PDF;

class ExpenseReportController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    // expense  report view
    public function expenseReport(){     
         $data=[];
         $category=ExpenseCategory::orderBy('id','DESC')->where('status',1)->get();
         return view('report.expense.index',compact('category','data'));
    }

    //expense report show
    public function expenseReportShow(Request $request){
       $start=$request->start; 
       $end=$request->end; 
       $count=ExpenseAmount::where('category_id',$request->cat_id)->whereBetween('expense_date',[$start,$end])->with('ExpenseCategorys','users')->count();
    
       if($request->pdf=='pdf_download'){
           if($count==0){
             session()->flash("error","No Expense Found");
             return back();
           }
          $company=Company::first();
          $category=ExpenseCategory::where('id',$request->cat_id)->first();
          $data=ExpenseAmount::where('category_id',$request->cat_id)->whereBetween('expense_date',[$start,$end])->with('ExpenseCategorys','users')->get();
          $pdf = PDF::loadView('report.expense.pdf.expense',compact('data','company','category','start','end'));
          return $pdf->download('expense_report.pdf');
       }
       if($count==0){
             session()->flash("error","No Expense Found");
             return back();
       }
       $data=ExpenseAmount::where('category_id',$request->cat_id)->whereBetween('expense_date',[$start,$end])->with('ExpenseCategorys','users')->get();
       $category=ExpenseCategory::orderBy('id','DESC')->where('status',1)->get();
       return view('report.expense.show',compact('category','data'));
    }

    //expense report date wise
    public function expenseReportDate(Request $request){
       if($request->pdf=='pdf_download'){
        echo "<h1>Coming soon</h1>";
       }else{
       $start=$request->start;
       $end=$request->end;
       $company=Company::first();
       $data=ExpenseAmount::whereBetween('expense_date',[$start,$end])->with('ExpenseCategorys','Warehouses','users')->get();
       return view('report.expense.expense_date_wise',compact('start','end','company','data'));
       }
     
       
     } 
}
