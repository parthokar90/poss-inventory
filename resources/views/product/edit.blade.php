 @extends('admin.layouts.master')
   @section('title') Dashboard | Edit Product @endsection
   @section('content')
   <style>
   .error{
       color:red;
    }
   </style>
       <div class="container-fluid">
            <div class="block-header">
                <h2>PRODUCT</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT PRODUCT INFORMATION</h2>
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
                           <form action="{{route('product.update',$edit->id)}}" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             {{ method_field('PATCH') }} 
                              <div class="col-md-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                     <label class="form-label">Product Type</label>
                                        <select class="form-control" name="product_type">
                                            @if($edit->product_type=='Standard') 
                                                <option value="Standard" selected>Standard</option>
                                                <option value="Combo">Combo</option>
                                                <option value="Digital">Digital</option>
                                                <option value="Service">Service</option>
                                              @elseif($edit->product_type=='Combo')
                                                <option value="Standard">Standard</option>
                                                <option value="Combo" selected>Combo</option>
                                                <option value="Digital">Digital</option>
                                                <option value="Service">Service</option>
                                              @elseif($edit->product_type=='Digital')
                                                <option value="Standard">Standard</option>
                                                <option value="Combo">Combo</option>
                                                <option value="Digital" selected>Digital</option>
                                                <option value="Service">Service</option>
                                              @else
                                                <option value="Standard">Standard</option>
                                                <option value="Combo">Combo</option>
                                                <option value="Digital">Digital</option>
                                                <option value="Service"selected>Service</option>
                                            @endif
                                           
                                        </select>
                                     </div>
                                </div>
                              </div>
                               <div class="col-md-3">
                                  <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="product_name" class="form-control" value="{{$edit->product_name}}">
                                        <label class="form-label">Name *</label>
                                        @if($errors->has('product_name'))
                                            <div class="error">
                                                {{$errors->first('product_name')}}
                                            </div>
                                        @endif
                                    </div>
                                  </div>   
                               </div>
                               <div class="col-md-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input name="product_cost" class="form-control" value="{{$edit->product_cost}}">
                                                <label class="form-label">Cost *</label>
                                                 @if($errors->has('product_cost'))
                                                    <div class="error">
                                                        {{$errors->first('product_cost')}}
                                                    </div>
                                                 @endif
                                            </div>
                                        </div>   
                                </div>
                                 <div class="col-md-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input name="product_price" class="form-control" value="{{$edit->product_price}}">
                                                <label class="form-label">Price *</label>
                                                  @if($errors->has('product_price'))
                                                    <div class="error">
                                                        {{$errors->first('product_price')}}
                                                    </div>
                                                 @endif
                                            </div>
                                        </div>   
                                 </div>
                                   <div class="col-md-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input name="product_alert_qty" class="form-control" value="{{$edit->product_alert_qty}}">
                                                <label class="form-label">Alert Quantity *</label>
                                                 @if($errors->has('product_alert_qty'))
                                                    <div class="error">
                                                        {{$errors->first('product_alert_qty')}}
                                                    </div>
                                                 @endif
                                            </div>
                                        </div>   
                                 </div>
                                   <div class="col-md-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input name="product_weight" class="form-control" value="{{$edit->product_weight}}">
                                                <label class="form-label">Weight</label>
                                            </div>
                                        </div>   
                                   </div>
                                 <div class="col-md-3">
                                       <div class="form-group form-float">
                                    <div class="form-line">
                                        <img width="100px" height="50px" src="{{asset('product_image/'.$edit->product_image)}}">
                                        <input type="file" class="form-control" name="product_image">
                                    </div>
                                    <input type="hidden" name="d_logo" value="{{$edit->product_image}}">
                                    </div>   
                                  </div>

                                <div class="col-md-3"> 
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                          <label class="form-label">Select Brand *</label>
                                            <select class="form-control" name="product_brand">
                                               <option value=""></option>
                                               @foreach($brands as $brand)
                                                   @if (old('product_brand') == $brand->id)
                                                        <option value="{{$brand->id}}" {{ ( $brand->id == $edit->product_brand) ? 'selected' : '' }}> {{ $brand->name}} </option>
                                                    @else
                                                        <option value="{{$brand->id}}" {{ ( $brand->id == $edit->product_brand) ? 'selected' : '' }}> {{ $brand->name}} </option>
                                                    @endif
                                               @endforeach  
                                            </select>
                                             @if($errors->has('product_brand'))
                                                    <div class="error">
                                                        {{$errors->first('product_brand')}}
                                                    </div>
                                              @endif
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3"> 
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                          <label class="form-label">Select Category *</label>
                                            <select class="form-control" name="product_cat_id" id="cat_id">
                                              <option value=""></option>
                                              @foreach($categorys as $category)
                                                   @if (old('product_cat_id') == $category->id)
                                                        <option value="{{$category->id}}" {{ ( $category->id == $edit->product_cat_id) ? 'selected' : '' }}> {{ $brand->category_name}} </option>
                                                    @else
                                                        <option value="{{$category->id}}" {{ ( $category->id == $edit->product_cat_id) ? 'selected' : '' }}> {{ $category->category_name}} </option>
                                                    @endif
                                               @endforeach  
                                            </select>
                                             @if($errors->has('product_cat_id'))
                                                    <div class="error">
                                                        {{$errors->first('product_cat_id')}}
                                                    </div>
                                              @endif
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3"> 
                                    <div class="form-group form-float">
                                        <label class="form-label">Sub Category</label>
                                        <div class="form-line">
                                            <select id="sub" class="form-control" name="product_subcat_id">
                                              @if(isset($sub_category))
                                                 <option value="{{$sub_category->id}}" selected>{{$sub_category->category_name}}</option>
                                                 @else 
                                              @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"> 
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                          <label class="form-label">Select Unit</label>
                                            <select class="form-control" name="product_unit_id">
                                               <option value=""></option>
                                                @foreach($units as $unit)
                                                   @if (old('product_unit_id') == $unit->id)
                                                         <option value="{{$unit->id}}" {{ ( $unit->id == $edit->product_unit_id) ? 'selected' : '' }}> {{ $unit->unit_name}} </option>
                                                    @else
                                                        <option value="{{$unit->id}}" {{ ( $unit->id == $edit->product_unit_id) ? 'selected' : '' }}> {{ $unit->unit_name}} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                              <div class="col-md-3"> 
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                          <label class="form-label">Select Tax Rate</label>
                                            <select class="form-control" name="tax_rate_id">
                                               <option value=""></option>
                                               @foreach($taxrates as $taxrate)
                                                    @if (old('tax_rate_id') == $taxrate->id)
                                                        <option value="{{$taxrate->id}}" {{ ( $taxrate->id == $edit->tax_rate_id) ? 'selected' : '' }}> {{ $taxrate->name}} </option>
                                                    @else
                                                       <option value="{{$taxrate->id}}" {{ ( $taxrate->id == $edit->tax_rate_id) ? 'selected' : '' }}> {{ $taxrate->name}} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               <div class="col-md-9"> 
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea name="product_details" cols="30" rows="5" maxlength="100" class="form-control no-resize">{{$edit->product_details}}</textarea>
                                            <label class="form-label">Product Details</label>
                                        </div>
                                    </div>
                                </div>

                                @if($item_varient->count()==0)
                                 <div class="col-md-12">
                                     <label class="form-label">Warehouse Quantity</label>
                                 </div>

                                 <table style="width:100%" class="table table-hover dashboard-task-infos">
                                        <tr>
                                            <th>Warehouse</th>
                                            <th>Quantity</th>
                                            <th>Rack</th>
                                        </tr>
                                        @foreach($item_warehouse as $key=>$item)
                                        <tr>
                                             <td>{{$item->Warehouses->name}}</td>
                                             <td><input type="number" name="qty[]" min="0" value="{{$item->qty}}"></td>
                                             <td><input type="text" name="racks[]" value="{{$item->racks}}">   
                                             <input type="hidden" name="warehouse_id[]" value="{{$item->warehouse_id}}"></td>
                                        </tr>
                                        @endforeach 
                                 </table>
                                 @endif 
                                        
                                        @if($item_varient->count()>0)
                                        <div class="col-md-12">
                                            <label class="form-label">Product Varient</label>
                                        </div>
                                        <table style="width:100%" class="table table-hover dashboard-task-infos">
                                                <tr>
                                                    <th>Varient</th>
                                                    <th>Warehouse</th>
                                                    <th>Quantity</th>
                                                    <th>Rack</th>
                                                    <th>Price addition</th>
                                                    <th>Status</th>
                                                </tr>
                                                @foreach($item_varient as $key=>$item)
                                                <tr>
                                                    <td>{{$item->Varient->varient_name}}</td>
                                                    <td>{{$item->Warehouses->name}}</td>
                                                    <td><input type="number" name="qty[]" min="0" value="{{$item->qty}}"></td>
                                                    <td><input type="text" name="racks[]" value="{{$item->variant_rack}}"></td>
                                                    <td>
                                                      <input type="number" min="0" name="price_addition[]" value="{{$item->price_addition}}">
                                                      <input type="hidden" name="varient_id[]" value="{{$item->varient_id}}">
                                                      <input type="hidden" name="warehouse_ids[]" value="{{$item->warehouse_id}}">
                                                    </td>
                                                    <td>
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <select class="form-control" name="status[]">
                                                                @if($item->status==1)
                                                                    <option value="1" selected>Active</option>
                                                                    <option value="0">Inactive</option>
                                                                    @else 
                                                                    <option value="1">Active</option>
                                                                    <option value="0" selected>Inactive</option>
                                                                @endif  
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach 
                                        </table>
                                        @endif 
                                     <!-- <div class="col-md-12">
                                         <input type="checkbox" id="product_varient_div_show">
                                         <label for="product_varient_div_show">Add more variants?</label><br>
                                    </div> -->
                                    <!-- <div class="col-md-3" id="product_varient" style="display: none;">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label">Select Variant</label>
                                                    <select class="form-control" name="product_variants" id="product_variants">
                                                    <option value=""></option>
                                                      @foreach($variants as $v)
                                                        <option myselect="{{$v->varient_name}}" value="{{$v->id}}">{{$v->varient_name}}</option>
                                                      @endforeach   
                                                    </select>
                                            </div>
                                        </div>
                                    </div> -->
                                     <div class="col-md-12" id="varient_table" style="display:none;"></div>
                                </div>
                                <button id="save_btn" class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
        //   $("#product_varient_div_show").click(function(){  
        //             if ($("input[type=checkbox]").is( 
        //               ":checked")) { 
        //                $("#product_varient").show();
        //                $("#product_variants").show();
        //             } else { 
        //                $("#product_varient").hide();
        //                $("#product_variants").hide();
        //                $("#varient_table").hide();
        //             } 
        //    });

        //    $("#product_variants").change(function(){
        //        var att_value=$("input[name='varient_id[]']").map(function(){return $(this).val();}).get();
        //        var attribute=$('option:selected', this).attr('myselect');
        //        var attribute_id=$("#product_variants").val();
        //        var status=true;
        //         for(var i = 0; i < att_value.length; i++) {
        //                 if(att_value[i]==attribute_id) {
        //                     status=false;
        //                 }
        //             }
        //             if(status==true){
        //               var data="<div class='table-responsive'><table id='tbUser' class='table table-hover dashboard-task-infos'><thead><tr><th>Name</th><th>Warehouse</th><th>Price Addition</th><th>Remove</th></tr></thead><tbody><tr><td><input id='att_value' type='hidden' name='varient_id[]' value='"+attribute_id+"'> "+attribute+"</td><td><div class='form-group form-float'><div class='form-line'><select id='warehouse_id' class='form-control' name='warehouse_id[]'>@foreach($warehouse as $items) <option value='{{$items->id}}'>{{$items->name}}</option>@endforeach </select></div></div></td><td><div class='form-group form-float'><div class='form-line'><input type='number' name='price_addition[]' class='form-control' value='0' placeholder='Enter Price'></div></div> </td><td><button type='button' class='btn_delete'>X</button></td></tr></tbody></table></div>";
        //               $("#varient_table").show();
        //               $("#varient_table").append(data);
        //             }
        //    });

        // sub category ajax start
         $("#cat_id").change(function(){
              var id=$("#cat_id").val();
                $.ajax({
                url: "{{url('/sub-category/')}}" + '/' + id,
                type: "GET",
                success: function(response) {
                    console.log(response);
                    var items = ""; 
                    items += "<option value=''>Select Category</option>";
                    $.each(response, function(i, item) {
                        items += "<option value='" + item.id + "'>" + (item
                                .category_name) +
                            "</option>";
                    });
                    $("#sub").html(items);
                 },
                    error: function(response) {
                        console.log(response);
                    },
                });
           });
           // sub category ajax end
        </script> 
     @endsection      