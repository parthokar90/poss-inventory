 @extends('admin.layouts.master')
   @section('title') Dashboard | Edit Attribute @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>ATTRIBUTE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT ATTRIBUTE INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('attribute.index')}}">List</a></li>
                                        <li><a href="{{route('attribute.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('attribute.update',$edit->id)}}" method="POST">
                             {{ csrf_field() }}
                             {{ method_field('PATCH') }} 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="varient_name" autocomplete="off" value="{{$edit->varient_name}}">
                                        <label class="form-label">Attribute Name *</label>
                                         @if($errors->has('varient_name'))
                                            <div class="error">
                                                {{$errors->first('varient_name')}}
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