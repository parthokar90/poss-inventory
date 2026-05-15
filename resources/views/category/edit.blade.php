 @extends('admin.layouts.master')
   @section('title') Dashboard | Edit Category @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>CATEGORY</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT CATEGORY INFORMATION</h2>
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
                          <form action="{{route('category.update',$edit->id)}}" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             {{ method_field('PATCH') }} 
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="category_name" autocomplete="off" value="{{$edit->category_name}}">
                                        <label class="form-label">Category Name *</label>
                                         @if($errors->has('category_name'))
                                            <div class="error">
                                                {{$errors->first('category_name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                     <label class="form-label">Parent</label>
                                        <select class="form-control" name="parent_id">
                                        <option value="0"></option>
                                          @foreach ($list as $item)
                                            <option value="{{ $item->id }}" {{ ( $item->id == $edit->parent_id) ? 'selected' : '' }}> {{ $item->category_name }} </option>
                                           @endforeach    
                                        </select>
                                     </div>
                                </div>
                              
                              
                               <div class="form-group form-float">
                                    <div class="form-line">
                                       @if($edit->image!='')
                                            <img width="50px" height="50px" src="{{asset('category_logo/'.$edit->image)}}">
                                          @else 
                                             <img width="50px" height="50px" src="{{asset('category_logo/no_image.png')}}">
                                        @endif
                                        <input type="file" class="form-control" name="image">
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