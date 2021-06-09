 @extends('admin.layouts.master')
   @section('title') Dashboard | Sell Info @endsection
   @section('content')
       <div class="container-fluid">
         @include('admin.includes.messages')
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>SELL INFORMATION ->INVOICE #{{$invoice_details->id}}</h2>
                        </div>
                        <div class="body">
                                    <div class="row">
                                <div class="col-md-3">
                                    <h4>Customer Details</h4>
                                    <hr> 
                                       <div class="icon">
                                         <i style="font-size:40px;" class="material-icons">accessibility</i>
                                       </div>
                                         <p>{{$invoice_details->customers->customer_name}}</p>
                                         <p>{{$invoice_details->customers->customer_phone}}</p>
                                         <p>{{$invoice_details->customers->customer_email}}</p>
                                         <p>{{$invoice_details->customers->customer_address}}</p>
                                         <p>{{$invoice_details->customers->country}}</p>
                                         <p>{{$invoice_details->customers->city}}</p> 
                                </div>
                                <div class="col-md-3">
                                    <h4>Biller Details</h4>
                                     <hr> 
                                     <div class="icon">
                                         <i style="font-size:40px;" class="material-icons">face</i>
                                     </div>
                                         <p>{{$invoice_details->billers->company}}</p>
                                         <p>{{$invoice_details->billers->phone}}</p>
                                         <p>{{$invoice_details->billers->email}}</p>
                                         <p>{{$invoice_details->billers->customer_address}}</p>
                                         <p>{{$invoice_details->billers->vat_no}}</p>
                                         <p>{{$invoice_details->billers->country}}</p> 
                                         <p>{{$invoice_details->billers->city}}</p> 
                                         <p>{{$invoice_details->billers->state}}</p> 
                                </div>
                                <div class="col-md-3">
                                    <h4>Payment Details</h4>
                                     <hr> 
                                     <div class="icon">
                                         <i style="font-size:40px;" class="material-icons">money</i>
                                     </div>
                                      <p>Sub Total: {{number_format($sub_total)}} Tk</p>
                                      <p>Vat %: {{number_format($invoice_details->sale_vat)}} </p> 
                                      <p>(+) Vat Amount: {{number_format($invoice_details->sale_vat_amount)}} Tk </p> 
                                      <p>Discount %: {{number_format($invoice_details->sale_discount)}}  </p> 
                                      <p>(-) Discount Amount: {{number_format($invoice_details->sale_discount_amount)}} Tk </p> 
                                      <p>Total: {{number_format(($sub_total+$invoice_details->sale_vat_amount)-$invoice_details->sale_discount_amount)}} @php $grand_sub=($sub_total+$invoice_details->sale_vat_amount)-$invoice_details->sale_discount_amount; @endphp</p>
                                      <p>Total Payment: {{number_format($invoice_details->total_payment)}} Tk </p>
                                      <p>Total Due: {{number_format($grand_sub-$invoice_details->total_payment)}} Tk </p>
                                      <p>Payment Method: {{$invoice_details->payment_method}} </p>
                                </div>
                                 <div class="col-md-3">
                                    <h4>Reference</h4>
                                     <hr> 
                                     <div class="icon">
                                         <i style="font-size:40px;" class="material-icons">article</i>
                                     </div>
                                       <p>Sell By: {{$invoice_details->user->name}}  </p>
                                       <p>Sell Date: {{date('d-m-Y',strtotime($invoice_details->sale_date))}}</p>
                                       <p>Payment Status: @if($invoice_details->total_due>0) Due @else Paid @endif  </p>
                                </div>
                            </div>
                           <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                          <tr>
                                            <th>Warehouse</th>
                                            <th>Product</th>
                                            <th>Code</th>
                                            <th>Cost</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Sub Total</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                     @php $total_cost=0; $total_price=0; $total_quantity=0; $total_sub=0; $totalSell=0; $total_qty=0; $total_payments=0; $total_dues=0; $total_vat=0; $total_discount=0; @endphp
                                     @foreach($data as $key=>$item)
                                           @php 
                                              $total_vat+=$item->sale_vat_amount; 
                                              $total_discount+=$item->sale_discount_amount;
                                              $totalSell+=$item->total_price;
                                              $total_payments+=$item->total_payment;
                                              $total_dues+=$item->total_due;
                                            @endphp
                                            @foreach($item->saleItem as $details)
                                                <tr>
                                                     <td>{{$details->warehouse}}</td>
                                                         <td>{{$details->product}} {{$details->varient}}</td>
                                                             <td>{{$details->code}}</td>
                                                                 <td>{{number_format($details->cost)}} Tk @php $total_cost+=$details->cost; @endphp</td>
                                                             <td>{{number_format($details->product_price+$details->varient_price)}} Tk @php $total_price+=$details->product_price+$details->varient_price; @endphp</td>
                                                        <td>{{$details->total_qty}} pcs @php $total_qty+=$details->total_qty; @endphp</td>
                                                     <td>{{number_format(($details->product_price+$details->varient_price)*$details->total_qty)}} Tk @php $total_sub+=($details->product_price+$details->varient_price)*$details->total_qty; @endphp </td>           
                                                 </tr>
                                            @endforeach    
                                     @endforeach
                                     <tfoot>
                                        <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{number_format($total_cost)}} Tk</td>
                                        <td>{{number_format($total_price)}} Tk</td>
                                        <td>{{number_format($total_qty)}} Pcs</td>
                                        <td>{{number_format($total_sub)}} Tk</td>
                                        </tr>
                                    </tfoot>
                                  </tbody>
                                </table>
                                   <div class="pull-right" style="margin-top: 10px;">
                                      <h4>Sub Total: {{number_format($total_sub)}} Tk</h4>
                                      <h4>(+)Vat: {{number_format($invoice_details->sale_vat_amount)}} Tk</h4>
                                      <h4>(-)Discount: {{number_format($invoice_details->sale_discount_amount)}} Tk</h4>
                                      <h4>Total:{{number_format($total_sub+$invoice_details->sale_vat_amount-$invoice_details->sale_discount_amount)}} Tk @php $grand=$total_sub+$invoice_details->sale_vat_amount-$invoice_details->sale_discount_amount; @endphp</h4>
                                      <h4>Total Payment: {{number_format($invoice_details->total_payment)}} Tk </h4>
                                      <h4>Total Due: {{number_format($grand-$invoice_details->total_payment)}} Tk </h4>
                                   </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      