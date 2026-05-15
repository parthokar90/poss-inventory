@extends('admin.layouts.master')
   @section('title') Dashboard | Gross Profit @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>GROSS PROFIT</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>GROSS PROFIT REPORT</h2>
                        </div>
                        <div class="body">
                           <!-- supplier div start -->
                            <div id="supplier_div">
                               <form method="post" action="{{route('gross.profit_report')}}">
                                @csrf 
                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input class="form-control" type="date" name="start" value="{{date('Y-m-01')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input class="form-control" type="date" name="end" value="{{date('Y-m-t')}}"> 
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div style="float:left;">
                                            <button style="margin-right: 3px;" type="submit" class="btn bg-green waves-effect">
                                                <i class="material-icons">search</i>
                                            </button>
                                        </div>
                                        <div style="float:left;">
                                            <button name="pdf_download" value="pdf_download" style="margin-right: 3px;" class="btn bg-purple btn-lg waves-effect" type="submit">
                                             DOWNLOAD PDF
                                            </button>
                                        </div>
                                    </div> 
                                 </div>
                               </form>
                            </div>
                           <!-- supplier div end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      