<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'HRD') }}</title>

  
 <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
 <script src="{{ asset('public/css/datepicker3.css') }}"></script>
 <link rel="stylesheet" type="text/css" href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}">
    <!-- Styles -->
<link href="{{ asset('public/fontawesome/css/fontawesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/fontawesome/css/solid.css') }}" rel="stylesheet">
<link href="{{ asset('public/fontawesome/css/brands.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('includes/partials/header')

  @auth

  @if (Auth::user()->scheme_code === 1)
    @include('includes/partials/leftstudent')
  @elseif (Auth::user()->scheme_code ==2)
    @include('includes/partials/leftfellow')
  @elseif (Auth::user()->scheme_code ==3)
    @include('includes/partials/leftinst')
  @else
    @include('includes/partials/left')
  @endif
  
  @endauth
    
  @yield('container') 
   
  @include('includes/partials/footer')
  
</div>
<!-- ./wrapper -->

<!-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
 -->


</body>
</html>
