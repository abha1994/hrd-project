<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
footer { width:100%; background-color:#263238; min-height:px; padding:25px 0px 25px 0px ;}
.pt2 { padding-top:40px ; margin-bottom:20px ;}
footer p { font-size:13px; color:#CCC; padding-bottom:0px; margin-bottom:8px;}
.mb10 { padding-bottom:15px ;}

.fixed-footer{
        width: 100%;
        position: fixed;        
        background: #333;
        padding: padding:20px 0px 20px 0px ;;
        color: #fff;
    }.fixed-footer{
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
	.navbar-default .navbar-nav>li>a {
        color: #f5f5f5;
      }
	  .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
		color: #f5f5f5;
		background-color: transparent;
	}
        </style>
    </head>
    <body>
	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/')}}"><img src="{{ URL::asset('public/assets/img/inlogo.png')}}" style="width: 37%;height: 70px;     margin-top: -7px;"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div style="margin-top: 24px;" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="{{ url('/home') }}">Home</a>
                </li>
                <li class="page-scroll">
                    <a href="{{ route('login') }}">Login</a>
                </li>
                <li class="page-scroll">
                    <a href="{{ route('register') }}">Register</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
        <div class="flex-center position-ref full-height">
           <!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">
  <!-- Indicators -->
  <!--ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol-->
  <div class="carousel-inner">
    <div class="item active">
      <img src="{{ URL::asset('public/assets/img/hrd_7.jpg')}}" class="img-responsive">
      <!--div class="container">
        <div class="carousel-caption">
          <h1>Bootstrap 3 Carousel Layout</h1>
          <pthis is="" an="" example="" layout="" with="" carousel="" that="" uses="" the="" bootstrap="" 3="" styles.<="" small=""><p></p>
          <p><a class="btn btn-lg btn-primary" href="http://getbootstrap.com">Learn More</a>
        </p></pthis></div>
      </div-->
    </div>
    <div class="item">
      <img src="{{ URL::asset('public/assets/img/hrd_8.jpg')}}" class="img-responsive">
      <!--div class="container">
        <div class="carousel-caption">
          <h1>Changes to the Grid</h1>
          <p>Bootstrap 3 still features a 12-column grid, but many of the CSS class names have completely changed.</p>
          <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
        </div>
      </div-->
    </div>
    <div class="item">
      <img src="{{ URL::asset('public/assets/img/hrd_7.jpg')}}" class="img-responsive">
      <!--div class="container">
        <div class="carousel-caption">
          <h1>Percentage-based sizing</h1>
          <p>With "mobile-first" there is now only one percentage-based grid.</p>
          <p><a class="btn btn-large btn-primary" href="#">Browse gallery</a></p>
        </div>
      </div-->
    </div>
  </div>
  <!-- Controls http://lorempixel.com/1500/600/abstract/1-->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="icon-prev"></span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="icon-next"></span>
  </a>  
</div>
<!-- /.carousel -->
        </div>
		<!-- Footer -->
<footer class="footer fixed-footer">
  <div class="container">
  

<p class="text-center"><img src="{{ URL::asset('public/assets/img/iconic_logo_v2.png')}}" style="height: 44px;
    width: 179px;">&nbsp;Designed & Developed by National Informatics Centre.</p>

</div>
</footer>


	
<!-- Footer -->
    </body>
</html>
