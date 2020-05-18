@extends('layouts.master')

@section('container')
<br />

<script>
 var getReportAdminAjaxnew= "{{ url('getReportAdminAjaxnew') }}";
</script>


  <script src="{{ asset('public/js/reportAdmin_validation.js') }}"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Progress Report(Quarterly/Yearly)</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	   <div class="card-header text-center"><h4 class="mt-2">Progress Report(Quarterly/Yearly)</h4></div>
	    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
	   @include('includes/flashmessage')
			
	
	           <div class="col-md-2" style="float:left">
		
		          <select class="form-control commonChange" name="inst" id="inst">
					
					<option value="">Select Institute</option>
					@if(isset($instituteDetails)) 
					@foreach($instituteDetails as $inst_details)
					<option value="{{$inst_details->institute_id}}">{{$inst_details->institute_name}}</option>
					@endforeach
					@endif
					</select>
					</div>
		
		<div class="col-md-2" style="float:left">
					
					<select class="form-control"name="reportTypenew" id="reportTypenew">
					<option value="">Select Type</option>
					<option value="quarterly">Quarterly</option>
					<option value="yearly">Yearly</option>
					</select>
					</div>
		
		<div class="col-md-2" style="float:left; display:none;" id="newmnth">
					
					<select class="form-control"name="monthTypenew" id="monthTypenew">
					<option value="">Select Month</option>
					<option value="april-june">April-June</option>
					<option value="july-september">July-September</option>
					<option value="october-december">October-December</option>
					<option value="january-march">January-March</option>
					</select>
					</div>
					
					
					
					<div class="col-md-2" style="float:left">

					<select class="form-control" name="yearTypenew" id="yearTypenew">
					<option value="">Select Year</option>
					<option value="2020-2021">2020-2021</option>
					<option value="2021-2022">2021-2022</option>
					<option value="2022-2023">2022-2023</option>
					<option value="2023-2024">2023-2024</option>
					<option value="2024-2025">2024-2025</option>
					</select>
					</div>
					
					<div class="form-group" >
					<input type="submit" id="filterReport" class="btn btn-primary "  value= "Search" />
					</div>

		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="report_table">
			    
				<thead>
				       <tr>
							<th>Name of the Fellow </th>
							<th>Stream</th>
							<th>Report Type</th>
							<th>Report Month</th>
							<th>Report Year</th>
							<th>Click to check</th>
					  </tr>
					  </thead>
					  
					  
					  <tbody></tbody>
					 
				</table> 
				</div>
				
				
				<!--   -->
        </div>
		
    </div>
</div>


</div>

<style>
    .BDC_CaptchaIconsDiv{
        margin-left: 241px;
        margin-top: -54px;
	}
	strong{
        color: red;
        font-size: 11px;
    }
	.error{
	    color: red;
	    font-size: 12px;
	}
	.has-error .form-control {
    border-color: #a94442;
}
</style>


<!-- /.container-fluid-->

@endsection
	
	