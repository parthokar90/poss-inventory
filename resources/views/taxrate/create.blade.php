 @extends('admin.layouts.master')
   @section('title') Dashboard | Add Tax Rate @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>TAX RATE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE TAX RATE INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('taxrate.index')}}">List</a></li>
                                        <li><a href="{{route('taxrate.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('taxrate.store')}}" method="POST">
                             @csrf 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{old('name')}}">
                                        <label class="form-label">Tax Rate *</label>
                                         @if($errors->has('name'))
                                            <div class="error">
                                                {{$errors->first('name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="type">
                                            <option value="0" selected>Fixed</option>
                                            <option value="1">Percentage</option>
                                        </select>
                                         <label class="form-label">Type</label>
                                     </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="rate" autocomplete="off" value="{{old('rate')}}">
                                        <label class="form-label">Rate *</label>
                                         @if($errors->has('rate'))
                                            <div class="error">
                                                {{$errors->first('rate')}}
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