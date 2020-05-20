@extends('layouts.master')

@section('container')

<script>
    var page_url = "{{ url('selectedInstituteAjax') }}";
</script>

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $data['breadcum'];?></li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2"><?php echo $data['breadcum'];?></h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
		 @if ($account = Session::get('success'))
		 <div class="alert alert-success alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $account }}</strong>
		 </div>
	     @endif
		 
		  @if ($account = Session::get('error'))
		 <div class="alert alert-danger alert-block">
		   <button type="button" class="close" data-dismiss="alert">×</button>	
		   <strong>{{ $account }}</strong>
		 </div>
	     @endif
		 
		 <!-- Filter code Html -->
		 
		 
		 <div class="form-group">
		<div class="row">
		
		<?php //echo "<pre>"; print_r($stateList); die; ?>
		
		<div class="col-md-2">
			   <select class="form-control" name="courseId" id="courseId" >
			   <option value="">Select Course</option>
			   <option value="mtech">M.Tech</option>
			   <option value="jrf">JRF</option>
			   <option value="srf">SRF</option>
			   <option value="msc">M.sc Renewable Energy</option>
			   <option value="ra">RA</option>
			   <option value="pdf">PDF</option>
			   
			   </select>
			</div>
		
		  <div class="col-md-2">
			   <select class="form-control" name="stateId" id="stateId" >
			   <option value="">Select State</option>
			   @if(isset($stateList)) @foreach($stateList as $state)
			   <option value="{{$state->statecd}}">{{$state->state_name}}</option>
			   @endforeach
			   @endif
			   
			   </select>
			</div>
			
			<div class="col-md-2">
			   <input class="date form-control"  type="text"  value="" name="datepicker_search_from" id="datepicker_search_from" Placeholder="From Date">
			</div>
			<div class="col-md-2">
			   <input class="date form-control"  type="text" name="dt21" id="dt21" Placeholder="To Date">
			</div>
									
			<button class="btn btn-info btn-sm " type="submit" name="srch" id="srch" >Search</button>
			
			

		</div> 
	 </div>
	 
	 <form action="{{ route('exportPdf') }}" class=""  autocomplete="off" method="POST">
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
			 <input type="hidden" name="coursepdf" value="" id="coursepdf">
			 <input type="hidden" name="statepdf" value="" id="statepdf">
			 <input type="hidden" name="frmdatepdf" value="" id="frmdatepdf">
			 <input type="hidden" name="todatepdf" value="" id="todatepdf">
			 
			 <input type="hidden" name="institutetype" value="6" >
			 
			<button class="btn btn-info btn-sm" type="submit"  value="2" name="type" ><i class="glyphicon glyphicon-export icon-share"></i> Export Pdf </button>
			
			<button class="btn btn-info btn-sm" type="submit"  value="1" name="type" ><i class="glyphicon glyphicon-export icon-share"></i> Export Excel</button> &nbsp;
			
	</form>
		 
		 <!-- Filter Code Html -->
				
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable12" width="100%">
              <thead>
                <tr>
				  <th id="sort">S. No.</th>
                  <th>Institute Name</th>
                  <th>Address</th>
				  <th>Name of the Cordinator/Proposed</th>
				  <th>Email</th>
				  <th>Mobile</th>
				  <th>Total Fellowship Slot</th>
				  <th>Fellowship Request Period</th>
                  <th>Institute Reg.No</th>
				  <th>Pincode</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              
				<?php $i=1; foreach($data['institute_data'] as $v){?>
				  <tr>
				  <td><?php echo $i; ?></td>
                  <td><?php echo $v->institute_name;?></td>
                  <td><?php echo $v->institute_addres;?></td>
				  <td><?php echo $v->coordinate_prog;?></td>
				  <td><?php echo $v->email_id;?></td>
				  <td><?php echo $v->mobile_no;?></td>
				  <td><?php echo $v->fellowship_total;?></td>
				  <td><?php echo $v->fellowship_period;?></td>
                  <td>
				   <?php echo $v->institute_reg_no;?>
				  </td>
				  <td>
				   <?php echo $v->pincode;?>
				  </td>
                  <td>
				
				  <br>
				      @can('Selected-nref-institute-list')
					  <a href="{{route('view-university',$v->institute_id )}}"><i class="fa fa-eye"></i></a>
				      @endcan
					  
				  </td>
				  </tr>
				<?php $i++; } ?>
                
             
             
              </tbody>
            </table>
          </div>
        </div>
        <!--div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div-->
      </div>
    </div>
 </div>
 
 <script>

$(document).ready(function() {
	$( "#dataTable12" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
	
	
	/* Filter Code Start */
	
	$("#srch").on("click",function(){
		
		var stateId= $("#stateId").val();
		var courseId = $("#courseId").val();
		var frmDate = $("#datepicker_search_from").val();
		var toDate = $("#dt21").val();
		var _token = $('input[name="_token"]').val();
		
		$("#coursepdf").val(courseId);
		$("#statepdf").val(stateId);
		$("#frmdatepdf").val(frmDate);
		$("#todatepdf").val(toDate);
		
		
		
		
		
		
	
if(toDate!="" && frmDate=="")
{
	$("#datepicker_search_from").focus();
}
else
{
		
		 $('#dataTable12').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { frmDate,toDate,stateId,courseId,_token }
                },

                   'columns': [
				   { data: 'sid' },
				    { data: 'instituteName' },
                    { data: 'address' },
					{ data: 'cordinator' },
					{ data: 'email' },
					{ data: 'mobile' },
					{ data: 'fellowslot' },
					{ data: 'fellowPeriod' },
					{ data: 'regno' },
					{ data: 'pincode' },
					{ data: 'clickTocheck' },
                ]
            }); 
}
		
		
		
	});
	
  } ); 
  
  

</script>
 
 


@endsection
