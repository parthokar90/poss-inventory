   @extends('admin.layouts.master')
   @section('title') Dashboard | Add Sell @endsection
   @section('content')
      <style>
        .error{
            color:red;
        }
      .ex1 {
        height: 300px;
        overflow-y: scroll;
      }
   </style>
       <div class="container-fluid">
            @include('admin.includes.messages')
               <div class="row clearfix">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="card">
                                <div class="header">
                                    <h2>POS SELL</h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{route('product.index')}}">List</a></li>
                                                <li><a href="{{route('product.create')}}">Add</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                  <div class="row">

                                  <form method="post" action="{{route('sales.store')}}">
                                     @csrf 
                                     <div class="col-md-5">
                                         <!-- customer start -->
                                          <div class="form-group">
                                                <label>Customer</label>
                                                <div class="form-line">
                                                        <select id="customer_id" class="form-control" name="customer_id" required>
                                                                @foreach($customer as $customers)
                                                                   <option value="{{$customers->id}}">({{$customers->customer_phone}})-{{$customers->customer_name}}</option>
                                                                @endforeach   
                                                        </select>
                                                  </div>
                                            </div>
                                          <!-- customer end -->

                                          <!-- warehouse start -->
                                          <div class="form-group form-float">
                                                <label>Warehouse</label>
                                                <div class="form-line">
                                                        <select id="warehouse_id" class="form-control" name="warehouse_id">
                                                                <option value="">Select</option>
                                                                @foreach($warehouse as $warehouses)
                                                                   <option value="{{$warehouses->id}}">({{$warehouses->name}})</option>
                                                                @endforeach   
                                                        </select>
                                                  </div>
                                            </div>
                                          <!-- warehouse end -->

                                          <!-- product start -->
                                              <div class="form-group form-float">
                                                 <div class="form-line">
                                                         <select id="product_id" class="form-control" name="product_id">
                                                                <option value="">Scan search product by name/code</option>
                                                                @foreach($product as $item)
                                                                   <option value="{{$item->id}}">({{$item->product_name}})-{{$item->product_code}}</option>
                                                                @endforeach 
                                                        </select>
                                                    </div>
                                             </div>
                                          <!-- product end -->

                                          <!-- table start -->
                                           <div class="table-responsive ex1">
                                              <table class="table" id="productTable">
                                                <tbody>
                                                </tbody>
                                              </table>
                                           </div>
                                          <!-- calculation table start -->
                                          <table id="totalTable" style="width:100%; float:right; padding:5px; color:#000; background: #FFF;">
                                                <tbody><tr>
                                                    <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Items</td>
                                                    <td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                                        <span id="count"></span>
                                                    </td>
                                                    <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Total</td>
                                                    <td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                                        <span id="total"></span>
                                                        <input type="hidden" id="order_total" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 10px;">Order Tax %
                                                        
                                                    </td>
                                                    <td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;">
                                                       <input value="0" min="0" type="number" id="tax" name="tax" autocomplete="off">
                                                    </td>
                                                    <td style="padding: 5px 10px;">Discount %                                                                                      <a href="#" id="ppdiscount" tabindex="-1">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-right" style="padding: 5px 10px;font-weight:bold;">
                                                        <input value="0" min="0" type="number" id="discount" name="discount" autocomplete="off">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 10px; border-top: 1px solid #666; border-bottom: 1px solid #333; font-weight:bold; background:#333; color:#FFF;" colspan="2">
                                                        Total Payable  <a href="#" id="pshipping" tabindex="-1">
                                                            <i class="fa fa-plus-square"></i>
                                                        </a>
                                                        <span id="tship"></span>
                                                    </td>
                                                    <td class="text-right" style="padding:5px 10px 5px 10px; font-size: 14px;border-top: 1px solid #666; border-bottom: 1px solid #333; font-weight:bold; background:#333; color:#FFF;" colspan="2">
                                                        <span id="gtotal"></span>
                                                       
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                          <!-- calculation table end -->

                                           <!-- date and payment method start -->
                                           <div class="col-md-6">
                                             <div class="form-group">
                                               <label>Sell Date</label>
                                               <input type="date" class="form-control" name="sale_date" autocomplete="off" value="2021-05-03">
                                             </div>  
                                           </div> 
                                            <div class="col-md-6">
                                             <div class="form-group">
                                               <label>Payment Method</label>
                                               <select class="form-control" name="payment_method">
                                                  <option value="bKash">bKash</option>
                                                  <option value="visa">Visa</option>
                                                  <option value="master">Master</option>
                                               </select>
                                             </div>  
                                           </div> 
                                           <!-- date and payment method end -->

                                           <!-- sell note start -->
                                           <div class="col-md-6">
                                                <div class="form-group">
                                                 <label>Sell Note</label>
                                                  <textarea style="border:1px solid #000000" class="form-control" name="sale_note"></textarea>
                                                </div>
                                           </div>
                                           <!-- sell note end -->

                                           <!-- sell payment amount start -->
                                           <div class="col-md-6">
                                                       <div class="form-line">
                                                 <label>Enter Payment Amount</label>
                                                  <input type="number" class="form-control" min="0" max="" name="total_payment">
                                                </div>
                                           </div>
                                           <!-- sell payment amount end -->

                                           <div style="width:100%">
                                               <button style="width:100%" type="submit" class="btn btn-info">Sell Item</button>
                                           </div>
                                          <!-- table end -->
                                        </form>



                                      </div>
                                      <div class="col-md-7">
                                       @foreach($product as $item)
                                            <div class="col-md-3 col-6">
                                                <!-- card start -->
                                                <div class="card product_item" id="{{$item->id}}">
                                                        <img width="100%" height="100px" class="card-img-top" src="{{asset('product_image/'.$item->product_image)}}" alt="Card image cap">
                                                        <div class="card-body">
                                                            <h5 style="padding-bottom:16px;" class="card-title text-center">{{$item->product_name}}</h5>
                                                        </div>
                                                </div>
                                                <!-- card end -->
                                             </div>  
                                         @endforeach 
                                      </div>
                                   </div>
                               </div>
                           </div>
                      </div>
                 </div>
            </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>

        //select 2 start
            $("#product_id").select2();
            $("#biller_id").select2();
            $("#customer_id").select2();
            $("#warehouse_id").select2();
        // select 2 end

          //all item
          function getItem(){
              $.ajax({
                    url: "{{url('/ajax/item/all')}}",
                    type: "GET",
                    success: function(response) {
                           total_item()
                           total_price();
                           var items = "<thead><tr><th scope='col'>Product</th><th scope='col'>Price</th><th scope='col'>Quantity</th><th scope='col'>Sub Total</th><th scope='col'>Action</th></tr></thead>"; 
                    $.each(response, function(i, item) {
                       remove_id=item.id;  
                      items+="<tr><td>"+item.product_name+"</td><td>"+item.price+"</td><td><input  id='qty' onkeyup=update('"+remove_id+"',this.value) type='number' name='quantity' value="+item.quantity+" autocomplete='off'></td><td id='after_sub'>"+item.sub_total+"</td><td><button class='removeButton btn btn-danger btn-sm' onclick=remove('"+remove_id+"')> X </button></td></tr>";
                          $("#productTable").html(items);
                    });  
                    },
                    error: function(response) {
                          
                    },
                });
          }
          //end all item


        // send ajax request after product image click
        $('.product_item').click(function(){
           var id = $(this).attr("id");
             $.ajax({
                url: "{{url('/product/ajax/')}}" + '/' + id,
                type: "GET",
                success: function(response) {
                    var remove_id='';
                    var items = "<thead><tr><th scope='col'>Product</th><th scope='col'>Price</th><th scope='col'>Quantity</th><th scope='col'>Sub Total</th><th scope='col'>Action</th></tr></thead>"; 
                    $.each(response, function(i, item) {
                       remove_id=item.id;  
                      items+="<tr><td>"+item.product_name+"</td><td>"+item.price+"</td><td><input  id='qty' onkeyup=update('"+remove_id+"',this.value) type='number' name='quantity' value="+item.quantity+" autocomplete='off'></td><td id='after_sub'>"+item.sub_total+"</td><td><button class='removeButton btn btn-danger btn-sm' onclick=remove('"+remove_id+"')> X </button></td></tr>";
                          $("#productTable").html(items);
                    });  
                    total_item()
                    total_price();
                    grandTotal();
                 },
                    error: function(response) {
                       
                    },
                });
          });
        // end ajax request after product image click

        //select product  than call ajax
         $("#product_id").change(function(){
           var id = $("#product_id").val();
             $.ajax({
                url: "{{url('/product/ajax/')}}" + '/' + id,
                type: "GET",
                success: function(response) {
                    var remove_id='';
                    var items = "<thead><tr><th scope='col'>Product</th><th scope='col'>Price</th><th scope='col'>Quantity</th><th scope='col'>Sub Total</th><th scope='col'>Action</th></tr></thead>"; 
                    $.each(response, function(i, item) {
                       remove_id=item.id;  
                      items+="<tr><td>"+item.product_name+"</td><td>"+item.price+"</td><td><input  id='qty' onkeyup=update('"+remove_id+"',this.value) type='number' name='quantity' value="+item.quantity+" autocomplete='off'></td><td id='after_sub'>"+item.sub_total+"</td><td><button class='removeButton btn btn-danger btn-sm' onclick=remove('"+remove_id+"')> X </button></td></tr>";
                          $("#productTable").html(items);
                    });  
                    total_item()
                    total_price();
                    grandTotal();
                 },
                    error: function(response) {
                       
                    },
                });
         });
        //select product than call ajax end


        //total item count start
           function total_item(){
                $.ajax({
                    url: "{{url('/ajax/item')}}",
                    type: "GET",
                    success: function(response) {
                       document.getElementById('count').innerHTML=response;
                    },
                    error: function(response) {
                        
                    },
                });
           }
             
        //total item count end


        //total order price start
          function total_price(){
                $.ajax({
                    url: "{{url('/ajax/total')}}",
                    type: "GET",
                    success: function(response) {
                       document.getElementById('total').innerHTML=response;
                       document.getElementById('order_total').value=response;
                    },
                    error: function(response) {
                          
                    },
                });
            }
        //total order price end



        //total order with vat and discount
           function grandTotal(){
                $.ajax({
                    url: "{{url('/ajax/grandTotal/')}}",
                    type: "GET",
                    success: function(response) {
                       document.getElementById('gtotal').innerHTML=response;
                    },
                    error: function(response) {
                          
                    },
                });
           }
        //total order with vat and discount end



        //update quantity start
          function update(id,value){
               $.ajax({
                    url: "{{url('/ajax/item/update/')}}"+"/"+id+"/"+value,
                    type: "GET",
                    success: function(response) {
                           getItem() 
                           total_item()
                           total_price();
                            grandTotal();
                    },
                    error: function(response) {
                         
                    },
                });
          }
         //update quantity end

   
        //item remove start
        function remove(id){
           $.ajax({
                    url: "{{url('/ajax/item/remove/')}}"+"/"+id,
                    type: "GET",
                    success: function(response) {
                       total_item()
                       total_price();
                        grandTotal();
                    },
                    error: function(response) {
                           
                    },
                });
         }
         $(document).on("click", ".removeButton", function(){
             $(this).closest("tr").remove();
         });
        //item remove end


        //tax start
        $("#tax").bind('keyup mouseup', function () {
              var tax=$("#tax").val();  
               $.ajax({
                    url: "{{url('/ajax/tax/')}}"+"/"+tax,
                    type: "GET",
                    success: function(response) {
                        grandTotal();
                    },
                    error: function(response) {
                           console.log(response); 
                    },
                }); 
         }); 
        //tax end

        //discount start
        $("#discount").bind('keyup mouseup', function () {
           var discount=$("#discount").val(); 
              $.ajax({
                    url: "{{url('/ajax/discount/')}}"+"/"+discount,
                    type: "GET",
                    success: function(response) {
                        grandTotal();
                    },
                    error: function(response) {
                           console.log(response); 
                    },
                }); 
         }); 
        //discount end


        // if select warehouse then show product
            $("#warehouse_id").change(function(){
              var id=$("#warehouse_id").val();
                $.ajax({
                url: "{{url('/warehouse_product/')}}" + '/' + id,
                type: "GET",
                success: function(response) {
                    var items = "<option value=''>Select</option>"; 
                    $.each(response, function(i, item) {
                        items += "<option value='" + item.id + "'>" + (item
                                .product_name) +
                            "</option>";
                    });
                    $("#product_id").html(items);
                 },
                    error: function(response) {
                        console.log(response);
                    },
                });
           });
        </script>
     @endsection      