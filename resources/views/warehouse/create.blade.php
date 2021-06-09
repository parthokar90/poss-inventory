 @extends('admin.layouts.master')
   @section('title') Dashboard | Add Warehouse @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>WAREHOUSE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE WAREHOUSE INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('warehouse.index')}}">List</a></li>
                                        <li><a href="{{route('warehouse.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('warehouse.store')}}" method="POST">
                             @csrf 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{old('name')}}">
                                        <label class="form-label">Name *</label>
                                         @if($errors->has('name'))
                                            <div class="error">
                                                {{$errors->first('name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                   <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="phone" autocomplete="off" value="{{old('phone')}}">
                                        <label class="form-label">Phone *</label>
                                         @if($errors->has('phone'))
                                            <div class="error">
                                                {{$errors->first('phone')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                   <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="email" autocomplete="off" value="{{old('email')}}">
                                        <label class="form-label">Email *</label>
                                         @if($errors->has('email'))
                                            <div class="error">
                                                {{$errors->first('email')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                   <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="address" autocomplete="off" value="{{old('address')}}">
                                        <label class="form-label">Address *</label>
                                         @if($errors->has('address'))
                                            <div class="error">
                                                {{$errors->first('address')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SAVE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      