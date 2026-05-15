<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrossProfitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //gross profit view 
    public function index(){
        return view('report.gross_profit.index');
    }

    //gross profit report
    public function profitReport(Request $request){
        return view('report.gross_profit.profit_report');
    }
}
