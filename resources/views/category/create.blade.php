 @extends('admin.layouts.master')
   @section('title') Dashboard | Add Category @endsection
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
                            <h2>CREATE CATEGORY INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('category.index')}}">List</a></li>
                                        <li><a href="{{route('category.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                             @csrf 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="category_name" autocomplete="off" value="{{old('category_name')}}">
                                        <label class="form-label">Category Name *</label>
                                         @if($errors->has('category_name'))
                                            <div class="error">
                                                {{$errors->first('category_name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if($list->count()>0)
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="parent_id">
                                            <option value="0">Chose Parent</option>
                                             @foreach($list as $item)
                                               <option value="{{$item->id}}">{{$item->category_name}}</option>
                                             @endforeach 
                                        </select>
                                     </div>
                                </div>
                                @endif 

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                     
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" maxlength="100" class="form-control no-resize">{{old('description')}}</textarea>
                                        <label class="form-label">Description </label>
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