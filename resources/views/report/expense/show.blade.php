 @extends('admin.layouts.master')
   @section('title') Dashboard | Expense Report @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>EXPENSE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EXPENSE REPORT</h2>
                          
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('units.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                         <form method="post" action="{{route('expense_reports_show')}}">
                          @csrf 
                           <div class="row">
                             <div class="col-md-4">
                                   <div class="form-group form-float">
                                       <div class="form-line">
                                            <label>Select Category</label>
                                            <select id="item_add" class="form-control" name="cat_id" required>
                                                <option value="">Select</option>
                                                    @foreach($category as $categorys)
                                                      <option value="{{$categorys->id}}">{{$categorys->category_name}} </option>
                                                    @endforeach   
                                            </select>
                                       </div>
                                   </div>
                               </div>
                          
                              <div class="col-md-4">
                                 <div class="form-group">
                                      <label>Start Date</label>
                                      <input class="form-control" type="date" name="start" value="{{date('Y-m-d')}}">
                                  </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group">
                                     <label>End Date</label>
                                     <input class="form-control" type="date" name="end" value="{{date('Y-m-t')}}"> 
                                  </div>
                              </div>

                             <div class="col-md-12">
                                <div style="float:left;">
                                     <button style="margin-right: 3px;" type="submit" class="btn bg-green waves-effect">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>
                                <div style="float:left;">
                                     <button name="pdf" value="pdf_download" style="margin-right: 3px;" class="btn bg-purple btn-lg waves-effect" type="submit">
                                      DOWNLOAD PDF
                                     </button>
                                </div>
                             </div> 
                            </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>Expense</th>
                                                <th>Created By</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @php $total=0; @endphp
                                           @foreach($data as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{optional($item->ExpenseCategorys)->category_name}}</td>
                                                <td>{{number_format($item->expense_amount)}} Tk @php $total+=$item->expense_amount; @endphp</td>
                                                <td>{{optional($item->users)->name}}</td>
                                                <td>{{date('d-F-Y',strtotime($item->expense_date))}}</td>
                                            </tr>
                                            @endforeach 
                                       </tbody>
                                         <tfoot>
                                            <tr>
                                            <td></td>
                                            <td>Total</td>
                                            <td>{{number_format($total)}} Tk</td>
                                            </tr>
                                        </tfoot>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
                $("#item_add").select2();
        </script>
     @endsection      