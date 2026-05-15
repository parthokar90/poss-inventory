 @extends('admin.layouts.master')
   @section('title') Dashboard | Edit Expense @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>EXPENSE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT EXPENSE INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('expense_amount.index')}}">List</a></li>
                                        <li><a href="{{route('expense_amount.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('expense_amount.update',$edit->id)}}" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                             {{ method_field('PATCH') }} 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="expense_date" autocomplete="off" value="{{$edit->expense_date}}">
                                        <label class="form-label">Expense Date *</label>
                                         @if($errors->has('expense_date'))
                                            <div class="error">
                                                {{$errors->first('expense_date')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Expense Category</label>
                                        <select class="form-control" name="category_id">
                                            @foreach($category as $cat)
                                                <option value="{{$cat->id}}" {{ ( $cat->id == $edit->category_id) ? 'selected' : '' }}> {{$cat->category_name}} </option>
                                            @endforeach    
                                        </select>
                                     </div>
                                 </div>

                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Warehouse</label>
                                        <select class="form-control" name="warehouse_id">
                                            @foreach($warehouse as $ware)
                                                <option value="{{$ware->id}}" {{ ( $ware->id == $edit->warehouse_id) ? 'selected' : '' }}> {{$ware->name}} </option>
                                            @endforeach  
                                        </select>
                                     </div>
                                 </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="expense_amount" autocomplete="off" value="{{$edit->expense_amount}}">
                                        <label class="form-label">Expense Amount *</label>
                                         @if($errors->has('expense_amount'))
                                            <div class="error">
                                                {{$errors->first('expense_amount')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        @if($edit->attachment!='')
                                          <img width="100px" height="50px" src="{{asset('expense_attachment/'.$edit->attachment)}}">
                                        @endif 
                                        <input type="file" class="form-control" name="expense_attachment">
                                    </div>
                                    <input type="hidden" name="d_logo" value="{{$edit->attachment}}">
                                </div>
                     
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="note" cols="30" rows="5" maxlength="100" class="form-control no-resize">{{$edit->note}}</textarea>
                                        <label class="form-label">Note</label>
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

                                <button class="btn btn-primary waves-effect" type="submit">SAVE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      