@extends('layouts.app1')
@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<div class="content-wrapper" style="margin-left: 13px; ">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb"><li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      	<li class="breadcrumb-item active">Internship Form</li>
      </ol>
    	<!-- <div class="intern_title">
	    	Ministry will provide internship opportunity to facilitate students pursuing under graduate/graduate/post graduate degrees or research scholars enrolled in recognized institutes/universities with in India or abroad, as "Interns". The students of various Engineering, Science, Management, law and other streams may undertake internship in the Ministry and in organizations under its aegis to understand various activities of the Ministry to become Researchers/Managers in renewable energy area. These interns will be attached with the senior level officers of the Ministry in various Programme Divisions.
		</div> -->
		<div class="card-body">
    		    <div class="modal-header" style="color: #FFF"><h4>Internship Form <br />Fellowship Program Application Annexure 1A </h4><span style="float: right;"><input name="print" type="button" id="preview" class="btn btn-dark" value="Print this Application" onclick="JavaScript:window.print();"></h4></span></div>
            <div class="modal-body">
                <!-- We display the details entered by the user here -->
                <table class="table">
                	<thead>
                		 
                	</thead>
                    <tr>
                        <th colspan="2">First Name</th>
                        <th colspan="2">Middle Name</th>
                        <th colspan="2">Last Name</th>
                    </tr>
                    <tr>
                    	<td colspan="2">{{$data->first_name}}</td>
                        <td colspan="2">{{$data->middle_name}}</td>
                        <td colspan="2">{{$data->last_name}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Email Id</th>
                        <th colspan="2">DOB</th>
                        <th colspan="1">Gender</th>
                        <th colspan="1">Mobile</th>
                    </tr>
                    <tr>
                    	<td colspan="2">{{$data->email}}</td>
                        <td colspan="2">{{$data->date_birth}}</td>
                        <td colspan="1">
                            @if($data->gender == 1){{ 'Male' }} @endif
                            @if($data->gender == 2){{ 'Female' }} @endif
                            @if($data->gender == 0){{ 'Others' }} @endif</td>
                        <td colspan="1">{{$data->mob_number}}</td>
                    </tr>

                     <tr>
                        <th colspan="2">Country</th>
                        <th colspan="2" >State</th>
                        <th colspan="2">Distric</th>
                        
                    </tr>
                    <tr>
                    	<td  colspan="2">{{$country->name}}</td>
                        <td  colspan="2">{{$state->state_name}}</td>
                        <td  colspan="2">{{$distric->district_name}}</td>                         
                    </tr>

                   <?php /*<tr><th colspan="3">Whether you are employed :->  </th></tr>
                    <tr>
                    	<td colspan="2">{{$data->employed_inst}}</td>
                    	<td colspan="2">{{$data->employed_addr}}</td>
                    	<td colspan="2">{{$data->employed}}</td>
                    </tr>  */?>
                            
                    <tr><th><h4>Education Details</h4></th></tr>
                    <tr>
                        <th>Education Qualification	</th>
                        <th>University/Institute	</th>
                        <th>Stream</th>
                        <th>Pursuing/Passed	</th>
                        <th>Year of Passing	</th>
                        <th>Percentage/ CGPA/ Overall Percentage</th>
                    </tr>
                    @foreach($educations as $education)
                    <tr class="table-active">
                    	 <td >{{$education->courseid}}</td>
                    	 <td >{{$education->institute}}</td>
                    	 <td >{{$education->stream}}</td>
                    	 <td >@if($education->passstatus == 1)
                            {{ 'Pursuing '}}
                            @else
                            {{ 'Passed' }}
                            @endif</td>
                    	 <td>{{$education->yearcompletion}}</td>
                    	 <td >{{$education->markspercentage}} %</td>
                    </tr>
                     @endforeach          
                      
                    <tr>
                        <th colspan="3">Area(s) of Specialization</th>
                        <th colspan="3">Special Achievement	</th>                         
                    </tr>
                    <tr>
                        <td  colspan="3">{{$fellowshipDetails->ar_spc}}</td>
                        <td colspan="3">{{$fellowshipDetails->special_achievement}}</td>                         
                    </tr>
                    <tr>
                        <th colspan="3">Details of awards/ recognition received in the subject area at the national/international level</th>
                        <th colspan="3">Details of Books published*</th>                         
                    </tr>
                    <tr>
                        <td  colspan="3">{{$fellowshipDetails->details_awards}}</td>
                        <td  colspan="3">{{$fellowshipDetails->book_published}}</td>                         
                    </tr>

                    <tr>
                        <th colspan="3">Details of Films/audio-visuals published (if any)</th>
                        <th colspan="3">Details of research scholors successfully guided and those currently pursuing MPhil/ Ph.D under your supervision</th>                         
                    </tr>
                    <tr>
                        <td colspan="3">{{$fellowshipDetails->audio_video}}</td>
                        <td colspan="3">{{$fellowshipDetails->details_scholar}}</td>                         
                    </tr>


                    <tr>
                        <th colspan="3">Are you ready to give commitment to work at the selected host institute for full tenure of the fellowship granted</th>
                        <th colspan="3">Are you willing to submit a bond in this regard to the host institution? </th>                         
                    </tr>
                   
                    <tr>
                        <td colspan="3">{{$fellowshipDetails->commitment}}</td>
                        <td colspan="3">{{$fellowshipDetails->submit_bond}}</td>                         
                    </tr>

                    <tr>
                        <th colspan="3">List up details of scientific & Techinical Papers published</th>
                        <th colspan="3">Why you should be selected National Solar Science Fellow and how the proposed research project </th>                         
                    </tr>
                    <tr>
                        <td id="paper_publish" colspan="3">{{$fellowshipDetails->paper_published}}</td>
                        <td id="why_select" colspan="3">{{$fellowshipDetails->why_selected}}</td>                         
                    </tr>

                    <tr>
                        <th colspan="3">Selected ID Proof Type</th>
                        <th colspan="3"> ID Proof in PDF format </th>                         
                    </tr>
                    <tr>
                        <td colspan="3">
                            @if($data->id_proof_type == 1){{ 'VoterID' }} @endif
                            @if($data->id_proof_type == 2){{  'Driving Licence' }} @endif
                            @if($data->id_proof_type == 3){{ 'Passport' }} @endif
                            @if($data->id_proof_type == 4){{ 'College Id Car' }} @endif
                        </td>
                        <td colspan="3">
                        	<!-- <iframe src="{{asset('uploads/nres/fellowship/'.$data->file_id_proof)}}" width="70%" height="85px"> -->
                        		<a href="{{asset('public/uploads/nres/fellowship/'.$data->file_id_proof)}}" target="_blank">Click here to download</a>
                        	</td>                         
                    </tr>

                     <tr>
                        <th colspan="3">Upload one-page doc of Original, innovative and pioneering research work</th>
                        <th colspan="3"> Candidate Photograph* </th>                         
                    </tr>
                    <tr>
                        <td colspan="3"><a href="{{asset('public/uploads/nres/fellowship/'.$fellowshipDetails->research_work)}}" target="_blank">Click here to download</a>
                        	 </td>
                        <td colspan="3"><img style="height: 6em;" src="{{asset('public/uploads/nres/fellowship/'.$data->file_photo)}}"></td>                         
                    </tr>

                    
                    <tr><th colspan="6"><h4>Please provide two (2) references with complete contact details</h4></th></tr>
                    <tr>
                        <th colspan="2">References Name</th>
                        <th colspan="2">References Email</th>
                        <th colspan="2">References Phone</th>
                         
                    </tr>
                    @foreach($condidatereferences as $reference)
                    <tr class="table-active">
                    	 <td  colspan="2">{{$reference->name_ref}}</td>
                    	 <td  colspan="2">{{$reference->email_ref}}</td>
                    	 <td  colspan="2">{{$reference->mobile_ref}}</td>
                    	  
                    </tr>
                    @endforeach
                      
                </table>
            </div> 
   		</div>
    </div>
</div> 

 <style type="text/css">
  ::placeholder {  
  	font-size: 0.8em;
  	color:#000000 !important;
  }
  .modal-header{
background-color: #334FFF;
  }

 #father_name::after,#pincode::after,#address::after,#ar_spc::after,#spcl_achvmnt::after,#details_awards::after,#book_published::after,#details_schola::after,#audio_video::after,#details_scholar::after,#paper_published::after,#why_selected::after {
  content:" *";
  display:block;
  color:red !important;
}
.form-control[readonly] {
    background-color:#fff !important;
 }
span.input-group-addon {
  background-color:#fff !important;
 }
.form-control[disabled] {
    background-color:#fff !important;
}
.form-control[disabled] {
    border-color:#000 !important;
}
.form-control[readonly] {
    border-color:#000 !important;
}
#file_photo_error {
   font-size:16px; 
}
.error {
 	color:red;
   font-size:12px; 
}
 </style>	

@endsection
	
	