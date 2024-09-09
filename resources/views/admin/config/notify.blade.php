<!--  {{-- @if (session()->has('success'))
 <div class="alert alert-success alert-bordered alert-dismissable fade show" id="alert">
 	<button type="button" class="close"  data-dismiss="alert">X</button>
  {{session()->get('success')}}
 </div>
 @endif --}}

 {{-- Toastr --}}
 -->
<link rel="stylesheet" href="{{ asset('Backend/plugins/toastr/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('Backend/plugins/toastr/toastr.min.css') }}">

<script src="{{ asset('Backend/plugins/toastr/toastr.min.js') }}"></script>
@if (session()->has('success'))
    <script>
        toastr.success("{!! session('success') !!}");
    </script>
@endif

@if (session()->has('update'))
    <script>
        toastr.update("{!! session('update') !!}");
    </script>
@endif

@if (session()->has('errormessage'))
    <script>
        toastr.errormessage("{!! session('errormessage') !!}");
    </script>
@endif

<!--
  {{-- @if (session()->has('update'))
 <div class="alert alert-success alert-bordered alert-dismissable fade show" id="alert">
 	<button type="button" class="close"  data-dismiss="alert">X</button>
  {{session()->get('update')}}
 </div>
 @endif --}}

{{-- @if (session()->has('errormessage'))
 <div class="alert alert-danger alert-bordered alert-dismissable fade show" id="alert">
 	<button type="button" class="close"  data-dismiss="alert">X</button>
  {{session()->get('errormessage')}}
 </div>
 @endif --}}
 -->
