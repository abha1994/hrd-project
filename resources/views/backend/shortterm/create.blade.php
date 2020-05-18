@extends('layouts.master')
@section('container') 
<script type="text/javascript" src="{{asset('public/jquery-validation/dist/jquery.validate.js')}}"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Student Registration</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('short-term-program')}}">Home</a></li>
              <li class="breadcrumb-item active">Student Registration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid border-top bg-white card-footer text-muted text-left " id="app">        
      <div class="col-md-10">
        <div class="card card-primary card-outline">
          <div class="card-body">              
            <form  enctype="multipart/form-data"  action="{{ route('short-term-program.store') }}" class="" id="shortterm" method="POST" >
            {{csrf_field()}}
            <div class="form-group{{ $errors->has('name_proposed_training_program') ? ' has-error' : '' }}">
              <div class="row">
                   
                  <div class="form-group{{ $errors->has('name_proposed_training_program') ? ' has-error' : '' }} col-md-6">
                  <label for="proposed">Name of the proposed training program</label>
                  <input name="name_proposed_training_program" id="name_proposed_training_program" class="form-control required" value="{{old('name_proposed_training_program')}}" placeholder="Name of the proposed training program" /> 
                 @if ($errors->has('name_proposed_training_program'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name_proposed_training_program') }}</strong>
                  </span>
                @endif
                 
                </div>
                <div class="col-md-6">
                  <label for="coordinator_name">Coordinator Name</label>
                  <input type="text" class="form-control  required"   value="{{old('coordinator_name')}}" id="coordinator_name" placeholder="Coordinator Name*" name="coordinator_name"  >
                 
                   @if ($errors->has('coordinator_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('coordinator_name') }}</strong>
                  </span>
                @endif
                </div>
              </div> 
              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="coordinator_mobile">Coordinator Mobile</label>
                  <input name="coordinator_mobile" id="coordinator_mobile"  value="{{old('coordinator_mobile')}}"  class="form-control required" type="text" id="coordinator_mobile"  class="form-control required" placeholder="Coordinator Mobile" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"> 
                  <span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
                   @if ($errors->has('coordinator_mobile'))
                  <span class="help-block">
                      <strong>{{ $errors->first('coordinator_mobile') }}</strong>
                  </span>
                @endif
                </div>
                <div class="col-md-6">
                  <label for="coordinator_address">Coordinator Address</label>
                   
                  <textarea name="coordinator_address" id="coordinator_address" class="form-control required">{{old('coordinator_address')}}</textarea>
                  @if ($errors->has('coordinator_address'))
                  <span class="help-block">
                      <strong>{{ $errors->first('coordinator_address') }}</strong>
                  </span>
                  @endif
                </div>
              </div> 
              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="history_organization_doc">Background history of the Organization, Its activities in RE Development, especially capacity building </label>
                  <input name="history_organization_doc "  value="{{old('history_organization_doc')}}"  class="form-control required" type="file" id="history_organization_doc"  placeholder="Coordinator Mobile" > 
                  @if ($errors->has('history_organization_doc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('history_organization_doc') }}</strong>
                  </span>
                @endif
                 <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
               <span  style="font-size: 12px;" id="history_organization_doc_error"> </span>
                </div>
                <div class="col-md-6">
                  <label for="technology_area">Technology area of the proposed training program</label>
                   
                  <select name="technology_area" id="technology_area" class="form-control" required="required" onchange="showfield(this.options[this.selectedIndex].value)">                    
                    <option value=""> Select </option>
                    <option value="1"> Solar </option>
                    <option value="2"> Solar Thermal </option>
                    <option value="3"> Solar Rooftop  </option>
                    <option value="4"> Solar Water Pumping </option>
                    <option value="5"> Small Hydro </option>
                    <option value="6"> Bioenergy </option>
                    <option value="7"> Hydrogen </option>
                    <option value="8"> Wind Energy  </option>
                    <option value="9"> Other RE Area  </option>
                  </select>
                  @if ($errors->has('technology_area'))
                  <span class="help-block">
                      <strong>{{ $errors->first('technology_area') }}</strong>
                  </span>
                 @endif
                 <div id="other_re_area" style="margin-top: 15px;"></div>
                </div>

              </div> <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Objective of the Program</label>




                 <textarea class="form-control required" name="objective_program" id="objective_program">{{old('objective_program')}}</textarea>
                  @if ($errors->has('objective_program'))
                  <span class="help-block">
                      <strong>{{ $errors->first('objective_program') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-md-6"><label>Target group to be addressed in proposed training program  </label>

                  


                 <textarea class="form-control required" name="target_group" id="target_group" >{{old('target_group')}}</textarea>
                  @if ($errors->has('target_group'))
                  <span class="help-block">
                      <strong>{{ $errors->first('target_group') }}</strong>
                  </span>
                  @endif
                </div>
              </div> 

              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Geographical area of operation </label>

                  <input type="text"  class="form-control required" name="geographical_area"  id="geographical_area" placeholder="Geographical area of operation " rows="1"  > 
                  @if ($errors->has('geographical_area'))
                  <span class="help-block">
                      <strong>{{ $errors->first('geographical_area') }}</strong>
                  </span>
                 @endif
                </div>
                <div class="col-md-6"><label>Assessment Skilled  </label>

               

                 <textarea name="assessment_skilled" id="assessment_skilled" class="form-control required">{{old('assessment_skilled')}}</textarea>
                  @if ($errors->has('assessment_skilled'))
                  <span class="help-block">
                      <strong>{{ $errors->first('assessment_skilled') }}</strong>
                  </span>
                  @endif
                </div>
              </div> 

              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Number of trainees proposed to be trained in one year (this should be based on assessment done in the area of operation)(Numeric Value) 
 </label>

                  <input type="text"  class="form-control required" name="no_student_trained_a_year"  id="no_student_trained_a_year" placeholder="Number of trainees proposed to be trained in one year" rows="1" onkeypress="return IsNumeric(event);" > 
                  
                  @if ($errors->has('no_student_trained_a_year'))
                  <span class="help-block">
                      <strong>{{ $errors->first('no_student_trained_a_year') }}</strong>
                  </span>
                 @endif
                 <span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
                </div>
                <div class="col-md-6"><label>No. of training programmers proposed in one years  </label>

                  <input type="text" class="form-control required" name="proposed_programme_a_year"  id="proposed_programme_a_year" rows="1" placeholder="No. of training programmers proposed in one years"  onkeypress="return IsNumeric(event);" > 
                   @if ($errors->has('proposed_programme_a_year'))
                  <span class="help-block">
                      <strong>{{ $errors->first('proposed_programme_a_year') }}</strong>
                  </span>
                 @endif
                 <span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
                </div>
              </div> 
              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Trainees proposed for batch/course/programmer </label>

                  <input type="text"  class="form-control required" name="no_trainee_proposed_batch"  id="no_trainee_proposed_batch" placeholder="Number of trainees proposed to be trained in one year" rows="1"  onkeypress="return IsNumeric(event);" > 
                   @if ($errors->has('no_trainee_proposed_batch'))
                  <span class="help-block">
                      <strong>{{ $errors->first('no_trainee_proposed_batch') }}</strong>
                  </span>
                 @endif
                 <span id="error" style="color: Red; display: none">* Input digits (0 - 9)</span>
                </div>
                <div class="col-md-6"><label>Duration of the proposed course </label>

                  <input type="text" class="form-control required" name="duration_proposed_course"  id="duration_proposed_course" rows="1" placeholder="Duration of the proposed course"  > 
                  @if ($errors->has('duration_proposed_course'))
                  <span class="help-block">
                      <strong>{{ $errors->first('duration_proposed_course') }}</strong>
                  </span>
                 @endif
                </div>
              </div> 
              <br />
              <div class="row">
                <div class="col-md-12">
                  <label for="objective_program">Selection Criteria of trainees (Text Area)</label>

                 

                 
                 <textarea name="selection_criteria" id="selection_criteria" class="form-control required">{{old('selection_criteria')}}</textarea>
                  @if ($errors->has('selection_criteria'))
                  <span class="help-block">
                      <strong>{{ $errors->first('selection_criteria') }}</strong>
                  </span>
                  @endif


                </div>
               <!--  <div class="col-md-6"><label>Duration of the proposed course </label>

                  <input type="text" class="form-control required" name="duration_proposed_course"  id="duration_proposed_course" rows="1" placeholder="Duration of the proposed course"  > 
                  @if ($errors->has('duration_proposed_course'))
                  <span class="help-block">
                      <strong>{{ $errors->first('duration_proposed_course') }}</strong>
                  </span>
                 @endif
                </div> -->
              </div> 
<!---------------------------- 2 Page---------------------------------->

               <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Faculty Name</label>

                  <input type="texgt" class="form-control required" name="faculty_name"  id="faculty_name" placeholder="Faculty Name" value="{{old('faculty_name')}}" />  
                  @if ($errors->has('faculty_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('faculty_name') }}</strong>
                  </span>
                 @endif
                </div>
                <div class="col-md-6"><label>Faculty Designation </label>

                  <input type="text" class="form-control required" name="faculty_designation"  id="faculty_designation" rows="1" placeholder="Faculty Designation" value="{{old('faculty_designation')}}"  > 
                  @if ($errors->has('faculty_designation'))
                  <span class="help-block">
                      <strong>{{ $errors->first('faculty_designation') }}</strong>
                  </span>
                 @endif
                </div>
              </div> 
              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Faculty Level</label>

                  <input type="text" class="form-control required" name="faculty_level"  id="faculty_level" placeholder="Faculty Level" value="{{old('faculty_level')}}"  />  
                
                  @if ($errors->has('faculty_level'))
                  <span class="help-block">
                      <strong>{{ $errors->first('faculty_level') }}</strong>
                  </span>
                 @endif
                </div>
                <div class="col-md-6"><label>Infrastructure  </label>

                  
                  <textarea name="infrastructure" id="infrastructure" class="form-control required">{{old('infrastructure')}}</textarea>
                  @if ($errors->has('infrastructure'))
                  <span class="help-block">
                      <strong>{{ $errors->first('infrastructure') }}</strong>
                  </span>
                  @endif

                </div>
              </div> 
              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Course Material doc</label>

                  <input type="file" class="form-control required" name="course_material_doc"  id="course_material_doc" placeholder="Course Material doc" />  
                   @if ($errors->has('course_material_doc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('infrastructure') }}</strong>
                  </span>
                 @endif
                  <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
               <span  style="font-size: 12px; " id="course_material_doc_error"> </span>
                </div>
                <div class="col-md-6"><label>Methodology of imparting training </label>

                  <select name="methodology_imparting_training" id="methodology_imparting_training" class="form-control required">
                    <option value="">Select</option>
                    <option value="1">Theory</option>
                    <option value="2">Practical</option>
                    <option value="3">Both</option>
                   </select>
                 @if ($errors->has('methodology_imparting_training'))
                  <span class="help-block">
                      <strong>{{ $errors->first('methodology_imparting_training') }}</strong>
                  </span>
                 @endif
                </div>
              </div> 
              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Guest Faculty Doc</label>

                  <input type="file" class="form-control required" name="guest_faculty_doc"  id="guest_faculty_doc" placeholder="Guest Faculty Doc" />  
                  @if ($errors->has('guest_faculty_doc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('guest_faculty_doc') }}</strong>
                  </span>
                 @endif
                  <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
               <span  style="font-size: 12px;"id="guest_faculty_doc_error"> </span>
                </div>
                <div class="col-md-6"><label>Content Letter doc  </label>

                  <input type="file" class="form-control required" name="content_letter_doc"  id="content_letter_doc" placeholder="Content Letter doc" />  
                  @if ($errors->has('content_letter_doc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('content_letter_doc') }}</strong>
                  </span>
                 @endif
                 <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
               <span  style="font-size: 12px;" id="content_letter_doc_error"> </span>
                </div>
              </div> 

              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Core Guest Percentage Time</label>

                  

                  <textarea name="core_guest_percentage_time" class="form-control required">{{old('core_guest_percentage_time')}}</textarea>
                  @if ($errors->has('core_guest_percentage_time'))
                  <span class="help-block">
                      <strong>{{ $errors->first('core_guest_percentage_time') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-md-6"><label>Tie up campus programmer  </label>
 
                    <textarea name="tieup_campus_programmer" class="form-control required">{{old('tieup_campus_programmer')}}</textarea>
                  @if ($errors->has('tieup_campus_programmer'))
                  <span class="help-block">
                      <strong>{{ $errors->first('tieup_campus_programmer') }}</strong>
                  </span>
                  @endif
                </div>
              </div> 

               <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Engaging trained programmer</label>

                   
                  <textarea name="engaging_trained_programmer" class="form-control required">{{old('engaging_trained_programmer')}}</textarea>
                  @if ($errors->has('engaging_trained_programmer'))
                  <span class="help-block">
                      <strong>{{ $errors->first('engaging_trained_programmer') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-md-6"><label>Fee charged traniees  </label>

                  
                  <textarea name="fee_charged_traniees" class="form-control required">{{old('fee_charged_traniees')}}</textarea>
                  @if ($errors->has('fee_charged_traniees'))
                  <span class="help-block">
                      <strong>{{ $errors->first('fee_charged_traniees') }}</strong>
                  </span>
                  @endif
                </div>
              </div> 
              <br />
              <div class="row">
                <div class="col-md-6">
                  <label for="objective_program">Anticipate impact</label>
 

                 <textarea name="anticipated_impact" class="form-control required">{{old('anticipated_impact')}}</textarea>
                  @if ($errors->has('anticipated_impact'))
                  <span class="help-block">
                      <strong>{{ $errors->first('anticipated_impact') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-md-6"><label>Financial Proposal doc  </label>

                   <input type="file"  class="form-control required" name="financial_proposal_doc"  id="financial_proposal_doc" /> 
                 @if ($errors->has('financial_proposal_doc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('financial_proposal_doc') }}</strong>
                  </span>
                 @endif
                 <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
               <span  style="font-size: 12px;" id="financial_proposal_doc_error"> </span>
                </div>
              </div> 
<!--------------------------------------------------------------------->
            </div>
             <center>
      <div class="form-group" >
        <span id="errmsg"></span>
            
          <input class="btn btn-primary submit_bt" type="submit"  value="Submit" name="submit_bt">
           
            
           

           <input type="button" name="btn" value="Preview" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" />
           <a href="{{route('short-term-program.index')}}" class="btn btn-secondary">Cancel</a>
      </div> 
    </center>   
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb"style="" >
        <li class="breadcrumb-item">
          <a href="#">Short term program</a>
        </li>
        
      </ol>
    <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">  
            <!--div class="modal-header" style="color: #FFF"><h4>Internship Form <br />Fellowship Program Application Annexure 1A </h4></div-->
            <div class="modal-body">
                <!-- We display the details entered by the user here -->
                <table class="table">
                  <thead>
                     
                  </thead>
                    <tr>
                        <th colspan="3">Name of the proposed training program</th>
                        <th colspan="3">Coordinator Name</th>
                         
                    </tr>
                    <tr>
                      <td id="name_proposed_training_programv" colspan="2"></td>
                        <td id="coordinator_namev" colspan="2"></td>
                        
                    </tr>
                    <tr>
                        <th colspan="3">Coordinator Mobile</th>
                        <th colspan="3">Coordinator Address</th>
                         
                    </tr>
                    <tr>
                        <td id="coordinator_mobilev" colspan="3"></td>
                        <td id="coordinator_addressv" colspan="3"></td>
                         
                    </tr>

                     <tr>
                        <th colspan="3">Background history of the Organization, Its activities in RE Development, especially capacity building</th>
                        <th colspan="3" >Technology area of the proposed training program</th>
                        
                        
                    </tr>
                    <tr>
                      <td id="history_organization_docv" colspan="3"></td>
                        <td id="technology_areav" colspan="3"></td>
                                               
                    </tr>
                    <tr><td id="other_re_areav" colspan="6"></td></tr>
                    <tr>
                        <th colspan="3">Objective of the Program </th>
                        <th  colspan="3">Target group to be addressed in proposed training program</th>
                         
                    </tr>
                    <tr >
                       <td id="objective_programv" colspan="3"></td>
                       <td id="target_groupv" colspan="3"></td>
                        
                    </tr>
                   
                    
                    
                     

                    <tr>
                        <th colspan="3">Geographical area of operation</th>
                        <th colspan="3">Assessment Skilled </th>                         
                    </tr>
                    <tr>
                        <td id="geographical_areav" colspan="3"></td>
                        <td id="assessment_skilledv" colspan="3"></td>                         
                    </tr>
                     
                    <tr>
                        <th colspan="3">Number of trainees proposed to be trained in one year (this should be based on assessment done in the area of operation)</th>
                        <th colspan="3">No. of training programmers proposed in one years</th>                         
                    </tr>
                    <tr>
                        <td id="no_student_trained_a_yearv" colspan="3"></td>
                        <td id="proposed_programme_a_yearv" colspan="3"></td>                         
                    </tr>


                    <tr>
                        <th colspan="3">Trainees proposed for batch/course/programmer</th>
                        <th colspan="3">Duration of the proposed course </th>                         
                    </tr>
                    <tr>
                        <td id="no_trainee_proposed_batchv" colspan="3"></td>
                        <td id="duration_proposed_coursev" colspan="3"></td>                         
                    </tr>

                    <tr>
                        <th colspan="6">Selection Criteria of trainees</th>
                                             
                    </tr>
                    <tr>
                        <td id="selection_criteriav" colspan="6"></td>
                                            
                    </tr>
                    <tr>
                        <th colspan="3">Faculty Name</th>
                        <th colspan="3">Faculty Designation </th>                         
                    </tr>
                    <tr>
                        <td id="faculty_namev" colspan="3"></td>
                        <td id="faculty_designationv" colspan="3"></td>                         
                    </tr>

                     <tr>
                        <th colspan="3"> Faculty Level </th>
                        <th colspan="3"> Infrastructure</th>                         
                    </tr>
                    <tr>
                        <td id="faculty_levelv" colspan="3"></td>
                        <td id="infrastructurev" colspan="3"></td>                         
                    </tr>
                    
                     <tr>
                        <th colspan="3">Methodology of imparting training</th>
                        <th colspan="3">Guest Faculty Doc</th>                         
                    </tr>
                    <tr>
                        <td id="methodology_imparting_trainingv" colspan="3"></td>
                        <td id="guest_faculty_docv" colspan="3"></td>                         
                    </tr>

                    <tr>
                        <th colspan="3">Content Letter doc</th>
                        <th colspan="3">Core Guest Percentage Time</th>                         
                    </tr>
                    <tr>
                        <td id="content_letter_docv" colspan="3"></td>
                        <td id="core_guest_percentage_timev" colspan="3"></td>                         
                    </tr>

                    <tr>
                        <th colspan="3">Tie up campus programmer</th>
                        <th colspan="3">Engaging trained programmer</th>                         
                    </tr>
                    <tr>
                        <td id="tieup_campus_programmerv" colspan="3"></td>
                        <td id="engaging_trained_programmerv" colspan="3"></td>                         
                    </tr>

                     <tr>
                        <th colspan="3">Fee charged traniees</th>
                        <th colspan="3">Anticipate impact</th>                         
                    </tr>
                    <tr>
                        <td id="fee_charged_tranieesv" colspan="3"></td>
                        <td id="anticipated_impactv" colspan="3"></td>                         
                    </tr>
                    <!-- <tr><th>Financial Proposal doc</th></tr>
                    <tr><td></td></tr> -->
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>  

            </div>
        </div>
 <style type="text/css">
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
label.error
{
  color:red;
  font-family:verdana, Helvetica;
}
 </style>
 <script type="text/javascript">
  function showfield(name){   
    //alert(name);guest_faculty_doc
  if(name == '9') {
    document.getElementById('other_re_area').innerHTML = ' <textarea name="other_re_area" id="other_re_area" class="form-control required"></textarea> @if ($errors->has("other_re_area"))<span class="help-block"><strong>{{ $errors->first("other_re_area") }}</strong></span> @endif';
  }else{
    document.getElementById('other_re_area').innerHTML='';
  }
}
  $( document ).ready(function() {


     $('#history_organization_doc').bind('change', function() {
        var a=(this.files[0].size);
      if(a > 5000000) {
        $('#highest_qulification').val('');
         $('#history_organization_doc_error').html('Maximum allowed size for file is "5MB" ');
         $('#history_organization_doc').css('color','red');
         return false;
      }else{
         $('#history_organization_doc').html('');
      };
      
      var fileExtension = ['pdf'];
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        $('#history_organization_doc_error').html('Only pdf files allow');
         $('#history_organization_doc_error').css('color','red');
         $('#history_organization_doc').val('');
         return false;
      }
    
  });

// -------------------------------------------------------------------//

 $('#course_material_doc').bind('change', function() {
        var a=(this.files[0].size);
      if(a > 5000000) {
        $('#course_material_doc').val('');
         $('#course_material_doc_error').html('Maximum allowed size for file is "5MB" ');
         $('#course_material_doc').css('color','red');
         return false;
      }else{
         $('#course_material_doc').html('');
      };
      
      var fileExtension = ['pdf'];
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        $('#course_material_doc_error').html('Only pdf files allow');
         $('#course_material_doc_error').css('color','red');
           $('#course_material_doc').val('');
         return false;
      }
    
  });


$('#guest_faculty_doc').bind('change', function() {
        var a=(this.files[0].size);
      if(a > 5000000) {
        $('#guest_faculty_doc').val('');
         $('#guest_faculty_doc_error').html('Maximum allowed size for file is "5MB" ');
         $('#guest_faculty_doc').css('color','red');
         return false;
      }else{
         $('#course_material_doc').html('');
      };
      
      var fileExtension = ['pdf'];
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        $('#guest_faculty_doc_error').html('Only pdf files allow');
         $('#guest_faculty_doc_error').css('color','red');
         $('#guest_faculty_doc').val('');
         return false;
      }
    
  });


$('#content_letter_doc').bind('change', function() {
        var a=(this.files[0].size);
      if(a > 5000000) {
        $('#content_letter_doc').val('');
         $('#content_letter_doc_error').html('Maximum allowed size for file is "5MB" ');
         $('#content_letter_doc').css('color','red');
         return false;
      }else{
         $('#content_letter_doc').html('');
      };
      
      var fileExtension = ['pdf'];
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        $('#content_letter_doc_error').html('Only pdf files allow');
         $('#content_letter_doc_error').css('color','red');
         $('#content_letter_doc').val('');
         return false;
      }
    
  });

$('#financial_proposal_doc').bind('change', function() {
        var a=(this.files[0].size);
      if(a > 5000000) {
        $('#financial_proposal_doc').val('');
         $('#financial_proposal_doc_error').html('Maximum allowed size for file is "5MB" ');
         $('#financial_proposal_doc_error').css('color','red');
         return false;
      }else{
         $('#financial_proposal_doc_error').html('');
      };
      
      var fileExtension = ['pdf'];
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        $('#financial_proposal_doc_error').html('Only pdf files allow');
         $('#financial_proposal_doc_error').css('color','red');
         $('#financial_proposal_doc').val('');
         return false;
      }
    
  });





//--------------------------------------------------------------------//     
    $("#shortterm").validate();
    $("#shortterm").validate({
      rules: {
        
        name_proposed_training_program: {
          required: true,           
        },
        coordinator_mobile:{
          required:true,
        },
        coordinator_address:{
          required:true,
        },
        anticipated_impact:{
          required:true,
        },
        objective_program:{
          required:true,
        },
        technology_area:{
          required:true
        },
        methodology_imparting_training:{
          required:true
        },
        history_organization_doc: {
          required:true,
           extension: "docx|rtf|doc|pdf"
        }
         
      },
      messages: {
        
        username: {
          name_proposed_training_program: "Field is required"          
        },
         resume:{
            history_organization_doc:"input type is required",                  
            extension:"select valid input file format"
        },
        
      }
    })
  })

 </script>
 <script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
           
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }


</script>

<script type="text/javascript">
  $('#submitBtn').click(function () {    
    $('#name_proposed_training_programv').html($('#name_proposed_training_program').val());
    $('#coordinator_namev').html($('#coordinator_name').val());
    $('#coordinator_mobilev').html($('#coordinator_mobile').val());
    $('#coordinator_addressv').html($('#coordinator_address').val());
    $('#history_organization_docv').html($('#history_organization_doc').val());
    $('#technology_areav').html($('#technology_area').val());
    $('#other_re_areav').html($('#other_re_area').val());

    $('#objective_programv').html($('#objective_program').val());
    $('#target_groupv').html($('#target_group').val());
    $('#geographical_areav').html($('#geographical_area').val());
    $('#assessment_skilledv').html($('#assessment_skilled').val());
    $('#no_student_trained_a_yearv').html($('#no_student_trained_a_year').val());
    $('#proposed_programme_a_yearv').html($('#proposed_programme_a_year').val());
    $('#no_trainee_proposed_batchv').html($('#no_trainee_proposed_batch').val());
    $('#duration_proposed_coursev').html($('#duration_proposed_course').val());
    $('#selection_criteriav').html($('#selection_criteria').val());
    $('#faculty_namev').html($('#faculty_name').val());
    $('#faculty_designationv').html($('#faculty_designation').val());
    $('#faculty_levelv').html($('#faculty_level').val());
    $('#infrastructurev').html($('#infrastructure').val());
    $('#methodology_imparting_trainingv').html($('#methodology_imparting_training').val());
    $('#course_material_docv').html($('#course_material_doc').val());
    $('#guest_faculty_docv').html($('#guest_faculty_doc').val());
    $('#content_letter_docv').html($('#content_letter_doc').val());

    $('#core_guest_percentage_timev').html($('#core_guest_percentage_time').val());
    $('#tieup_campus_programmerv').html($('#tieup_campus_programmer').val());
    $('#engaging_trained_programmerv').html($('#engaging_trained_programmer').val());
    $('#fee_charged_tranieesv').html($('#fee_charged_traniees').val());
    $('#anticipated_impactv').html($('#anticipated_impact').val());
    

});
</script>

@endsection
  
