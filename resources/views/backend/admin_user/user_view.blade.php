@extends('layouts.master')
@section('container')
   <div class="content-wrapper" >
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Officer</li>
      </ol>
	  <div class="card card-login mx-auto mt-5">     
   <div class="card-header text-center"><h4 class="mt-2">View Officer</h4></div>
      <div class="card-body">     
 
        			     
       				 <br />           
       				 <div class="table-responsive">
           				<table class="table">
           					<tr> 
           						<td>Officer Name : </td><td>{{$data->name}}</td>
           					</tr>
           					<tr> 
           						<td>Designation : </td><td>{{$data->designation}}</td>
           					</tr>
           					<tr> 
           						<td>Mobile Numer : </td><td>{{$data->mobile}}</td>
           					</tr>
           					<tr> 
           						<td>Joining Date : </td><td>{{$data->joining_date}}</td>
           					</tr>
           					<tr> 
           						<td>Transfer Date : </td><td>{{$data->transfer_date}}</td>
           					</tr>
           					<tr> 
           						<td>Date of Birth : </td><td>{{$data->dob}}</td>
           					</tr>
                        </table>
						<center>
							<div class="form-group">
							   <a class="btn btn-secondary" href="{{ URL('user')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
							</div> 
						</center>	
           			</div>
           			</div>
           		</div>
           	</div>
           </div>
        </div> 
    </div> </div> </div>
<!--     <script src="{{ asset('js/app.js') }}"></script>  -->

<script type="text/javascript">
   $(document).ready(function () {
 
        $(".sidebar-menu li").removeClass("menu-open");
        $(".sidebar-menu li").removeClass("active");        
        $("#liofficer").addClass('menu-open');        
        $("#ulofficer").css('display', 'block');
        $(".nav-link").removeClass('active');
       // $("#liJobCategory").addClass("false");
       // $("#liCountry").addClass("false");
        $("#liofficers").addClass("active");
      });
</script>
@endsection
