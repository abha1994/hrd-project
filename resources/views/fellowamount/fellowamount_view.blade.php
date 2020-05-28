@extends('layouts.master')

@section('container')
 	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Fellow Amount</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">View Fellow Amount</h4></div>
      <div class="card-body">
                            <div class="form-group">
								<div class="row">
								    <div class="col-md-4">
									    <label><b>Financial Year :</b></label>
									</div>
									<div class="col-md-8">
										<?php if(!empty($data['fellow_amount_data'])) { echo $data['fellow_amount_data']->financial_year;}?> 
								    </div>
								</div> 
								<div class="row">
								    <div class="col-md-4">
									    <label><b>Course Name :</b></label>
									</div>
									<div class="col-md-8">
										<?php if(!empty($data['fellow_amount_data'])) { echo $data['fellow_amount_data']->course_name;}?> 
								    </div>
								</div> 
								<div class="row">
								    <div class="col-md-4">
									    <label><b>Amount :</b></label>
									</div>
									<div class="col-md-8">
										<?php if(!empty($data['fellow_amount_data'])) { echo $data['fellow_amount_data']->amount;}?> 
								    </div>
								</div> 
								<div class="row">
								    <div class="col-md-4">
									    <label><b>Validity Period :</b></label>
									</div>
									<div class="col-md-8">
										<?php if(!empty($data['fellow_amount_data'])) { echo $data['fellow_amount_data']->validity_period;}?> 
								    </div>
								</div> 
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a class="btn btn-secondary" href="{{ URL('fellowamount-list')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
    </div>
				    
                </div>
            </div>
         </div>
     </div>   

@endsection
	
	