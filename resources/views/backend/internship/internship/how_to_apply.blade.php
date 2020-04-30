@extends('layouts.master')
@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">How To Apply</li>
      </ol>
	    <div class="intern_title">
	    Ministry will provide internship opportunity to facilitate students pursuing under graduate/graduate/post graduate degrees or research scholars enrolled in recognized institutes/universities with in India or abroad, as "Interns". The students of various Engineering, Science, Management, law and other streams may undertake internship in the Ministry and in organizations under its aegis to understand various activities of the Ministry to become Researchers/Managers in renewable energy area. These interns will be attached with the senior level officers of the Ministry in various Programme Divisions.
	 </div>
     <div class="card card-login mx-auto mt-5" style="max-width: 65rem;">
   	
 <marquee behavior="scroll" z-index:99;="" width="100%" height="30px" scrollamount="3" direction="left" style="background:rgba(0,0,0,.03)"><h3><span style="color:#FF0000;">The internship will be on unpaid basis. No stipend will be provided to interns. </span></h3></marquee>							   
      <div class="card-header text-center">WHO IS ELIGIBLE</div>
      <div class="card-body">
 
			<div class="row">
			<div class="col-md-offset-2 col-md-12">
				<p>Applicants can apply throughout the year online only through the address link to be indicated in the website of Ministry of New and Renewable Energy www.mnre.gov.in. Intern must clearly indicate the area of interest. (Ministry's thrust research areas & programme areas/vision can be obtained from the website). Application shall be made at least one month before the expected date of Joining and not more than 3 months in advance from the date of commencement .i.e if applicants want internship from Ist of January 2020, he/she can apply from 1st October 2019 to 30th November, 2019.</p>
                <h4 align="center"><a href="{{ url('internship')}}"  >Please Click Here To Apply</a></h4>
			</div><!-- end of col -->
			</div><!-- end of row -->

      </div>
    </div>
    </div>
  </div>
 
@endsection
