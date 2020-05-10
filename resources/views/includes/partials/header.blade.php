<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
<?php   
    if(Auth::user()->role != 0){
    $menu_id = Session::get('menu_id'); // dd($menu_id);?>
	<div class="col-xs-6 col-sm-6 col-md-6 text-center">
     <select name="scheme_menu" class="scheme_menu"  class="form-control">
	      <option value="">Select Scheme</option>
	      <option value="1"  <?php if($menu_id == 1){echo "Selected";}else{ echo "Selected";}?>>Internship</option>
		  <hr class="solid">
		  <option value="2" <?php if($menu_id == 2){echo "Selected";}else{ }?>>New And Renewable Energy Solar</option>
		  <hr class="solid">
		  <option value="3" <?php if($menu_id == 3){echo "Selected";}else{ }?>>New And Renewable Energy Fellowship
		  </option>
	  </select>
	  </div>
	<?php  } ?>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         <!--  <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
         <div class="image">
          <img src="{{asset('public/assets/img/default.png')}}" class="img-circle" height="31px" alt="User Image">
          <span >{{Auth::user()->name}} </span>
        </div>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
             <i class="nav-icon fa fa-power-off red" aria-hidden="true"></i> {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>

<style>
hr.solid {
  border-top: 3px solid #bbb;
}
.scheme_menu{
    height: 35px;
    border-color: #343a40;
    border-radius: 10px;
    font-size: 16px;
    padding: 6px 4px 2px 16px;
	}
.wrapper > .main-header{
	background-color: #17a2b8;
}
.navbar-light .navbar-nav .nav-link{
	color:#fff;
}
.navbar-light .navbar-nav .nav-link:hover{
	color:#fff;
}
 .card-body{
	border:1px solid #17a2b8;
}
.card-header{
	background-color:#17a2b8!important;
	color:white;
	border-radius:0px;
}
.btn-primary{
	background-color:#17a2b8!important;
}
.error{
      color: red;
      font-size: 12px;
}
.alert-success{
	    height: 44px;

}
</style>