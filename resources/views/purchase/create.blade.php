 @extends('admin.layouts.master')
   @section('title') Dashboard | Add Purchase @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>

       <div class="container-fluid">
        @include('admin.includes.messages')
            <div class="block-header">
                <h2>PURCHASE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE PURCHASE INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('purchase.index')}}">List</a></li>
                                        <li><a href="{{route('purchase.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                             <div class="row">
                                <form id="form-id" action="{{url('/temp/purchase')}}" method="post"> 
                                 @csrf
                                <div class="col-md-11">
                                   <div class="form-group form-float">
                                       <div class="form-line">
                 
                                            <select id="item_add" class="form-control" name="product_id" required>
                                                <option value="">Select Product</option>
                                                    @foreach($product as $products)
                                                    <option value="{{$products->id}}">{{$products->product_name}} ({{$products->product_code}})</option>
                                                    @endforeach   
                                            </select>
                                               @if($errors->has('product_id'))
                                                    <div class="error">
                                                        {{$errors->first('product_id')}}
                                                    </div>
                                              @endif
                                       </div>
                                   </div>
                                </div>
                                <div class="col-md-1">
                                   <button style="padding: 1px 3px;margin-top:4px;" class="btn btn-primary btn-sm waves-effect pull-left" type="submit"><i class="material-icons">add</i></button>
                                </div>
                                </form>
                             </div> 
                          @if($data->count()>0)
                           <form id="form-id" action="{{route('purchase.store')}}" method="post"> 
                                 @csrf
                              <div class="row">
                                <div class="col-md-3">
                                   <div class="form-group form-float">
                                       <div class="form-line">
                                           <input type="date" class="form-control" name="purchase_date" autocomplete="off" value="{{date('Y-m-d')}}">
                                           <label class="form-label">Purchase Date *</label>
                                            @if($errors->has('purchase_date'))
                                               <div class="error">
                                                  {{$errors->first('purchase_date')}}
                                               </div>
                                            @endif
                                       </div>
                                   </div>
                                </div>
                               <div class="col-md-3">
                                    <div class="form-group form-float">
                                            <label>Supplier</label>
                                            <select class="form-control" name="supplier_id" id="supplier_add">
                                              @foreach($supplier as $suppliers)
                                                   @if (old('supplier_id') == $suppliers->id)
                                                        <option value="{{ $suppliers->id }}" selected>{{ $suppliers->supplier_name }}</option>
                                                    @else
                                                        <option value="{{ $suppliers->id }}">{{ $suppliers->supplier_name }}</option>
                                                    @endif
                                               @endforeach  
                                            </select>
                                             @if($errors->has('supplier_id'))
                                                    <div class="error">
                                                        {{$errors->first('supplier_id')}}
                                                    </div>
                                              @endif
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                       <div class="form-line">
                                        <label class="form-label">Purchase Status</label>
                                        <select class="form-control" name="status" required>
                                            <option value="Received" selected>Received</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Ordered" >Ordered</option> 
                                        </select>
                                     </div>
                                   </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                       <div class="form-line">
                                        <label class="form-label">Payment Status</label>
                                        <select class="form-control" name="payment_status" required>
                                            <option value="Paid" selected>Paid</option>
                                            <option value="Due">Due</option> 
                                        </select>
                                     </div>
                                   </div>
                                </div>
                             </div>
                             <div class="row">
                               <div class="col-md-12">
                                 <h4 class="text-center">Purchase Item List</h4>
                                   <div class="table-responsive">
                                  <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Cost</th>
                                            <th>Price</th>
                                            <th>Tax</th>
                                            <th>Tax Amount</th>
                                            <th>Item Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $tax_total=0; $total_order=0; $grand_total=0; @endphp
                                        @foreach($data as $item)
                                            <tr>
                                                <td><a style="padding: 1px 3px;margin-top:6px;"  class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Remove Item" href="{{route('full_delete',$item->product_id)}}"><i class="material-icons">delete</i></a> {{$item->product}} ({{$item->code}})</td>
                                                <td>{{number_format($item->cost)}} Tk</td>
                                                <td>{{number_format($item->product_price)}} Tk</td>
                                                <td>@if($item->tax_rate_type==1) @php $tax_total=$item->product_price/100*$item->tax; @endphp {{$item->tax}} % @elseif($item->tax_rate_type==0) @php $tax_total=$item->tax; @endphp {{number_format($item->tax)}} Tk @else No Tax @endif</td>
                                                <td>{{number_format($tax_total)}} Tk</td>
                                                      <!-- product  id wise multiple item start -->
                                                      <td> 
                                                       <input type="hidden" name="products_id[]" value="{{$item->product_id}}">
                                                            @php $total_varient_price=0; @endphp
                                                            @foreach($item->products->temporaryPurchases as $details) 
                                                            <table class="table table-hover dashboard-task-infos">
                                                            <thead>
                                                                <tr>
                                                                    <th>Warehouse</th>
                                                                    <th>Stock</th>
                                                                    <th>Varient</th>
                                                                    <th>Varient Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                        <tr>
                                                            <td>{{$details->warehouse}}</td>
                                                            <td>{{$details->stock_qty}}</td>
                                                            <td>{{$details->varient}}</td>
                                                            <td>{{number_format($details->varient_price)}} Tk @php $total_varient_price+=$details->varient_price; @endphp</td>
                                                            <td>
                                                               <input type="number" min="0" value="{{$details->input_qty}}" name="qtyy[]">
                                                               <input type="hidden"  name="pro_id[]" value="{{$details->product_id}}">
                                                               <input type="hidden"  name="ware_id[]" value="{{$details->warehouse_id}}">
                                                               <input type="hidden"  name="variantss_id[]" value="{{$details->varient_id}}">
                                                               <input type="hidden"  name="update_id[]" value="{{$details->id}}">
                                                            </td>
                                                            <td>@php $total_order_price=($details->product_price+$details->varient_price)*$details->input_qty; @endphp {{number_format($total_order_price)}} Tk @php $grand_total+=$total_order_price; @endphp</td>
                                                            <input type="hidden" name="sub_total_price[]" value="{{$total_order_price}}">
                                                            <td>
                                                               <a style="color:red" class="btn-sm" onclick="return confirm('Are you sure?')" title="Remove Item" href="{{route('item_delete',$details->id)}}">X</a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        </table>
                                                        @endforeach 
                                                    </td>
                                                    <!-- product id wise multiple item end -->
                                                 </tr>
                                              @endforeach  
                                       </tbody>
                                  </table>
                                    <div class="card">
                                      <div class="card-body">
                                       <div class="d-flex flex-wrap">
                                            <div class="col-md-2">
                                                Vat: {{$vat}}% 
                                            </div>
                                            <div class="col-md-2">
                                                Vat Amount: {{number_format($vat_amount)}} Tk
                                            </div>
                                            <div class="col-md-2">
                                                Discount: {{$discount}} %
                                            </div>
                                            <div class="col-md-2">
                                                Discount Amount: {{number_format($discount_amount)}} Tk
                                            </div>
                                              <div class="col-md-2">
                                                Total Payable: {{number_format($total_payable)}} Tk
                                            </div>
                                            <div class="col-md-2">
                                                Total Due: {{number_format($total_payable)}} Tk
                                            </div>
                                       </div>   

                                      </div>
                                   </div>
                                   <div class="pull-right"></div>
                                 </div>
                               </div>
                              <div class="col-md-3">
                                 <div class="form-group form-float">
                                       <div class="form-line">
                                        <label>Vat %</label>
                                        <input type="number" id="vat" name="vat" class="form-control" min="0" value="{{$vat}}"> 
                                        <button id="vat_btn">+</button>
                                     </div>
                                      <input type="hidden" id="total_price" name="total_price" value="{{$grand_total}}">
                                 </div>
                              </div>

                              <div class="col-md-3">
                                   <div class="form-group form-float">
                                       <div class="form-line">
                                        <label>Discount %</label>
                                        <input type="number" id="discount" name="discount" class="form-control" min="0" value="{{$discount}}"> 
                                        <button id="discount_btn">-</button>
                                     </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                   <div class="form-group form-float">
                                       <div class="form-line">
                                        <label>Payment</label>
                                         <input style="margin-top: 23px;" type="number" name="purchase_payment" class="form-control" min="0" max="{{$total_payable}}" value="0"> 
                                     </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group form-float">
                                       <div class="form-line">
                                        <label>Note</label>
                                        <textarea class="form-control" name="purchase_note" maxlength="50"></textarea>
                                     </div>
                                   </div>
                              </div>
                            </div> 
                            <div style="text-align: center;"> 
                               <button class="btn btn-warning btn-lg waves-effec" name="quantity_update" value="quantity_update" type="submit">Update Quantity</button>
                               <button class="btn btn-primary btn-lg waves-effec" type="submit">Purchase Product</button>
                             </div>
                            </form>
                              @else
                              <div style="text-align: center;"> No Purchase Item List Found </div>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $("#item_add").select2();
            $("#supplier_add").select2();
            $("#vat_btn").click(function(e){
              e.preventDefault();  
              let vat=$("#vat").val();
              if(vat==''){
                alert('enter value');
                return false;
              }
              if(vat<0){
                 alert('enter correct value');
                 return false;
              }
               $.ajax({
                type:'POST',
                url:"{{ route('vat_purchase') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    vat:vat
                },
                success:function(response){
                  location.reload();
                },error:function(response){
                   console.log(response);
                }
             });
            
            });

            $("#discount_btn").click(function(e){
              e.preventDefault();  
              let discount=$("#discount").val();
              if(discount==''){
                alert('enter value');
                return false;
              }
              if(discount<0){
                 alert('enter correct value');
                 return false;
              }
               $.ajax({
                type:'POST',
                url:"{{ route('discount_purchase') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    discount:discount
                },
                success:function(response){
                    location.reload();
                },error:function(response){
                   console.log(response);
                }
             });
            
            });
        </script>
     @endsection      