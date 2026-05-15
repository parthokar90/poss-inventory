 @extends('admin.layouts.master')
   @section('title') Dashboard | Edit Billers @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>BILLER</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT BILLER INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('billers.index')}}">List</a></li>
                                        <li><a href="{{route('billers.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('billers.update',$edit->id)}}" method="POST" enctype="multipart/form-data">
                              {{ csrf_field() }}
                             {{ method_field('PATCH') }} 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="company" autocomplete="off" value="{{$edit->company}}">
                                        <label class="form-label">Company *</label>
                                         @if($errors->has('company'))
                                            <div class="error">
                                                {{$errors->first('company')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="phone" autocomplete="off" value="{{$edit->phone}}">
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
                                        <input type="text" class="form-control" name="email" autocomplete="off" value="{{$edit->email}}">
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
                                        <input type="text" class="form-control" name="vat_no" autocomplete="off" value="{{$edit->vat_no}}">
                                        <label class="form-label">Vat No *</label>
                                         @if($errors->has('vat_no'))
                                            <div class="error">
                                                {{$errors->first('vat_no')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="gst_no" autocomplete="off" value="{{$edit->gst_no}}">
                                        <label class="form-label">Gst No *</label>
                                         @if($errors->has('gst_no'))
                                            <div class="error">
                                                {{$errors->first('gst_no')}}
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
                                        <img width="100px" height="50px" src="{{asset('biller_logo/'.$edit->logo)}}">
                                        <input type="file" class="form-control" name="logo">
                                         @if($errors->has('logo'))
                                            <div class="error">
                                                {{$errors->first('logo')}}
                                            </div>
                                        @endif
                                    </div>
                                    <input type="hidden" name="d_logo" value="{{$edit->logo}}">
                                </div>
                     
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="address" cols="30" rows="5" maxlength="100" class="form-control no-resize">{{$edit->address}}</textarea>
                                        <label class="form-label">Address </label>
                                         @if($errors->has('address'))
                                            <div class="error">
                                                {{$errors->first('address')}}
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