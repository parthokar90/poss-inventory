<!doctype html>
<html lang="en">
  <head>
<style>
    .header{
        text-align: center;
        margin-top: 20px;
    }
    table{
        margin-top: 5px;
        margin-bottom: 5px;
        width:100%;
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
         <span>Expense Report</span><br>
         <span>{{$category->category_name}}</span><br>
         <span>From {{date('d-m-Y',strtotime($start))}} To {{date('d-m-Y',strtotime($end))}}</span><br>
</div>
<table>
   <tr>
      <th>SL</th>
      <th>Expense</th>
      <th>Created By</th>
      <th>Date</th>
    </tr>
     @php $total=0; @endphp
          @foreach($data as $key=>$item)
             <tr>
                  <td> {{++$key}} </td>
                  <td> {{number_format($item->expense_amount)}} Tk @php $total+=$item->expense_amount; @endphp</td>
                  <td> {{optional($item->users)->name}} </td>
                  <td> {{date('d-F-Y',strtotime($item->expense_date))}} </td>
             </tr>
          @endforeach 
     <tr>
        <td> Total </td>
        <td> {{number_format($total)}} Tk </td>
        <td></td>
        <td></td>
    </tr>
  </table>
  </body>
</html>
