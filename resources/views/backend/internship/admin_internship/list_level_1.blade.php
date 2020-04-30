@extends('layouts.master')
@section('container') 
 <div class="content-wrapper">
 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $data['breadcum'];?>
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	
        <div class="card-header">
          <div class="card-header text-center"><h4 style="color: #2384c6;"><?php echo $data['breadcum'];?></h4></div>
		</div>
        <div class="card-body">
		 @if ($success = Session::get('success'))
		 <div class="alert alert-success alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $success }}</strong>
		 </div>
	     @endif
		 
		  @if ($error = Session::get('error'))
		 <div class="alert alert-danger  alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $error }}</strong>
		 </div>
	     @endif
	 
<div class="table-responsive">
	<form action="{{ route('export') }}" class=""  autocomplete="off"  id="registration_form" method="POST" id="beautypress-booking-form">
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
			
    <input type="hidden" name="item" value="" id="item">
    <input type="hidden" name="interndatatype" value="2" >
	<div class="form-group">
		<div class="row">
			<div class="col-md-2">
				<select class="form-control" name="duration" id="intern_duration" >
				   <option value="">All Duration</option>
				   <option value="1">1 Month</option>
				   <option value="2">2 Month</option>
				   <option value="3">3 Month</option>
				   <option value="4">4 Month</option>
				   <option value="5">5 Month</option>
				   <option value="6">6 Month</option>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-control" name="pass_status" id="pass_status" >
					<option value="">All Pass Status</option>
					<option value="1">Pursuing</option>
					<option value="2">Passed</option>
				</select>
			</div>
			<div class="col-md-2">
			   <input class="date form-control"  type="text"  value="<?php if(!empty($loginuser_data->dob)){ ?>{{ $loginuser_data->dob }} <?php } ?>" name="datepicker_search_from" id="datepicker_search_from" Placeholder="From Date">
			</div>
			<div class="col-md-2">
			   <input class="date form-control"  type="text"  value="<?php if(!empty($loginuser_data->dob)){ ?>{{ $loginuser_data->dob }} <?php } ?>" name="dt21" id="dt21" Placeholder="To Date">
			</div>
									
			<button class="btn btn-info btn-sm" type="submit"  value="1" name="type" ><i class="glyphicon glyphicon-export icon-share"></i> Export Excel</button> &nbsp;
			
			<button class="btn btn-info btn-sm" type="submit"  value="2" name="type" ><i class="glyphicon glyphicon-export icon-share"></i> Export Pdf </button>
		</div> 
	 </div>
							
							
		  <table  width="100%"  class="table table-bordered data-table">
			<thead>
				   <tr>
						<!--th><input type="checkbox"  id="chk123" class="select_all" value=""></th-->
						<th  class="filterhead">S. No.</th>
						<th class="filterhead">Application No.</th>
						<th class="filterhead">Name</th>
						<th class="filterhead">Email</th>
						<!--th class="filterhead">Mobile No.</th>
						<th class="filterhead">Father Name</th-->
						<th class="filterhead">Duration</th>
						<th class="filterhead">Date</th>
						<th class="filterhead">Action</th>
				  </tr>
			</thead>
		</table> 
</form>

			
          </div>
        </div>
      </div>
    </div>

  </div>


 <script type="text/javascript"> 
var pageURL = $(location).attr("href");
 $(function () {
	 // alert();
    $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
	});

	var table = $('.data-table').DataTable({
		
	 'processing': true,
	 'serverSide': true,
	 'serverMethod': 'post',
	
	'ajax': {
	   'url':pageURL,
	   'type':"GET",
	   'data': function(data){
		  var intern_duration = $('#intern_duration').val();
		  data.intern_duration = intern_duration;
		  
		  var pass_status = $('#pass_status').val();
		  data.pass_status = pass_status;
		  
		  var datepicker_search_from = $('#datepicker_search_from').val();
		  data.datepicker_search_from = datepicker_search_from;
		  
		  var dt21 = $('#dt21').val();
		  data.dt21 = dt21;
		  
		  var considered = $('#considered').val();
		  data.considered = considered;
		 }
	},
		"pageLength": 10,//[ [10, 25, 50, -1], [10, 25, 50, "All"] ],
  	    columns: [
		// {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
		{data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
		{data: 'application_cd', name: 'application_cd'},
		{data: 'first_name', name: 'first_name'},
		{data: 'email', name: 'email'},
		// {data: 'mob_number', name: 'mob_number'},
		// {data: 'father', name: 'father'},
		{data: 'intern_duration', name: 'intern_duration'},
		{data: 'date_entry', name: 'date_entry'},
		{data: 'action', name: 'action', orderable: false, searchable: false},
	]
	
   
 });  

	$('#intern_duration').change(function(){
		table.draw();
	});
  
    $('#pass_status').change(function(){
      table.draw();
   });
   
   
    $('#dt21').change(function(){
      table.draw();
   });
   
   $('#considered').change(function(){
      table.draw();
   });
 }); 
 </script>
 	
@endsection