@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Student</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">View Student</h4></div>
      <div class="card-body">
                      
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
             <td> <?php echo ucwords($recorde->firstname.' '.$recorde->middlename.' '.$recorde->lastname);?></td>
		  </tr>
           <tr>
            <td>Gender : </td>
            <td><?php if($recorde->gender == "1"){echo "Male";}else if($recorde->gender == "2"){echo "Female";} else if($recorde->gender == "3"){echo "Other";} ?></td>
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
	  <br>
	    <center>
			<a href="{{url('student-registration')}}" class="btn btn-outline-secondary">
			<i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
		</center>
        </div> 
    </div> </div> </div>
  <!--   <script src="{{ asset('js/app.js') }}"></script> -->
  <script type="text/javascript">
 $(document).ready(function () {
      $(".nav-link").removeClass('active');
      $("#listudent").addClass('active');
    });
</script>
@endsection
