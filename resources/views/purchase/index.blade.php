 @extends('admin.layouts.master')
   @section('title') Dashboard | Purchase List @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>PURCHASE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PURCHASE INFORMATION</h2>
                             <div class="row">
                               <div class="col-md-4">
                                  <div class="form-group">
                                    <form method="get" action="{{route('purchase.index')}}">
                                       <input type="text" class="form-control" name="search" placeholder="Enter Invoice No or Status to search" autocomplete="off" required>
                                       <button type="submit" name="search_item" value="all_search" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                    </form>
                                  </div>
                               </div>

                               <div class="col-md-4">
                                 <form method="get" action="{{route('purchase.index')}}">
                                    <div class="col-md-6">
                                       <div class="form-group form-float d-flex">
                                            <label>Supplier</label>
                                            <select class="form-control" name="supplier_id" id="supplier_add">
                                              @foreach($supplier as $suppliers)
                                                        <option value="{{ $suppliers->id }}" selected>{{ $suppliers->supplier_name }}</option>
                                               @endforeach  
                                            </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group form-float d-flex">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name="purchase_date" value="{{date('Y-m-d')}}" autocomplete="off">
                                     </div>
                                    </div>
                                    <button type="submit" name="search_item" value="supplier_search" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                 </form>
                               </div>
                               <div class="col-md-4">
                                 <div class="form-group">
                                    <form method="get" action="{{route('purchase.index')}}">
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
                                        <li><a href="{{route('purchase.create')}}">Add</a></li>
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
                                            <th>Supplier</th>
                                            <th>Purchase Date</th>
                                            <th>Purchased by</th>
                                            <th>Total Purchase</th>
                                            <th>Total Payment</th>
                                            <th>Total Due</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if($list->count()>0)
                                           @foreach($list as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td style="color:orange">Invoice-{{$item->id}}</td>
                                                <td>{{$item->purchase_discount}} %</td>
                                                <td>{{$item->purchase_vat}} %</td>
                                                <td>{{optional($item->suppliers)->supplier_name}}</td>
                                                <td>{{$item->purchase_date}}</td>
                                                <td>{{optional($item->user)->name}}</td>
                                                <td>{{number_format($item->total_price)}} Tk</td>
                                                <td>{{number_format($item->total_payment)}} Tk</td>
                                                <td>{{number_format($item->total_due)}} Tk</td>
                                                <td>{{$item->status}}</td>
                                                <td>
                                                   <a title="View Purchase Item" href="{{route('purchase.show',$item->id)}}"><i class="material-icons">visibility</i></a>
                                                   <a title="Edit Purchase Item" href="{{route('purchase.edit',$item->id)}}"><i class="material-icons">edit</i></a>
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
     @endsection      