 @extends('admin.layouts.master')
   @section('title') Dashboard | Supplier Payment @endsection
   @section('content')
       <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PURCHASE DETAILS</h2>
                        </div>
                        <div class="body">
                           <h4 class="text-center">Purchase Details of supplier: {{$data[0]->suppliers->supplier_name}}</h4>
                           <br><br>
                            <div class="table-responsive">
                             <form method="post" action="{{route('payment_supplier_update')}}">
                               @csrf 
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice No</th>
                                            <th>Purchase date</th>
                                            <th>Total Purchase</th>
                                            <th>Total Payment</th>
                                            <th>Total Due</th>
                                            <th>Purchase By</th>
                                            <th>Payment</th>
                                            <th>Purchase Status</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @foreach($data as $key=>$item)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td><a target="_blank" href="{{route('purchase.show',$item->id)}}" title="view details">Invoice-{{$item->id}}</a></td>
                                                    <td>{{date('d-m-Y',strtotime($item->purchase_date))}}</td>
                                                    <td>{{number_format($item->total_price)}} Tk</td>
                                                    <td>{{number_format($item->total_payment)}} Tk</td>
                                                    <td>{{number_format($item->total_due)}} Tk</td>
                                                    <td>{{optional($item->user)->name}}</td>
                                                    <td><input type="number" class="form-control" name="payment_amount[]" value="0" min="0" max="{{$item->total_due}}"></td>                                                  
                                                      <td>
                                                       <select class="form-control" name="status[]">
                                                          @if($item->status=='Received')
                                                            <option value="Received" selected>Received</option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Ordered">Ordered</option>
                                                            @elseif($item->status=='Pending') 
                                                            <option value="Pending" selected>Pending</option>
                                                            <option value="Received">Received</option>
                                                            <option value="Ordered">Ordered</option>
                                                            @else 
                                                            <option value="Ordered" selected>Ordered</option>
                                                            <option value="Received">Received</option>
                                                            <option value="Pending">Pending</option>
                                                          @endif   
                                                       </select>
                                                    </td>
                                                      <td>
                                                       <select class="form-control" name="payment_status[]">
                                                          @if($item->payment_status=='Paid')
                                                            <option value="Paid" selected>Paid</option>
                                                            <option value="Due">Due</option>
                                                            @else 
                                                            <option value="Paid">Paid</option>
                                                            <option value="Due" selected>Due</option>
                                                          @endif   
                                                       </select>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="purchase_invoice_id[]" value="{{$item->id}}">
                                                <input type="hidden" name="total_purchase[]" value="{{$item->total_price}}">
                                                <input type="hidden" name="total_payment[]" value="{{$item->total_payment}}">
                                                <input type="hidden" name="total_due[]" value="{{$item->id}}">
                                                <input type="hidden" name="supplier_id[]" value="{{$item->supplier_id}}">
                                            @endforeach 
                                     </tbody>
                                  </table>
                                  <div class="d-flex flex-wrap">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label>Payment Method</label>
                                            <select class="form-control" name="payment_method">
                                               <option value="Cash">Cash</option>
                                               <option value="bKash">bKask</option>
                                               <option value="Bank">Bank</option>
                                            </select>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                         <div class="form-group">
                                            <label id="payment_date">Payment date</label>
                                            <input id="payment_date" type="date" class="form-control" name="payment_date" value="{{date('Y-m-d')}}"> 
                                        </div>
                                    </div>

                                     <div class="col-md-12">
                                       <button type="submit" class="btn btn-success btn-lg">Payment</button>
                                    </div>
                                   </div>
                               </form>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endsection      