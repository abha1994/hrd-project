<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">

	   <title>{{ config('app.name', 'HRD - Ministry of New and Renewable Energy') }}</title>

		<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
		
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css">
		
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
	</body>
</html>
