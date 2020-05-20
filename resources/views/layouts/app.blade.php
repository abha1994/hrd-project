<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HRD - Ministry of New and Renewable Energy') }}</title>
	
    <!--link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"-->

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('public/assets/front_css/bootstrap.min.css') }}">
	<link href="{{ asset('public/assets/front_css/font.css') }}" rel="stylesheet">

	<script src="{{ asset('public/assets/front_js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('public/assets/front_js/validation.js')}}"></script>
	<script src="{{ asset('public/assets/front_js/bootstrap.min.js') }}"></script>
  
<script src="{{ asset('public/jquery-validation/dist/jquery.validate.js') }}"></script>
        <!-- Fonts -->
        

        <!-- Styles -->
 <style>
  html, body {
		background-color: #fff;
		color: #636b6f;
		font-family: 'Nunito', sans-serif;
		font-weight: 200;
		height: 100vh;
		margin: 0;
	}

	.full-height {
		height: 100vh;
	}

	.flex-center {
		align-items: center;
		display: flex;
		justify-content: center;
	}

	.position-ref {
		position: relative;
	}

	.top-right {
		position: absolute;
		right: 10px;
		top: 18px;
	}

	.content {
		text-align: center;
	}

	.title {
		font-size: 84px;
	}

	.links > a {
		color: #636b6f;
		padding: 0 25px;
		font-size: 13px;
		font-weight: 600;
		letter-spacing: .1rem;
		text-decoration: none;
		text-transform: uppercase;
	}

	.m-b-md {
		margin-bottom: 30px;
	}
			
	.col_white_amrc { color:#FFF;}
	.navbar {  min-height: 88px;}
	
footer { width:100%; background-color:#263238; min-height:px; padding:15px 0px 7px 0px ;}
.pt2 { padding-top:40px ; margin-bottom:20px ;}
footer p { font-size:13px; color:#CCC; padding-bottom:0px; margin-bottom:8px;}
.mb10 { padding-bottom:15px ;}

  .fixed-footer{
        width: 100%;
        position: fixed;        
        background: #333;
        padding:15px 0px 7px 0px;
        color: #fff;
		 bottom: 0;
    }
		
	/*CAROUSEL*/
	.main-text {
		position: absolute;
		top: 100px;
		width: 96.66666666666666%;
		color: #FFF;
	}

	.carousel-btns {
		margin-top: 2em; 
	}

	.carousel-btns .btn {
		width: 150px;
	}

	.carousel-inner .imgOverlay {
		position: absolute;
		top: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(6, 28, 38, 0.5);
	}

	.carousel-inner img {
	   width: 100%;
	}

	/*CONTROL*/
	.carousel-control {
		width: auto;
	}

	.carousel-control .icon-prev,
	.carousel-control .icon-next,
	.carousel-control .fa-chevron-left,
	.carousel-control .fa-chevron-right {
	  position: absolute;
	  top: 47%;
	  right: 0;
	  z-index: 5;
	  display: inline-block;
	  background-color: #000;
	  width: 38px;
	  height: 38px;
	  line-height: 40px;
	  font-size: 14px;
	}

	.carousel-control .icon-prev,
	.carousel-control .fa-chevron-left {
	  left: 0;
	}

	.carousel-indicators li {
	  width: 12px;
	  height: 12px;
	  margin: 0 1px;
	  border: 2px solid #fff;
	  opacity: .8;
	}

	.carousel-indicators .active {
		background-color: #28ace2;
		border-color: #28ace2;
	}

	.carousel-control .icon-prev, .carousel-control .fa-chevron-left,
	.carousel-control .icon-right, .carousel-control .fa-chevron-right {
		border-radius: 50px;
	}

	.carousel-control .icon-prev, .carousel-control .fa-chevron-left {
		left: 30px;
	}

	.carousel-control .icon-right, .carousel-control .fa-chevron-right {
		right: 30px;
	}

	.navbar{
		 top: 0px;
		background: #184d6b  !important;
		position: fixed;
		width: 100%;z-index:999;
		
	}
	.navbar-brand img{
		width: 37%;
		height: auto;
		margin-top: -25px;
    }
	.navbar-light .navbar-nav .nav-link {
      color: #f8f9fa;
    }
	.navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
       color: #f8f9fa;
    }
	.buttoncss{
    background-color: rgb(255, 255, 255);
    border-radius: 22px;
    border-width: 0px;
    font-style: normal;
    font-weight: bold;
    font-size: 16px;
  /*  padding: 12px;*/
    text-align: center;
    color: rgb(17, 17, 17);
    min-width: 100px;
    white-space: nowrap;
	}
	.active1{
    background: #ffc107;
    border-radius: 22px;
    border-width: 0px;
    font-style: normal;
    font-weight: bold;
    font-size: 16px;
  /*  padding: 12px;*/
    text-align: center;
    color: rgb(17, 17, 17);
    min-width: 100px;
    white-space: nowrap;
	}
        
		.buttoncss > a.nav-link {
			color:black  !important;
		}</style>
</head>
<body> 
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img src="{{ URL::asset('public/assets/img/inlogo.png')}}" >
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto navbar-right">
                        <!-- Authentication Links -->
                        @guest
						   <?php  $current_url =  Request::segment(1); 
				$logClass = $regClass = $homeClass ="";
				if($current_url == "login" ){
					$logClass ="active1";
				}else{
					$logClass = "buttoncss";
				}
				if($current_url == "register" ){
					$regClass ="active1";
				}
				else{
					$regClass = "buttoncss";
				}
				if($current_url == "" ){
					$homeClass ="active1";
				}
				else{
					$homeClass = "buttoncss";
				}?>
                <li class="nav-item {{$homeClass}}" style="">
					<a class="nav-link" href="{{ url('/') }}"><b>Home1</b></a>
				</li>&nbsp;&nbsp;
				<li class="nav-item {{$logClass}}">
					<a  class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
				</li>&nbsp;&nbsp;
				@if (Route::has('register'))
					<li class="nav-item  {{$regClass}}">
						<a  class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
				@endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
	
<footer class="footer fixed-footer">
  <div class="container">
     <p class="text-center"><img src="{{ URL::asset('public/assets/img/iconic_logo_v2.png')}}" style="height: 44px;
    width: 179px;">&nbsp;Designed & Developed by National Informatics Centre.</p>
  </div>
</footer>

</body>
</html>
