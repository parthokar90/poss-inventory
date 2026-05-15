 @extends('admin.layouts.master')
   @section('title') Dashboard | Edit Customer @endsection
   @section('content')
    <style>
   .error{
       color:red;
    }
    </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>SUPPLIER</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT CUSTOMER INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('office.index')}}">List</a></li>
                                        <li><a href="{{route('office.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('customer.update',$edit->id)}}" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             {{ method_field('PATCH') }} 
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="customer_name" autocomplete="off" value="{{$edit->customer_name}}">
                                        <label class="form-label">customer Name *</label>
                                         @if($errors->has('customer_name'))
                                            <div class="error">
                                                {{$errors->first('customer_name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="customer_email" autocomplete="off" value="{{$edit->customer_email}}">
                                        <label class="form-label">Email *</label>
                                         @if($errors->has('customer_email'))
                                            <div class="error">
                                                {{$errors->first('customer_email')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="customer_phone" autocomplete="off" value="{{$edit->customer_phone}}">
                                        <label class="form-label">Phone *</label>
                                         @if($errors->has('customer_phone'))
                                            <div class="error">
                                                {{$errors->first('customer_phone')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                  <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="country" autocomplete="off" value="{{$edit->country}}">
                                        <label class="form-label">Country *</label>
                                         @if($errors->has('country'))
                                            <div class="error">
                                                {{$errors->first('country')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="city" autocomplete="off" value="{{$edit->city}}">
                                        <label class="form-label">City *</label>
                                         @if($errors->has('city'))
                                            <div class="error">
                                                {{$errors->first('city')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="state" autocomplete="off" value="{{$edit->state}}">
                                        <label class="form-label">State *</label>
                                         @if($errors->has('state'))
                                            <div class="error">
                                                {{$errors->first('state')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="postcode" autocomplete="off" value="{{$edit->postcode}}">
                                        <label class="form-label">Post Code *</label>
                                         @if($errors->has('postcode'))
                                            <div class="error">
                                                {{$errors->first('postcode')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                     
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="customer_address" cols="30" rows="5" maxlength="100" class="form-control no-resize">{{$edit->customer_address}}</textarea>
                                        <label class="form-label">Address *</label>
                                         @if($errors->has('customer_address'))
                                            <div class="error">
                                                {{$errors->first('customer_address')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="status">
                                           @if($edit->status==1)
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                            @else 
                                            <option value="1">Active</option>
                                            <option value="0" selected>Inactive</option>
                                           @endif  
                                        </select>
                                     </div>
                                </div>
                          
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      