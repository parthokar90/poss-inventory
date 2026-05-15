 @extends('admin.layouts.master')
   @section('title') Dashboard | Add Company @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>COMPANY</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE COMPANY INFORMATION</h2>
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
                          <form action="{{route('office.store')}}" method="POST" enctype="multipart/form-data">
                             @csrf 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="company_name" autocomplete="off" value="{{old('company_name')}}">
                                        <label class="form-label">Company Name *</label>
                                         @if($errors->has('company_name'))
                                            <div class="error">
                                                {{$errors->first('company_name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="company_email" autocomplete="off" value="{{old('company_email')}}">
                                        <label class="form-label">Email *</label>
                                         @if($errors->has('company_email'))
                                            <div class="error">
                                                {{$errors->first('company_email')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="company_phone" autocomplete="off" value="{{old('company_phone')}}">
                                        <label class="form-label">Phone *</label>
                                         @if($errors->has('company_phone'))
                                            <div class="error">
                                                {{$errors->first('company_phone')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                  <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="country" autocomplete="off" value="{{old('country')}}">
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
                                        <input type="text" class="form-control" name="company_city" autocomplete="off" value="{{old('company_city')}}">
                                        <label class="form-label">City *</label>
                                         @if($errors->has('company_city'))
                                            <div class="error">
                                                {{$errors->first('company_city')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="company_state" autocomplete="off" value="{{old('company_state')}}">
                                        <label class="form-label">State *</label>
                                         @if($errors->has('company_state'))
                                            <div class="error">
                                                {{$errors->first('company_state')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="company_postcode" autocomplete="off" value="{{old('company_postcode')}}">
                                        <label class="form-label">Post Code *</label>
                                         @if($errors->has('company_postcode'))
                                            <div class="error">
                                                {{$errors->first('company_postcode')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="company_logo">
                                         @if($errors->has('company_logo'))
                                            <div class="error">
                                                {{$errors->first('company_logo')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                     
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="company_address" cols="30" rows="5" maxlength="100" class="form-control no-resize">{{old('company_address')}}</textarea>
                                        <label class="form-label">Address *</label>
                                         @if($errors->has('company_address'))
                                            <div class="error">
                                                {{$errors->first('company_address')}}
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