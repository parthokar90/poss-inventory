 @extends('admin.layouts.master')
   @section('title') Dashboard | Inventory @endsection
   @section('content')
       <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
            <div class="row clearfix">
                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                       <div class="info-box bg-info hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">accessibility</i>
                        </div>
                        <div class="content">
                            <div class="text">USERS</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_users}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-green hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">playlist_add_check</i>
                                </div>
                                <div class="content">
                                    <div class="text">PRODUCTS</div>
                                    <div class="number count-to" data-from="0" data-to="{{$total_product}}" data-speed="15" data-fresh-interval="20"></div>
                                </div>
                            </div>
                    </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                       <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">accessibility</i>
                        </div>
                        <div class="content">
                            <div class="text">SUPPLIERS</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_supplier}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                     <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">accessibility</i>
                        </div>
                        <div class="content">
                            <div class="text">CUSTOMERS</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_customer}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-success hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">money</i>
                        </div>
                        <div class="content">
                            <div class="text">TODAY PURCHASE</div>
                            <div class="number">{{number_format($today_purchase)}} Tk</div>
                        </div>
                    </div>
                </div>
               <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">money</i>
                        </div>
                        <div class="content">
                            <div class="text">TODAY SALES</div>
                            <div class="number">{{number_format($today_sales)}} Tk</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-grey hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">money</i>
                        </div>
                        <div class="content">
                            <div class="text">TODAY EXPENSE</div>
                            <div class="number">{{number_format($today_expense)}} Tk</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">notifications</i>
                        </div>
                        <div class="content">
                            <div class="text">NOTIFICATION</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_notification}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row clearfix">
                <!-- purchase Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>TODAY PURCHASE LIST</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive" style="height:300px; overflow:auto;">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice</th>
                                            <th>Discount %</th>
                                            <th>Vat %</th>
                                            <th>Supplier</th>
                                            <th>Purchase Date</th>
                                            <th>Purchased by</th>
                                            <th>Total Purchase</th>
                                            <th>Total Payment</th>
                                            <th>Total Due</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @php $total_purchases=0; $total_payments=0; $total_dues=0; @endphp
                                         @if($purchase_list->count()>0)
                                           @foreach($purchase_list as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td><a style="color:orange;text-decoration:none;" href="{{route('purchase.edit',$item->id)}}">Invoice-{{$item->id}}</a></td>
                                                <td>{{$item->purchase_discount}} %</td>
                                                <td>{{$item->purchase_vat}} %</td>
                                                <td>{{optional($item->suppliers)->supplier_name}}</td>
                                                <td>{{$item->purchase_date}}</td>
                                                <td>{{optional($item->user)->name}}</td>
                                                <td>{{number_format($item->total_price)}} Tk</td>
                                                <td>{{number_format($item->total_payment)}} Tk</td>
                                                <td>{{number_format($item->total_due)}} Tk</td>
                                                <td>{{$item->status}}</td>
                                            </tr>
                                             @php $total_purchases+=$item->total_price; $total_payments+=$item->total_payment; $total_dues+=$item->total_due; @endphp
                                            @endforeach 
                                        @else 
                                       <span style="text-align: center;"> No Data Found</span>
                                        @endif 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# purchase Info -->


                    <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>TODAY SALES LIST</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive" style="height:300px; overflow:auto;">
                                 <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice</th>
                                            <th>Discount %</th>
                                            <th>Vat %</th>
                                            <th>Customer</th>
                                            <th>Sale Date</th>
                                            <th>Sale by</th>
                                            <th>Total Sale</th>
                                            <th>Total Payment</th>
                                            <th>Total Due</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @php $total_sales=0; $total_payment_sale=0; $total_due_sale=0; @endphp
                                         @if($sales_list->count()>0)
                                           @foreach($sales_list as $key=>$sales_lists)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td style="color:orange"><a style="color:orange;text-decoration:none;" href="{{route('sales.edit',$sales_lists->id)}}"> Invoice-{{$sales_lists->id}}</a></td>
                                                <td>{{$sales_lists->sale_discount}} %</td>
                                                <td>{{$sales_lists->sale_vat}} %</td>
                                                <td>{{optional($sales_lists->customers)->customer_name}}</td>
                                                <td>{{$sales_lists->sale_date}}</td>
                                                <td>{{optional($sales_lists->user)->name}}</td>
                                                <td>{{number_format($sales_lists->total_price)}} Tk</td>
                                                <td>{{number_format($sales_lists->total_payment)}} Tk</td>
                                                <td>{{number_format($sales_lists->total_due)}} Tk</td>
                                                <td>@if($sales_lists->status==1) Completed @else {{$sales_lists->status}} @endif</td>
                                            </tr>
                                             @php $total_sales+=$sales_lists->total_price; $total_payment_sale+=$sales_lists->total_payment; $total_due_sale+=$sales_lists->total_due; @endphp
                                            @endforeach 
                                        @else 
                                        No Data Found
                                        @endif 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
     @endsection      