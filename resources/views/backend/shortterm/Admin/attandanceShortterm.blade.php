@extends('layouts.master')

@section('container')
<br />

<script>
 var getattandanceTerm= "{{ url('getattandanceTerm') }}";
</script>


  <script src="{{ asset('public/js/shortTerm_adminAttendance_validation.js') }}"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Short Term Attandance</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	   <div class="card-header text-center"><h4 class="mt-2">Short Term Attandance</h4></div>
	    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
	   @include('includes/flashmessage')
			
	
	           <div class="col-md-2" style="float:left">
		
		          <select class="form-control" name="shortermname" id="shortermname">
					
					<option value="">Select Short Term Name</option>
					@if(isset($shortTerm)) 
					@foreach($shortTerm as $termName)
					<option value="{{$termName->user_id}}">{{$termName->institute_name}}</option>
					@endforeach
					@endif
					</select>
					</div>
		
		           <div class="col-md-2" style="float:left">
					
					<select class="form-control" name="programnew" id="programnew">
					<option value="">Select Program</option>
					</select>
					</div>
					
					<div class="form-group" >
					<input type="submit" id="filterSearch" class="btn btn-primary "  value= "Search" />
					</div>

		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="atten_table">
			    
				<thead>
				       <tr>
							<th>Name of the Fellow </th>
							<th>Training Program</th>
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
	
	