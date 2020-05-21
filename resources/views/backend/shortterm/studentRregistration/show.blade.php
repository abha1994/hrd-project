@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Participant</li>
      </ol>
  <div class="card card-login mx-auto mt-5 ">     
   <div class="card-header text-center"><h4 class="mt-2">View Participant</h4></div>
      <div class="card-body">
                      
        @include('includes/flashmessage')
        <br />
                   <table id="example1" class="table table-bordered " role="grid" aria-describedby="example1_info">
        <tbody>
		<tr>
		    <td>Participant Photo : </td>
            <td><img src="{{asset('public/uploads/shortterm/student_registration/student_photo/'.$recorde->student_image)}}" width="50px; height:50px"> </td>
          </tr>
         
          <tr>
            <td>Participant Name : </td>
             <td> <?php echo ucwords($recorde->firstname.' '.$recorde->middlename.' '.$recorde->lastname);?></td>
		  </tr>
           <tr>
            <td>Gender : </td>
            <td><?php if($recorde->gender == "1"){echo "Male";}else if($recorde->gender == "2"){echo "Female";}else if($recorde->gender == "3"){echo "Others";} ?></td>
          </tr>
		   <tr>
            <td>Mobile : </td>
            <td>{{$recorde->mobile}}</td>
          </tr>
		   <tr>
            <td>Email : </td>
            <td>{{$recorde->email_id}}</td>
          </tr>
           <tr>
            <td>Address : </td>
            <td>{{$recorde->address}}</td>
          </tr>
           <tr>
            <td>DOB : </td>
            <td><?php echo date('d-m-Y',strtotime($recorde->dob));?></td>
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
            <td>Participant Status : </td>
            <td><?php if($recorde->participant_status == "1"){echo "Professional";}else if($recorde->participant_status == "2"){echo "Student";} ?></td>
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
            <td>District : </td>
            <td>{{$disticName[0]->district_name}}</td>
          </tr>
           <tr>
            <td> Aadhar Number of Participant  : </td>
            <td>{{$recorde->aadhar}}</td>
          </tr>
		   
		   
		   <tr>
            <td>Uploaded Aadhar : </td>
            <td><a href="{{asset('public/uploads/shortterm/student_registration/upload_aadhar/'.$recorde->upload_aadhar)}}" target="_blank">{{$recorde->upload_aadhar}}</a></td>
          </tr>
		  
	
        </tbody>
      </table>
	  <br>
	    <center>
			<a href="{{url('st-student-registration')}}" class="btn btn-outline-secondary">
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
