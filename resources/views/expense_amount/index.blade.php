
 @extends('admin.layouts.master')
   @section('title') Dashboard | Expense Amount @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>EXPENSE AMOUNT</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EXPENSE AMOUNT INFORMATION</h2>
                            <br><br>
                             <div class="row">
                                  <div class="col-md-6">
                                 <form method="get" action="{{route('expense_amount.index')}}">
                                    <div class="col-md-6">
                                       <div class="form-group form-float d-flex">
                                            <label>Expense Category</label>
                                            <select class="form-control" name="cat_id">
                                              @foreach($category as $categorys)
                                                        <option value="{{ $categorys->id }}" selected>{{ $categorys->category_name	 }}</option>
                                               @endforeach  
                                            </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group form-float d-flex">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name="search_date" value="{{date('Y-m-d')}}" autocomplete="off">
                                     </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">search</i></button>
                                 </form>
                               </div>
                             </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('expense_amount.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if($list->count()>0)
                                           @foreach($list as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{optional($item->ExpenseCategorys)->category_name}}</td>
                                                <td>{{number_format($item->expense_amount)}} Tk</td>
                                                <td>{{date('d-F-Y',strtotime($item->expense_date))}}</td>
                                                <td>@if($item->status==1) Active @else Inactive @endif</td>
                                                <td>
                                                  <a title="Edit" href="{{route('expense_amount.edit',$item->id)}}"><i class="material-icons">edit</i></a>
                                                </td>
                                            </tr>
                                            @endforeach 
                                         @else 
                                            No Data Found
                                        @endif 
                                    </tbody>
                                </table>
                                <div class="pull-right">{{$list->links()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      