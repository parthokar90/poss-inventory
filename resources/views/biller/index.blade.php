 @extends('admin.layouts.master')
   @section('title') Dashboard | Billers @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>BILLERS</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>BILLERS INFORMATION</h2>
                              <div class="form-group">
                                 <form method="get" action="{{route('billers.index')}}">
                                     <input type="text" class="form-control" name="search" placeholder="Enter company, or phone, or email to search" autocomplete="off" required>
                                     <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                  </form>
                              </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('billers.create')}}">Add</a></li>
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
                                            <th>Company</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Vat No</th>
                                            <th>Gst No</th>
                                            <th>Logo</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if($list->count()>0)
                                           @foreach($list as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->company}}</td>
                                                <td>{{$item->phone}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->vat_no}}</td>
                                                <td>{{$item->gst_no}}</td>
                                                <td><img width="100" height="50px" src="{{asset('biller_logo/'.$item->logo)}}"></td>
                                                <td>@if($item->status==1) Active @else Inactive @endif</td>
                                                <td><a title="Edit Biller" href="{{route('billers.edit',$item->id)}}"><i class="material-icons">edit</i></a></td>
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