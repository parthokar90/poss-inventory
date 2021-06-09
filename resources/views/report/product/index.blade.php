 @extends('admin.layouts.master')
   @section('title') Dashboard | Purchase Report @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>PRODUCT REPORT</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PRODUCT REPORT</h2>
                          
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('units.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                           
                           <!-- supplier div start -->
                            <div id="supplier_div">
                               <form method="post" action="{{route('product_report_generate')}}">
                               @csrf 
                               <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label>Report Type</label>
                                         <select class="form-control" name="report_type" id="report_type">
                                           <option value="1">Purchase Report</option>
                                           <option value="2">Sell Report</option>
                                           <option value="3">Stock Report</option>
                                         </select>
                                    </div>
                                 </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label>Select Product</label>
                                                    <select id="product_id" class="form-control" name="product_id" required>
                                                        <option value="">Select</option>
                                                            @foreach($product as $item)
                                                               <option value="{{$item->id}}">{{$item->product_name}} </option>
                                                            @endforeach   
                                                    </select>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="start">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input class="form-control" type="date" name="start" value="{{date('Y-m-01')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="end">
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
        // when select browser back button page will be reload 
                window.addEventListener( "pageshow", function ( event ) {
                    var historyTraversal = event.persisted || 
                    ( typeof window.performance != "undefined" && 
                    window.performance.navigation.type === 2 );
                    if ( historyTraversal ) {
                     window.location.reload();
                    }
                });
        // when select browser back button page will be reload 
                $("#product_id").select2();
                $("#report_type").change(function(){
                   var value_type=$("#report_type").val();
                   if(value_type==3){
                     $("#start").hide();
                     $("#end").hide();
                   }else{
                     $("#start").show();
                     $("#end").show();
                   }
                });
        </script>
     @endsection      