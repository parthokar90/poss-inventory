 @extends('admin.layouts.master')
   @section('title') Dashboard | Notifications @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>NOTIFICATIONS</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>STOCK ALERT NOTIFICATIONS</h2>
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
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Warehouse</th>
                                            <th>Stock</th>
                                            <th>Alert Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if($alert_notify->count()>0)
                                            @foreach($alert_notify as $key=>$notifications)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$notifications->Products->product_name}} {{optional($notifications->Varient)->varient_name}}</td>
                                                    <td>{{optional($notifications->Warehouses)->name}}</td>
                                                    <td>{{$notifications->qty}}</td>
                                                    <td>{{$notifications->alert_qty}}</td>
                                                    <td><a title="Edit Product" href="{{route('product.edit',$notifications->product_id)}}"><i class="material-icons">edit</i></a></td>
                                                </tr>
                                            @endforeach   
                                            @else 
                                            No Data Found
                                         @endif    
                                    </tbody>
                                </table>
                                
                                <div class="pull-right">{{$alert_notify->links()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      