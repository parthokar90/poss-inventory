   @extends('admin.layouts.master')
   @section('title') Dashboard | Add Quotation @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>QUOTATION</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE QUOTATION INFORMATION</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('customer.index')}}">List</a></li>
                                        <li><a href="{{route('customer.create')}}">Add</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                          <form action="{{route('quotations.store')}}" method="POST" enctype="multipart/form-data">
                             @csrf 
                                <div class="row">
                                   <div class="col-md-3">
                                      <div class="form-group form-float">
                                        <label class="form-label">Quotation Date *</label>
                                        <div class="form-line">              
                                          <input type="date" class="form-control" name="quotation_date" autocomplete="off" value="{{old('quotation_date')}}">
                                           @if($errors->has('quotation_date'))
                                            <div class="error">
                                                {{$errors->first('quotation_date')}}
                                            </div>
                                           @endif
                                        </div>
                                      </div>
                                   </div>
                                   <div class="col-md-3">
                                     <div class="form-group form-float">
                                      <label class="form-label">Reference No</label>
                                        <div class="form-line">
                                          <input type="text" class="form-control" name="reference_no" autocomplete="off" value="{{old('reference_no')}}">
                                        </div>
                                      </div>
                                   </div>
                                   <div class="col-md-3">
                                        <div class="form-group form-float">
                                         <label class="form-label">Biller *</label>
                                           <div class="form-line">
                                                <select id="item_add" class="form-control" name="product_id" required>
                                                        <option value="">dsfdf</option>
                                                </select>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group form-float">
                                         <label class="form-label">Tax *</label>
                                           <div class="form-line">
                                                <select id="tax_add" class="form-control" name="product_id" required>
                                                        <option value="">dsfdf</option>
                                                </select>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-3">
                                     <div class="form-group form-float">
                                      <label class="form-label">Discount</label>
                                        <div class="form-line">
                                          <input type="text" class="form-control" name="reference_no" autocomplete="off" value="{{old('reference_no')}}">
                                        </div>
                                      </div>
                                   </div>
                                    <div class="col-md-3">
                                     <div class="form-group form-float">
                                      <label class="form-label">Shipping</label>
                                        <div class="form-line">
                                          <input type="text" class="form-control" name="reference_no" autocomplete="off" value="{{old('reference_no')}}">
                                        </div>
                                      </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group form-float">
                                         <label class="form-label">Status *</label>
                                           <div class="form-line">
                                                <select  class="form-control" name="product_id" required>
                                                        <option value="">dsfdf</option>
                                                </select>
                                            </div>
                                        </div>
                                   </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-float">
                                         <label class="form-label">Supplier *</label>
                                           <div class="form-line">
                                                <select id="supplier_add" class="form-control" name="product_id" required>
                                                        <option value="">dsfdf</option>
                                                </select>
                                            </div>
                                         </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group form-float">
                                         <label class="form-label">Warehouse *</label>
                                           <div class="form-line">
                                            <select id="warehouse_id" class="form-control" name="warehouse_id" required>
                                              <option value="">Select Warehouse</option>
                                                 @foreach($warehouse as $warehouses)
                                                    <option value="{{$warehouses->id}}">{{$warehouses->name}}</option>
                                                 @endforeach   
                                               </select>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group form-float">
                                         <label class="form-label">Customer *</label>
                                           <div class="form-line">
                                                <select id="supplier_add" class="form-control" name="product_id" required>
                                                        <option value="">dsfdf</option>
                                                </select>
                                            </div>
                                         </div>
                                      </div>
                                  </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        <div class="form-group form-float">
                                         <label class="form-label">Product *</label>
                                           <div class="form-line">
                                                <select id="product_id" class="form-control" name="product_id" required>
                                                    <option value="">Select Warehouse</option>
                                                </select>
                                            </div>
                                         </div>
                                         <button type="button" class="btn btn-success">+</button>
                                      </div>
                                  </div>
                                <button class="btn btn-primary waves-effect" type="submit">SAVE QUOTATION</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $("#item_add").select2();
            $("#tax_add").select2();
            $("supplier_add").select2();
              // if select warehouse then show product
              $("#warehouse_id").change(function(){
              var id=$("#warehouse_id").val();
                $.ajax({
                url: "{{url('/warehouse_product/')}}" + '/' + id,
                type: "GET",
                success: function(response) {
                    var items = ""; 
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