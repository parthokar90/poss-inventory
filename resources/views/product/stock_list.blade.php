 @extends('admin.layouts.master')
   @section('title') Dashboard | Stock List @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>STOCK LIST</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>STOCK INFORMATION</h2>
                             <div class="form-group">
                                 <form method="get" action="{{route('item_stock_search')}}">
                                     <input type="text" class="form-control" name="search" placeholder="Enter product code or name to search" autocomplete="off" required>
                                     <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                  </form>
                              </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Code</th>
                                            <th>Product</th>
                                            <th>Warehouse</th>
                                            <th>Total Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if($list->count()>0)
                                           @foreach($list as $key=>$item)
                                           @php $total_stock=0; @endphp
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->product_code}}</td>
                                                <td>{{$item->product_name}}</td>
                                                <td>
                                                 @foreach($item->productWarehouses as $warehouse)
                                                  <table class="table">
                                                    <tr>
                                                      <td>{{optional($warehouse->Warehouses)->name}} Qty:({{$warehouse->qty}}) @php $total_stock+=$warehouse->qty; @endphp</td>
                                                    </tr>
                                                  </table>
                                                  @endforeach 
                                                </td>
                                                <td>{{$total_stock}}</td>
                                                <td><a title="Edit Product" href="{{route('product.edit',$item->id)}}"><i class="material-icons">edit</i></a></td>
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