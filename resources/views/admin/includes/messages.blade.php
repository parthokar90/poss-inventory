
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if(Session()->has('success'))
<script>
   toastr.success("{!!Session::get('success')!!}");
</script>
@endif

@if(Session()->has('error'))
 <script>
   toastr.error("{!!Session::get('error')!!}");
 </script>
@endif
