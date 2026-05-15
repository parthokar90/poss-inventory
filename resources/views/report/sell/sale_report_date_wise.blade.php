 @extends('admin.layouts.master')
   @section('title') Dashboard | Sell Report @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>SELL</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>SELL REPORT</h2>
                        </div>
                        <div class="body">
                           <div class="text-center">
                                 <h1>{{$company->company_name}}</h1>
                                <span>{{$company->company_email}}</span><br>
                                <span>{{$company->company_phone}}</span><br>
                                <span>{{$company->company_address}}</span><br>
                                <span style="font-weight: bold;">Sell Report</span><br>
                                <span style="font-weight: bold;">From {{date('d-m-Y',strtotime($start))}} To {{date('d-m-Y',strtotime($end))}}</span><br>
                           </div> 
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice</th>
                                            <th>Sale Date</th>
                                            <th>Vat</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Amount</th>
                                            <th>Sale</th>
                                            <th>Payment</th>
                                            <th>Due</th>
                                            <th>Customers</th>
                                            <th>Sale By</th>
                                            <th>Status</th>
                                            <th>Items</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @php $total_sell=0; $total_payments=0; $total_dues=0; @endphp
                                           @foreach($data as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td style="font-weight: bold;">Invoice-{{$item->id}}</td>
                                                <td>{{date('d-m-Y',strtotime($item->sale_date))}}</td>
                                                <td>{{$item->sale_vat}} %</td>
                                                <td>{{number_format($item->sale_vat_amount)}} Tk</td>
                                                <td>{{$item->sale_discount}} %</td>
                                                <td>{{number_format($item->sale_discount_amount)}} Tk</td>
                                                <td>{{number_format($item->total_price)}} Tk @php $total_sell+=$item->total_price; @endphp</td>
                                                <td>{{number_format($item->total_payment)}} Tk @php $total_payments+=$item->total_payment; @endphp</td>
                                                <td>{{number_format($item->total_due)}} Tk  @php $total_dues+=$item->total_due; @endphp</td>
                                                <td>{{optional($item->customers)->customer_name}}</td>
                                                <td>{{optional($item->user)->name}}</td>
                                                <td>{{$item->status}}</td>
                                                <td>
                                                 <table style="width:100%">
                                                    <tr>
                                                        <th>Warehouse</th>
                                                        <th>Product</th>
                                                        <th>Code</th>
                                                        <th>Cost</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                        @foreach($item->saleItem as $details)
                                                            <tr>
                                                                <td>{{$details->warehouse}}</td>
                                                                <td>{{$details->product}} {{$details->varient}}</td>
                                                                <td>{{$details->code}}</td>
                                                                <td>{{number_format($details->cost)}} Tk</td>
                                                                <td>{{number_format($details->product_price)}} Tk</td>
                                                                <td>{{$details->total_qty}}</td>
                                                            </tr>
                                                        @endforeach                                                   
                                                    </table>
                                                </td>
                                            </tr>
                                            @endforeach  
                                    </tbody>
                                     <tfoot>
                                        <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{number_format($total_sell)}} Tk</td>
                                        <td>{{number_format($total_payments)}} Tk</td>
                                        <td>{{number_format($total_dues)}} Tk</td>
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