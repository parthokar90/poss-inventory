 @extends('admin.layouts.master')
   @section('title') Dashboard | Company @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>COMPANY</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>COMPANY INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    @if(!isset($list))
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('office.create')}}">Add</a></li>
                                    </ul>
                                    @endif 
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
                                            <th>Logo</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Post Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($list))
                                          <tr>
                                            <td>1</td>
                                            <td>@if(isset($list->company_name)) {{$list->company_name}} @endif</td>
                                            <td>@if(isset($list->company_phone)) {{$list->company_phone}} @endif</td>
                                            <td>@if(isset($list->company_email)) {{$list->company_email}} @endif</td>
                                            <td>@if(isset($list->company_logo)) <img width="100px" height="50px" src="{{asset('company_logo/'.$list->company_logo)}}">@endif</td>
                                            <td>@if(isset($list->country)) {{$list->country}} @endif</td>
                                            <td>@if(isset($list->company_city)) {{$list->company_city}} @endif</td>
                                            <td>@if(isset($list->company_state)) {{$list->company_state}} @endif</td>
                                            <td>@if(isset($list->company_postcode)) {{$list->company_postcode}} @endif</td>
                                            <td><a title="Edit Company" href="{{route('office.edit',$list->id)}}"><i class="material-icons">edit</i></a></td>
                                        </tr>
                                       @endif 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      