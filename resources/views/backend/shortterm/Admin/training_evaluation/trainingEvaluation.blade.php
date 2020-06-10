@extends('layouts.master')

@section('container')
<br />

<script>
    var page_url = "{{ url('evaluationAjax') }}";
</script>

 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Training Program Evaluation</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">Training Program Evaluation</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	
			
    	
		<div class="col-md-2" style="float:left">
		
		          <select class="form-control" name="fellowname" id="fellowname">
					
					<option value="">Select Fellow</option>
					@if(isset($studentData)) 
					@foreach($studentData as $data)
					<option value="{{$data->id}}">{{$data->email_id}}</option>
					@endforeach
					@endif
					</select>
					</div>
					
					<div class="form-group" >
					<input type="submit" id="filterSearch" class="btn btn-primary "  value= "Search" />
					</div>
		
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="training_eval">
			    
				<thead>
				       <tr>
							<th>Name of the Fellow</th>
							<th>Email</th>
							<th>Star Rating</th>
							<th>Suggestion</th>
							<th>Action</th>
					  </tr>
					  </thead>
					  
					  
					  <tbody>

					 @if(isset($students)) @foreach($students as $student)
					  <tr>
					  	<td>{{$student->firstname.' '.$student->middlename.' '.$student->lastname}}</td>
						<td>{{ $student->email_id }}</td>
					  	<td>{{ $student->star_rating }}</td>
						<td>{{ $student->suggestions }}</td>
						<td>
						<a href="{{route('view-evaluation',$student->id )}}"><i class="fa fa-eye"></i></a>
						</td>
					  </tr>
					  @endforeach
					  @endif
					  
					  </tbody>
					 
				</table> 
				</div>
				
				
				<!--   -->
        </div>
		
    </div>
</div>


</div>

<script>

$(document).ready(function() {
	$( "#training_eval" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } );


$(document).ready(function() {

$("#filterSearch").on('click',function(){

	var fellowname=$("#fellowname").val();

	
var _token = $('input[name="_token"]').val();
	$('#training_eval').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { fellowname,_token }
                },

                'columns': [
				    { data: 'fellowname' },
					{ data: 'email' },
                    { data: 'starRating' },
					{ data: 'suggestions' },
					{ data: 'clickTocheck' },
                ]
            });

	
});

/* End New Code Of On change */







});  
  
  

</script>
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
	
	