@extends('layouts.app')

@section('content')
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
