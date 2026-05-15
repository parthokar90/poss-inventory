 @extends('admin.layouts.master')
   @section('title') Dashboard | Add Purchase @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
        @include('admin.includes.messages')
            <div class="block-header">
                <h2>SUPPLIER PAYMENT</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE SUPPLIER PAYMENT</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('purchase.index')}}">List</a></li>
                                        <li><a href="{{route('purchase.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form method="post" action="{{route('payment-supplier.store')}}">
                           @csrf 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                         <label>Supplier</label>
                                            <select class="form-control" name="supplier_id" id="supplier">
                                                @foreach($supplier as $suppliers)
                                                    <option value="{{ $suppliers->id }}">{{ $suppliers->supplier_name }}</option>
                                                @endforeach  
                                            </select>
                                      </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group form-float">
                                           <label>Start</label>
                                           <input type="date" class="form-control" name="start" autocomplete="off" value="{{date('Y-m-01')}}" required>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group form-float">
                                       <label>End</label>
                                           <input type="date" class="form-control" name="end" autocomplete="off" value="{{date('Y-m-t')}}" required>
                                       </div>
                                  </div>
                               </div>
                              <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                           </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $("#supplier").select2();
        </script>
     @endsection      