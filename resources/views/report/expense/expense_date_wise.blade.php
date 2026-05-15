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
                         <form method="post" action="{{route('expense_reports_date')}}">
                           @csrf 
                           <div class="row">
                          
                              <div class="col-md-6">
                                 <div class="form-group">
                                      <label>Start Date</label>
                                      <input class="form-control" type="date" name="start" value="{{date('Y-m-d')}}">
                                  </div>
                              </div>

                              <div class="col-md-6">
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
                           <div class="text-center">
                                <h1>{{$company->company_name}}</h1>
                                <span>{{$company->company_email}}</span><br>
                                <span>{{$company->company_phone}}</span><br>
                                <span>{{$company->company_address}}</span><br>
                                <span>Expense Report</span><br>
                                <span style="font-weight: bold;">From {{date('d-m-Y',strtotime($start))}} To {{date('d-m-Y',strtotime($end))}}</span><br>
                           </div> 
                               <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Expense Date</th>
                                            <th>Warehouse</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Expense By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @php $total_expense=0; @endphp
                                           @foreach($data as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{date('d-m-Y',strtotime($item->expense_date))}}</td>
                                                <td>{{$item->Warehouses->name}}</td>
                                                <td>{{$item->ExpenseCategorys->category_name}}</td>
                                                <td>{{number_format($item->expense_amount)}} Tk @php $total_expense+=$item->expense_amount; @endphp</td>
                                                <td>{{$item->users->name}}</td>
                                            </tr>
                                            @endforeach  
                                    </tbody>
                                     <tfoot>
                                        <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{number_format($total_expense)}} Tk</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="pull-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      