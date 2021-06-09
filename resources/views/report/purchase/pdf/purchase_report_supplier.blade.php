<!doctype html>
<html lang="en">
  <head>
<style>
    *{
        padding: 0;
        margin: 0;
    }
    .header{
        text-align: center;
        margin-top: 20px;
    }
    table{
        margin-top: 5px;
        margin-bottom: 5px;
        width:100%;
        font-size:12px;
        padding: 0px;
    }
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
    th, td {
    padding: 1px;
    text-align: left;
    }
    p{
      padding: 0px;
    }
    h1{
      font-weight: bold;
    }
</style>
  </head>
  <body>
      <div class="header">
        <h1>{{$company->company_name}}</h1>
        <span>{{$company->company_email}}</span><br>
        <span>{{$company->company_phone}}</span><br>
        <span>{{$company->company_address}}</span><br>
        <span style="font-weight: bold;">Purchase Report of Supplier {{$data[0]->suppliers->supplier_name}}</span><br>
        <span style="font-weight: bold;">From {{date('d-m-Y',strtotime($start))}} To {{date('d-m-Y',strtotime($end))}}</span><br>
</div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Invoice</th>
            <th>Date</th>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
    </tfoot>
</table>
  </body>
</html>
