<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
<?php    $menu_id = Session::get('menu_id');
    if(Auth::user()->role != 0){
    // dd($menu_id);?>
	<div class="col-xs-6 col-sm-6 col-md-6 text-center" style="margin-left: 20%;">
     <select name="scheme_menu" class="scheme_menu"  class="form-control">
	      <option value="0">Select Scheme</option>
	      <option value="1"  <?php if($menu_id == 1){echo "Selected";}else{ echo "Selected";}?>>National Renewable Energy Internship</option>
		  <hr class="solid">
		  <option value="2" <?php if($menu_id == 2){echo "Selected";}else{ }?>>National Renewable Energy Science</option>
		  <hr class="solid">
		  <option value="3" <?php if($menu_id == 3){echo "Selected";}else{ }?>>National Renewable Energy Fellowships
		  </option>
		  <hr class="solid">
		  <option value="4" <?php if($menu_id == 4){echo "Selected";}else{ }?>>National Renewable Energy Short-term Training Program
		  </option>
	  </select>
	</div>
<?php  }else{    ?>
	
   <div class="col-xs-6 col-sm-6 col-md-6 text-center" style="margin-left: 20%;">
     <select name="scheme_menu" class="scheme_menu"  class="form-control">
	      <option value="0">Select Scheme</option>
	     <option value="5" <?php if($menu_id == 5){echo "Selected";}else{ }?>>National Renewable Energy Fellowships Form
		  </option>
		  <hr class="solid">
		  <option value="6" <?php if($menu_id == 6){echo "Selected";}else{ }?>>National Renewable Energy Short-term Training Program
		  </option>
	  </select>
	</div>
<?php } ?>
    <!-- Right navbar links -->
	<?php //$institute_notification = institute_notification(); 
	      //$role = Auth::user()->role;?> 

    <ul class="navbar-nav ml-auto">
<?php  //if($role == null){ ?>
    <!--li class="nav-item dropdown">	  
	 <a href="#" class="notification" class="nav-link" data-toggle="dropdown" >
	  <span ><i style="font-size:24px;"class="fa fa-bell" aria-hidden="true"></i></span>
	  <span class="badge" >3</span>
	</a>
	 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
		  <a class="nav-link" href="{{ url('changepassword') }}">
             <i class="nav-icon fa fa-key" aria-hidden="true"></i> {{ __('Change Password') }}
          </a>
          <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
             <i class="nav-icon fa fa-power-off red" aria-hidden="true"></i> {{ __('Logout') }}
          </a>
		</div>
      </li-->
<?php // } ?>
		  <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         <div class="image">
          <img src="{{asset('public/assets/img/default.png')}}" class="img-circle" height="31px" alt="User Image">
          <span >{{Auth::user()->name}} </span>
        </div>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
		  <a class="nav-link" href="{{ url('changepassword') }}">
             <i class="nav-icon fa fa-key" aria-hidden="true"></i> {{ __('Change Password') }}
          </a>
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


.notification {

  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification:hover {

}

.notification .badge {
    position: absolute;
    top: 0px;
    right: 8px;
    padding: 5px 10px;
    border-radius: 17%;
    background: red;
    color: white;
}

hr.solid {
  border-top: 3px solid #bbb;
}
.scheme_menu{
    text-align: center;
    height: 47px;
    border-color: #343a40;
    border-radius: 10px;
    font-size: 20px;
    padding: 6px 4px 2px 16px;
    width: 100%;
	}
.scheme_menu_user {
	text-align: center;
    height: 47px;
    border-color: #343a40;
    border-radius: 10px;
    font-size: 20px;
    padding: 6px 4px 2px 16px;
    width: 100%;
}
.wrapper > .main-header{
	background-color: #17a2b8;
}
.navbar-light .navbar-nav .nav-link{
	color:#fff;
}
.navbar-light .navbar-nav .nav-link:hover{
	color:#fff;
	background-color:#17a2b8;
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