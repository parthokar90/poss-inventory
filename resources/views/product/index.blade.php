 @extends('admin.layouts.master')
   @section('title') Dashboard | Product @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>PRODUCT</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PRODUCT INFORMATION</h2>
                              <div class="form-group">
                                 <form method="get" action="{{route('item_product_search')}}">
                                     <input type="text" class="form-control" name="search" placeholder="Enter product code or name to search" autocomplete="off" required>
                                     <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                  </form>
                              </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('product.create')}}">Add</a></li>
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
                                            <th>Image</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Cost</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if($list->count()>0)
                                           @foreach($list as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>@if($item->product_image) <img  width="50" height="50" src="{{asset('product_image/'.$item->product_image)}}"> @endif</td>
                                                <td>{{$item->product_code}}</td>
                                                <td>{{$item->product_name}}</td>
                                                <td>{{number_format($item->product_cost)}} Tk</td>
                                                <td>{{number_format($item->product_price)}} Tk</td>
                                                <td>{{optional($item->category)->category_name}}</td>
                                                <td>{{optional($item->brand)->name}}</td>
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