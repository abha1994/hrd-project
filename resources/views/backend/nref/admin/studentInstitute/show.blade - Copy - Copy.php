@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registered Student </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('registerd-student')}}">Home</a></li>
              <li class="breadcrumb-item active">Registerd Student </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  
    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">      
        <div  style="float: right; padding-bottom: 10px;"> 
		<?php //dd($recorde);?>
		
		<button type="button" class="btn btn-primary" data-toggle="modal" style="border: #3c8424;background-color: #3c8424;" onclick="considered_nonconidered(1,'<?php echo $recorde->id;?>','<?php echo $recorde->institute_id;?>')">Considered</button>
		
		<button type="button" class="btn btn-primary" data-toggle="modal"  style="border: #d81a11;background-color: #d81a11; " onclick="considered_nonconidered(1,'<?php echo $recorde->id;?>','<?php echo $recorde->institute_id;?>')">Non Considered</button>
		
            <!--a class="btn btn-primary" data-toggle="modal" data-target="#consider" style="color:white" href="#">Consider</a>
            <a class="btn btn-danger" data-toggle="modal" data-target="#nonConsider" style="color:white">Non Consider</a-->      
            <a class="btn btn-secondary" href="{{url('get-instituteId/'.$ids)}}">Back</a>
        </div>                 
        @include('includes/flashmessage')
        <br />
         <table id="example1" class="table table-bordered " role="grid" aria-describedby="example1_info">
              <tbody>
          <tr>
		    <td>Student Name : </td>
            <td><img src="{{asset('public/uploads/nref/student_registration/student_photo/'.$recorde->student_image)}}" width="50px; height:50px"> </td>
          </tr>
          <tr>
            <td>Student Name : </td>
            <td>{{$recorde->firstname}} {{ $recorde->middlename}} {{$recorde->lastname}}</td>
          </tr>
           <tr>
            <td>Gender : </td>
            <td>{{$recorde->gender}}</td>
          </tr>
           <tr>
            <td>Address : </td>
            <td>{{$recorde->address}}</td>
          </tr>
           <tr>
            <td>Age : </td>
            <td><?php echo date('d-m-Y',strtotime($recorde->dob));?></td>
          </tr>
		   <tr>
            <td>Doj : </td>
            <td><?php echo date('d-m-Y',strtotime($recorde->doj));?></td>
          </tr>
		   <tr>
            <td>Category : </td>
			<td> <?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST');
			 foreach($categories_arr as $k=>$v){
			 if($k == $recorde->category){ echo  $v; } }?></td>
          </tr>
           <tr>
            <td>Pincode : </td>
            <td>{{$recorde->pincode}}</td>
          </tr>
           <tr>
            <td>course : </td>
            <td>{{$recorde->course}}</td>
          </tr>
           <tr>
            <td>Country : </td>
            <td>{{$recorde->country}}</td>
          </tr>
           <tr>
            <td>State : </td>
            <td>{{$stateName->state_name}}</td>
          </tr>
           <tr>
            <td>Destrict : </td>
            <td>{{$disticName->district_name}}</td>
          </tr>
           <tr>
            <td> Aadhar Number of Student  : </td>
            <td>{{$recorde->aadhar}}</td>
          </tr>
		   <tr>
            <td>Selection Committee Recommandation : </td>
			<?php  //dd($recorde); ?>
            <td><a href="{{asset('public/uploads/nref/student_registration/commitee_recommanded/'.$recorde->commiteedocument)}}" target="_blank">{{$recorde->commiteedocument}}</a></td>
          </tr>
		   <tr>
            <td>Highest Qualification : </td>
            <td><a href="{{asset('public/uploads/nref/student_registration/qulification/'.$recorde->highest_qulification)}}" target="_blank">{{$recorde->highest_qulification}}</a></td>
          </tr>
		   <tr>
            <td>Candidate declaration form  : </td>
            <td><a href="{{asset('public/uploads/nref/student_registration/candidate_declaration/'.$recorde->candidate_declaration)}}" target="_blank">{{$recorde->candidate_declaration}}</a></td>
          </tr>
		  
	
		   <tr>
            <td>Course Applied For : </td>
            <td><?php 
			foreach($courses as $course)  { 
			    if ($recorde->course == $course->course_id) {
				echo $course->course_name ;
			    }
			}?>
			 </td>
          </tr>			
		   <tr>
            <td>GATE : </td>
            <td><a href="{{asset('public/uploads/nref/student_registration/gate/'.$recorde->gate)}}" target="_blank">{{$recorde->gate}}</a></td>
          </tr>
		   <tr>
            <td>NET : </td>
            <td><a href="{{asset('public/uploads/nref/student_registration/net/'.$recorde->net)}}" target="_blank">{{$recorde->net}}</a></td>
          </tr>
           <tr>
            <td>Experience  : </td>
            <td><a href="{{asset('public/uploads/nref/student_registration/experience/'.$recorde->experience)}}" target="_blank">{{$recorde->experience}}</a></td>
          </tr>
          <tr>
            <td>Publication  : </td>
            <td><a href="{{asset('public/uploads/nref/student_registration/publication/'.$recorde->publication)}}" target="_blank"> {{$recorde->publication}}</a></td>
          </tr>
           
        </tbody>
      </table>
        </div> 
    </div>
	<?php $role_id  = Auth::user()->role; $login_officer_id  = Auth::user()->id;?>	

	
<div class="modal" id="considered">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 109%;">
      <div class="modal-header">
	  
	    
         <div class="card-header text-center" style="width: 100%;"><h4 class="application_id mt-2"> </h4><button type="button" class="close" style="margin-top: -49px;" onclick="close_consider_non_cons()" >&times;</button></div>
		 
		
     </div>

      <!-- Modal body -->
    <form  action="{{ url('student-consider') }}" class=""  onsubmit="this.elements['submit'].disabled=true;" autocomplete="off" id="considered_from" method="POST" >
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
		<input type = "hidden" name ="status_application" id="status_application" value="">
		<input type = "hidden" name ="student_id" id="student_id" value="">
		<input type = "hidden" name ="institute_id" id="institute_id" value="">
		<input type = "hidden" name ="officer_id" id="officer_id" value="<?php echo $login_officer_id?>">
		<input type = "hidden" name ="role_id" id="role_id" value="<?php echo $role_id?>">
	   <div class="form-group">
			<div class="row"  style=" margin-right:0px; margin-left:0px;">  
			   <div class="col-md-12"> 
			     <div id="consider_success"></div>
			   </div>
			</div>
		</div>
		
		
		
		<div class="form-group" style="display:none" id="non_cons_show">
			<div class="row"  style=" margin-right:0px; margin-left:0px;">
				   <div class="col-md-4">
						<tr>
							<td><b>Select the reason for not considered: </b></td>
						</tr>
					</div>
					<div class="col-md-8">
						<tr>
							<td>
							<select class="form-control" name="reason" id="reason">
								<option value="">Select</option>
								<option value="Id Proof is not Valid">Id Proof is not Valid</option>
								<option value="Experience not matches">Experience not matches</option>
								<option value="Qualification not matches">Qualification not matches</option>
								<option value="Desired Internship place is already fulfil">Desired Internship place is already fulfil</option>
								<option value="Others">Others</option>
							</select>
							</td>
						</tr>
						<div id="non_reason_error"></div>
					</div> 
			
			</div> 
		</div>
		
		
	    <div class="form-group">
			<div class="row"  style=" margin-right:0px; margin-left:0px;">  
			   <div class="col-md-3">
					<tr>
						<td><b>Remarks: </b></td>
					</tr>
				</div>
				<div class="col-md-9">
					<tr>
						<td><textarea name="remarks" id="remarks" class="form-control" rows="5" col="10"></textarea></td>
					</tr>
					<div id="consider_error"></div>
				</div> 
			</div> 
		</div>
		<hr>
		<center>
			<div class="form-group" >
			    <button onclick="consider_form_sumbit()"  id="cons"  class="btn btn-primary icon-btn" type="button">Submit</button>
				<button type="button" class="btn btn-danger" onclick="close_consider_non_cons()">Close</button>
			</div> 
		</center>
	</form>

    </div>
  </div>
</div>
<!-- The Modal For Considered -->


<!----------------------- Consider Modal ----------------------------------->
<!--div class="modal fade" id="consider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Consider Sudent : NREI/2020/{{$recorde->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
        <form method="post" action="{{url('consider')}}" name="consider">
          @csrf
        <input type="hidden" name="backPage" value="{{ $ids }}">
        <input type="hidden" name="studentId" value="{{ $recorde->id }}">
         
        <div class="form-group">
          <label for="condier">Remarks</label>
          <textarea name="remarks" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="consider">Save changes</button>
      </div>
       </form>
    </div>
  </div>
</div>

<div class="modal fade" id="nonConsider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Non Consider Sudent : NREI/2020/{{$recorde->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
        <form method="post" action="{{url('nonconsider')}}" name="nonconsider">
          @csrf
        <input type="hidden" name="backPage" value="{{ $ids }}">
        <input type="hidden" name="studentId" value="{{ $recorde->id }}">
         
         <div class="form-group">
          <label for>Select the reason for not considered:</label>
          <select class="form-control" name="reason" id="reason" required>
            <option value="">Select</option>
            <option value="Id Proof is not Valid">Id Proof is not Valid</option>
            <option value="Experience not matches">Experience not matches</option>
            <option value="Qualification not matches">Qualification not matches</option>
            <option value="Desired Internship place is already fulfil">Desired Internship place is already fulfil</option>
            <option value="Others">Others</option>
          </select>
         </div>
        <div class="form-group">
          <label for="condier">Remarks</label>
          <textarea name="remarks" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="nonconsider">Save changes</button>
      </div>
       </form>
    </div>
  </div>
</div--->
<!----------------------- End of Consider modal-------------------->

<script type="text/javascript">

   
/*************Student Considered AND Non Considered popup open and popup close and form submit function*********/
function considered_nonconidered(status,student_id,institute_id){
	// alert("{{URL('get-instituteId/institute_id')}}");
	if(status == "2"){
		$('#non_cons_show').show();
		$('.application_id').html('Non Considered Application');
	}else if(status =="1"){
		$('.application_id').html('Considered Application');
		$('#non_cons_show').hide();
	}
    $('#status_application').val(status);
	$('#student_id').val(student_id);
	$('#institute_id').val(institute_id);
	$('#considered').show();

}

function close_consider_non_cons(){
	$('#considered').hide("");
	$('#non_reason_error').html('');
	$('#consider_error').html('');
}
  
function consider_form_sumbit(){
  var status_application = $('#status_application').val();
  if(status_application == "2"){
	  var reason = $('#reason').val();
	  if(reason == ""){
		 $('#non_reason_error').html('Please select reason!!..');
		 $('#non_reason_error').css('color','red');
	  }
  }else if(status_application == "1"){
	  var reason = "";
  }
  var _token = $('input[name="_token"]').val();
  var student_id = $('#student_id').val();
  var institute_id = $('#institute_id').val();
  var officer_id = $('#officer_id').val();
  var role_id = $('#role_id').val();
  var remarks = $('#remarks').val();
  var page_url = "{{ url('get-instituteId') }}"+"/"+institute_id;
  // alert(page_url);return false;
  if(remarks == ""){
     $('#consider_error').html('Please enter your remarks!!..');
     $('#consider_error').css('color','red');
  }else{
    $.ajax({
            url:"{{ url('student-consider') }}",
            type: 'POST',
            data: {reason:reason,student_id:student_id,status_application: status_application,institute_id:institute_id,remarks:remarks,officer_id:officer_id,role_id:role_id,_token:_token},
             success: function(data) {
				  if(data == 1){
                  $('#cons').prop('disabled','true');
                  setTimeout(function(){ 
                    window.location.href = page_url;
                   }, 3000);
				   $('#consider_error').html('');
                  $('#consider_success').html('Status Updated Successfully!!..');
                  $('#consider_success').css('color','green');
                }
            }
      });
    }
} 
	

/*************Student Considered AND Non Considered popup open and popup close and form submit function*********/

$(document).ready(function () {
  $(".nav-link").removeClass('active');
  $("#listudent").addClass('active');
});
</script>
@endsection
