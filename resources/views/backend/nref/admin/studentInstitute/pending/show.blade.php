@extends('layouts.master')
@section('container')

<div class="content-wrapper">
<div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Application of Pending Student View</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">NREF/{{date('Y')}}/{{$recorde->id}}</h4></div>
  
      <div class="card-body">
	   <?php $role_id  = Auth::user()->role; $login_officer_id  = Auth::user()->id;?>
	  <?php if($role_id!=5) { ?>
	        <a class="btn btn-primary" data-toggle="modal" data-target="#consider" style="color:white" href="#">Consider</a>

            <a class="btn btn-danger" data-toggle="modal" data-target="#nonConsider" style="color:white">Non Consider</a> 
	  <?php } ?>		
            <a class="btn btn-secondary" href="{{url('get-institute/'.$ids)}}">Back</a>
		            
        @include('includes/flashmessage')
        <br />   <br />   <br />
         <table id="example1" class="table table-bordered " role="grid" aria-describedby="example1_info">
              <tbody>
         <tr>
		    <td>Student Name : </td>
            <td><img src="{{asset('public/uploads/nref/student_registration/student_photo/'.$recorde->student_image)}}" width="50px; height:50px"> </td>
          </tr>
          <tr>
            <td>Student Name : </td>
             <td> <?php echo ucwords($recorde->firstname.' '.$recorde->middlename.' '.$recorde->lastname);?></td>
		  </tr>
           <tr>
            <td>Gender : </td>
            <td><?php if($recorde->gender == "1"){echo "Male";}else if($recorde->gender == "2"){echo "Female";} ?></td>
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
            <td>Country : </td>
            <td>INDIA</td>
          </tr>
           <tr>
            <td>State : </td>
            <td>{{$stateName[0]->state_name}}</td>
          </tr>
           <tr>
            <td>Destrict : </td>
            <td>{{$disticName[0]->district_name}}</td>
          </tr>
           <tr>
            <td> Aadhar Number of Student  : </td>
            <td>{{$recorde->aadhar}}</td>
          </tr>
		   <tr>
            <td>Selection Committee Recommandation : </td>
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
            <td><?php foreach($courses as $course)  { 
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
    </div>  </div>  </div>   
	


<!----------------------- Consider Modal ----------------------------------->
<div class="modal fade" id="consider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Consider Sudent : NREF/{{date('Y')}}/{{$recorde->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
        <form method="post" action="{{url('consider')}}" name="consider">
          @csrf
        <input type="hidden" name="backPage" value="{{ $ids }}">
        <input type="hidden" name="studentId" value="{{ $recorde->id }}">
		<input type="hidden" name="status_id" value="1">
		<input type="hidden" name="redirect_url" value="get-institute">
         
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
        <h5 class="modal-title" id="exampleModalLabel">Non Consider Sudent : NREF/{{date('Y')}}/{{$recorde->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
        <form method="post" action="{{url('nonconsider')}}" name="nonconsider">
          @csrf
        <input type="hidden" name="backPage" value="{{ $ids }}">
        <input type="hidden" name="studentId" value="{{ $recorde->id }}">
		<input type="hidden" name="status_id" value="2">
		<input type="hidden" name="redirect_url" value="get-institute">
         
         <div class="form-group">
          <label for>Select the reason for not considered:</label>
          <select class="form-control" name="reason" id="reason" required>
            <option value="">Select</option>
			<option value="Application not in format">Application not in format</option>
			<option value="University ranking not up to the mark">University ranking not up to the mark</option>
			<option value="Attached doc is not proper">Attached doc is not proper</option>
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
</div>
<!----------------------- End of Consider modal-------------------->

@endsection
