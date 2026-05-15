 @extends('admin.layouts.master')
   @section('title') Dashboard | Payment Report @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>PAYMENT</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PAYMENT REPORT</h2>
                        </div>
                        <div class="body">
                           <div class="text-center">
                                 <h1>{{$company->company_name}}</h1>
                                <span>{{$company->company_email}}</span><br>
                                <span>{{$company->company_phone}}</span><br>
                                <span>{{$company->company_address}}</span><br>
                                <span style="font-weight: bold;">Payment Report of Supplier {{$data[0]->suppliers->supplier_name}}</span><br>
                                <span style="font-weight: bold;">From {{date('d-m-Y',strtotime($start))}} To {{date('d-m-Y',strtotime($end))}}</span><br>
                            </div> 
                              <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice</th>
                                            <th>Total Purchase</th>
                                            <th>Payment Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($data as $key=>$item)
                                              @php $total_payment=0; $total_payments=0; $total_dues=0; @endphp
                                              <tr>
                                                <td>{{++$key}}</td>
                                                <td style="font-weight: bold;">Invoice-{{$item->purchase_invoice_id}}</td>
                                                <td style="font-weight: bold;">{{number_format($item->total_purchase)}} Tk</td>
                                                <td>
                                                  <table style="width:100%">
                                                    <tbody>
                                                    <tr>
                                                        <th>Payment Date</th>
                                                        <th>Payment Amount</th>
                                                        <th>Payment By</th>
                                                    </tr>
                                                        @foreach($payment_item[$item->purchase_invoice_id] as $key=> $items)
                                                            <tr>
                                                                <td>{{$items['payment_date']}}</td>
                                                                <td>{{number_format($items['payment_amount'])}} Tk @php $total_payment+=$items['payment_amount']; @endphp</td>
                                                                <td>
                                                                 {{$items['user']['name']}}
                                                                </td>
                                                            </tr>
                                                        @endforeach    
                                                    </tbody>                                            
                                                 </table>
                                                   <span style="background: blue;padding: 5px;color: #ffffff;">Purchase: {{number_format($item->total_purchase)}} Tk</span>                                        
                                                   <span style="background: green;padding: 5px;color: #ffffff;">Payment: {{number_format($total_payment)}} Tk</span>                                        
                                                   <span style="background: yellow;padding: 5px;color: #000000;">Due: @php $total_due=$item->total_purchase-$total_payment; @endphp {{number_format($total_due)}} Tk</span>  
                                                </td>
                                           
                                            </tr>
                                            @endforeach  
                                    </tbody>
                                </table>
                                <div class="pull-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      