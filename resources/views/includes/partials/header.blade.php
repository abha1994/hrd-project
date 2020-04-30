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
     <select name="scheme_menu" class="scheme_menu">
	      <option value="">Select Scheme</option>
	      <option value="1" <?php if($menu_id == 1){echo "Selected";}else{ echo "Selected";}?>>Internship</option>
		  <option value="2" <?php if($menu_id == 2){echo "Selected";}else{ }?>>Fellowship Solar</option>
		  <option value="3" <?php if($menu_id == 3){echo "Selected";}else{ }?>>Fellowship</option>
	  </select>
	<?php } ?>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         <!--  <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
         <div class="image">
          <img src="{{asset('public/assets/img/default.png')}}" class="img-circle" height="40px" alt="User Image">
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
