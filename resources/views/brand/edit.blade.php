 @extends('admin.layouts.master')
   @section('title') Dashboard | Edit Brand @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>BRAND</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT BRAND INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('brand.index')}}">List</a></li>
                                        <li><a href="{{route('brand.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('brand.update',$edit->id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                             {{ method_field('PATCH') }} 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{$edit->name}}">
                                        <label class="form-label">Brand Name *</label>
                                         @if($errors->has('name'))
                                            <div class="error">
                                                {{$errors->first('name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                               <div class="form-group form-float">
                                    <div class="form-line">
                                        <img width="100px" height="50px" src="{{asset('brand_logo/'.$edit->image)}}">
                                        <input type="file" class="form-control" name="brand_logo">
                                    </div>
                                    <input type="hidden" name="d_logo" value="{{$edit->image}}">
                                </div>
                     
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" maxlength="100" class="form-control no-resize">{{$edit->description}}</textarea>
                                        <label class="form-label">Description </label>
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