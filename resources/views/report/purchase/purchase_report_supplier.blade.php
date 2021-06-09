 @extends('admin.layouts.master')
   @section('title') Dashboard | Purchase Report @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="block-header">
                <h2>PURCHASE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PURCHASE REPORT</h2>
                        </div>
                        <div class="body">
                           <div class="text-center">
                                 <h1>{{$company->company_name}}</h1>
                                <span>{{$company->company_email}}</span><br>
                                <span>{{$company->company_phone}}</span><br>
                                <span>{{$company->company_address}}</span><br>
                                <span style="font-weight: bold;">Purchase Report of Supplier {{$data[0]->suppliers->supplier_name}}</span><br>
                                <span style="font-weight: bold;">From {{date('d-m-Y',strtotime($start))}} To {{date('d-m-Y',strtotime($end))}}</span><br>
                           </div> 
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice</th>
                                            <th>Purchase Date</th>
                                            <th>Vat</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Amount</th>
                                            <th>Purchase</th>
                                            <th>Payment</th>
                                            <th>Due</th>
                                            <th>Purchased By</th>
                                            <th>Status</th>
                                            <th>Items</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @php $total_purchase=0; $total_payments=0; $total_dues=0; @endphp
                                           @foreach($data as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td style="font-weight: bold;">Invoice-{{$item->id}}</td>
                                                <td>{{date('d-m-Y',strtotime($item->purchase_date))}}</td>
                                                <td>{{$item->purchase_vat}} %</td>
                                                <td>{{number_format($item->purchase_vat_amount)}} Tk</td>
                                                <td>{{$item->purchase_discount}} %</td>
                                                <td>{{number_format($item->purchase_discount_amount)}} Tk</td>
                                                <td>{{number_format($item->total_price)}} Tk @php $total_purchase+=$item->total_price; @endphp</td>
                                                <td>{{number_format($item->total_payment)}} Tk @php $total_payments+=$item->total_payment; @endphp</td>
                                                <td>{{number_format($item->total_due)}} Tk  @php $total_dues+=$item->total_due; @endphp</td>
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
                                                        @foreach($item->purchaseItem as $details)
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
                                        <td>{{number_format($total_purchase)}} Tk</td>
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