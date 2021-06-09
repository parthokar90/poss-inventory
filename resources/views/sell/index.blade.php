 @extends('admin.layouts.master')
   @section('title') Dashboard | Sales List @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>SALES</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>SALES INFORMATION</h2>
                             <div class="row">
                               <div class="col-md-4">
                                  <div class="form-group">
                                    <form method="get" action="{{route('sales.index')}}">
                                       <input type="text" class="form-control" name="search" placeholder="Enter Invoice No" autocomplete="off" required>
                                       <button type="submit" name="search_item" value="all_search" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                    </form>
                                  </div>
                               </div>

                               <div class="col-md-4">
                                 <form method="get" action="{{route('sales.index')}}">
                                    <div class="col-md-6">
                                       <div class="form-group form-float d-flex">
                                            <label>Customer</label>
                                            <select class="form-control" name="customer_id" id="customer_id">
                                               @foreach($customer as $customers)
                                                        <option value="{{ $customers->id }}" selected>({{$customers->customer_phone}})-{{ $customers->customer_name }}</option>
                                               @endforeach  
                                            </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group form-float d-flex">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name="sale_date" value="{{date('Y-m-d')}}" autocomplete="off">
                                     </div>
                                    </div>
                                    <button type="submit" name="search_item" value="customer_search" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                 </form>
                               </div>
                               <div class="col-md-4">
                                 <div class="form-group">
                                    <form method="get" action="{{route('sales.index')}}">
                                       <label>Start</label>
                                       <input type="date" class="form-control" name="start" value="{{date('Y-m-01')}}" autocomplete="off" required>
                                       <label>End</label>
                                       <input type="date" class="form-control" name="end" value="{{date('Y-m-t')}}" autocomplete="off" required>
                                       <button type="submit" name="search_item" value="date_search" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                    </form>
                                  </div>
                               </div>
                             </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('sales.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice</th>
                                            <th>Discount %</th>
                                            <th>Vat %</th>
                                            <th>Customer</th>
                                            <th>Biller</th>
                                            <th>Sale Date</th>
                                            <th>Sale by</th>
                                            <th>Total Sale</th>
                                            <th>Total Payment</th>
                                            <th>Total Due</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if($list->count()>0)
                                           @foreach($list as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td style="color:orange">Invoice-{{$item->id}}</td>
                                                <td>{{$item->sale_discount}} %</td>
                                                <td>{{$item->sale_vat}} %</td>
                                                <td>{{optional($item->customers)->customer_name}}</td>
                                                <td>{{optional($item->billers)->company}}</td>
                                                <td>{{$item->sale_date}}</td>
                                                <td>{{optional($item->user)->name}}</td>
                                                <td>{{number_format($item->total_price)}} Tk</td>
                                                <td>{{number_format($item->total_payment)}} Tk</td>
                                                <td>{{number_format($item->total_due)}} Tk</td>
                                                <td>
                                                   <a title="View Sales Item" href="{{route('sales.show',$item->id)}}"><i class="material-icons">visibility</i></a>
                                                   <a title="Edit Sales Item" href="{{route('sales.edit',$item->id)}}"><i class="material-icons">edit</i></a>
                                                </td>
                                            </tr>
                                            @endforeach 
                                            @else 
                                            No Data Found
                                        @endif 
                                    </tbody>
                                </table>
                                <div class="pull-right">{{$list->links()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
          $("#customer_id").select2();
        </script>   
     @endsection      

     