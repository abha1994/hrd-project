@extends('layouts.app1')

@section('content')

 <div class="content-wrapper" style="margin-left: 13px;">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">LInk Officer List</li>
      </ol>
     <div class="card card-login mx-auto mt-5 " style="max-width: 28rem;">
	  <div class="card-body">
        <!--div class="card-header">
          <a href="{{ URL('add-user') }}"><i class="fa fa-plus"></i> Add User</a>
		</div-->
       
		
	
<?php //dd($data['link_tbl_data']->officer_id);?>
     <div class="card-header text-center"><h4 style="color: #2384c6;">View LInk Officer Details</h4></div>
      <div class="card-body">
     	   
                            <div class="form-group">
								<div class="row">
								    <div class="col-md-5">
									    <label><b>Oficer Name :</b></label>
									</div>
									<div class="col-md-7">
										 <?php foreach($data['officer_data'] as $val){
												if($val->officer_id == $data['link_tbl_data']->officer_id){
													echo $val->officer_name;
												}
										  }?>
								    </div>
								</div> 
							</div>
							
							 <div class="form-group">
								<div class="row">
								    <div class="col-md-5">
									    <label><b>Oficer Name :</b></label>
									</div>
									<div class="col-md-7">
										<?php foreach($data['link_officer_data'] as $val){
											if($val->officer_id == $data['link_tbl_data']->link_officer_id){
												echo $val->officer_name;
											}
									  }?>
								    </div>
								</div> 
							</div>
							
							 <div class="form-group">
								<div class="row">
								    <div class="col-md-4">
									    <label><b>Valid From :</b></label>
									</div>
									<div class="col-md-8">
										<?php echo date("d-m-Y",strtotime($data['link_tbl_data']->valid_from)); ?>
								    </div>
								</div> 
							</div>
							
							
							 <div class="form-group">
								<div class="row">
								    <div class="col-md-4">
									    <label><b>Valid To :</b></label>
									</div>
									<div class="col-md-8">
										<?php echo date("d-m-Y",strtotime($data['link_tbl_data']->valid_to)); ?>
								    </div>
								</div> 
							</div>
							
							 <div class="form-group">
								<div class="row">
								    <div class="col-md-4">
									    <label><b>Status :</b></label>
									</div>
									<div class="col-md-8">
										  <?php
												date_default_timezone_set('Asia/Kolkata');
												$date = date('Y-m-d');
												$current_date = strtotime($date);
												$valid_to_date = strtotime($data['link_tbl_data']->valid_to);
												// dd($current_date,$valid_to_date,$date,$v->valid_to);	

												if($valid_to_date >=  $current_date){
													echo "Working Now";
												}else{
													echo "Expired";
												}
										  ?>
								    </div>
								</div> 
							</div>
							
							 
						
							<hr>
							<center>
								<div class="form-group" >
								   <button class="btn btn-primary"style="background-color: #ffffff;" ><a href="{{ URL('link-officer')}}">Cancel</a></button>
								</div> 
							</center>
							
				    
                </div></div>
            </div>
         </div>
     </div>

@endsection
	
	