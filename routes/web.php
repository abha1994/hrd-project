<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// *************Forget Password**********************//
Route::get('/forgetpassword', 'ForgetPasswordController@index')->name('forgetpassword');
Route::post('/forgetpassword-form-post','ForgetPasswordController@forgetpassword_form')->name('forgetpassword-form-post');

Route::post('/api/sendotp', 'ForgetPasswordController@sendotp')->name('sendotp');
// *************Forget Password**********************//

// ****************Forget Username*******************//
Route::get('/forgetuser', 'ForgetUserController@index')->name('forgetuser');
 Route::post('/forgetusername-form-post','ForgetUserController@forgetusername_form')->name('forgetusername-form-post');

Route::post('/api/sendotpfu', 'ForgetUserController@sendotpfu')->name('sendotpfu');
// ****************Forget Username*******************//

Route::get('/home', 'HomeController@index')->name('home');
Route::get('api/get-distic-list','Nref\studentRegistrationController@getDisticList');
Route::get('contact/{id}','Auth\registerVerificationController@verify')->name('contact');
Route::get('/auth/regiserThank','Auth\registerVerificationController@thankyou');
Route::get('validateemail','Auth\registerVerificationController@validateemail');
Route::get('validatemobile','Auth\registerVerificationController@validatemobile');
Route::group(['middleware' => ['auth']], function() {
Route::resource('/roles','RoleController');
Route::resource('users','UserController');
Route::resource('products','ProductController');
Route::resource('user', 'adminUserController');
Route::get('changeStatus/{id}','adminUserController@statuChange');
Route::resource('link-officer', 'AdminLinkController');	

Route::get('/changepassword', 'ChangePasswordController@index')->name('');
Route::post('/changepassword-post','ChangePasswordController@changepassword')->name('changepassword-post');

//-------------Fellow Amount----------------->	
Route::get('/fellowamount-list', 'FellowAmountController@index')->name('fellowamount');
Route::get('/add-fellowamount', 'FellowAmountController@add')->name('add-fellowamount');
Route::post('/create-fellowamount', 'FellowAmountController@create')->name('create-fellowamount');
Route::get('/delete-fellowamount/{id}', 'FellowAmountController@delete')->name('delete-fellowamount');
Route::get('/view-fellowamount/{id}', 'FellowAmountController@view')->name('view-fellowamount');
Route::get('/edit-fellowamount/{id}', 'FellowAmountController@edit')->name('edit-fellowamount');
Route::post('/update-fellowamount/{id}', 'FellowAmountController@update')->name('update-fellowamount');





		


// Route::get('/link-officer', 'AdminLinkController@index')->name('link-officer');
// Route::get('/add-link-officer', 'AdminLinkController@add')->name('add-link-officer');
// Route::post('/create-link-officer', 'AdminLinkController@create')->name('create-link-officer');
// Route::get('/edit-link-officer/{id}', 'AdminLinkController@edit')->name('edit-link-officer');
// Route::post('/update-link-officer/{id}', 'AdminLinkController@update')->name('update-link-officer');
// Route::get('/view-link-officer/{id}', 'AdminLinkController@view')->name('view-link-officer');
// Route::get('/delete-link-officer/{id}', 'AdminLinkController@delete')->name('delete-link-officer');

// End of officer module rule
	
	
	

	
	
	
	
//------------Nref Scheme code 3--------------------->


Route::get('/institute', 'Nref\InstituteController@index')->name('/institute');
Route::post('/institute-form-post', 'Nref\InstituteController@institute_form_post')->name('institute-form-post');
Route::get('pdfview_final',array('as'=>'pdfview_final','uses'=>'Nref\InstituteController@pdfview'));
Route::get('/preview', 'Nref\InstituteController@previewIndex')->name('/preview');
Route::post('/preview', 'Nref\InstituteController@preview')->name('preview');
Route::get('/institute_status/{id}', 'Nref\InstituteController@institute_status')->name('institute_status');
Route::get('/instituteFinal/{id}', 'Nref\InstituteController@index2')->name('/instituteFinal');
Route::post('/institute-form-post-final', 'Nref\InstituteController@institute_form_post_final')->name('institute-form-post-final');

Route::resource('student-registration','Nref\studentRegistrationController');
Route::get('student-registration/{id}/delete/','Nref\studentRegistrationController@delete');
Route::get('validate_email','Nref\studentRegistrationController@validateEmail');
Route::get('validate_mobile','Nref\studentRegistrationController@validateMobile');
Route::get('validate_aadhar','Nref\studentRegistrationController@validateAadhar');
Route::post('bankmandate-form-post','Nref\studentRegistrationController@bank_mandate_form');

Route::get('/attendance', 'Nref\AttendanceController@index')->name('/attendance');
Route::get('/attendanceAjax', 'Nref\AttendanceController@attendanceAjax')->name('/attendanceAjax');
Route::post('/attendance-form-post', 'Nref\AttendanceController@attendance_form_post')->name('attendance-form-post');

Route::get('/acknowledge_slip', 'Nref\AcknowledgeController@index')->name('/acknowledge_slip');
Route::post('/acknowledge-form-post', 'Nref\AcknowledgeController@acknowledge_form_post')->name('acknowledge-form-post');
Route::post('/acknowledgeAjax', 'Nref\AcknowledgeController@acknowledgeAjax')->name('acknowledgeAjax');
Route::get('pdfdown',array('as'=>'pdfdown','uses'=>'Nref\AcknowledgeController@pdfdown'));

Route::get('/yearly_reportProgress', 'Nref\ProgressreportController@index')->name('/yearly_reportProgress');
Route::post('/progress-report-post', 'Nref\ProgressreportController@report_progress_post')->name('progress-report-post');

Route::get('/getReportAjax', 'Nref\ProgressreportController@getReportAjax')->name('/getReportAjax');
Route::post('/getReportAjaxnew', 'Nref\ProgressreportController@getReportAjaxnew')->name('/getReportAjaxnew');


	

//****************Admin Student Panel*********************//


//************Admin Get ALL Student Start***********//
Route::get('get-institute','Nref\Admin\AdminStudentRegistrationController@getInstitute')->name('get-institute');
Route::post('get-institute','Nref\Admin\AdminStudentRegistrationController@getInstitute')->name('get-institute');
Route::get('get-institute/{id}','Nref\Admin\AdminStudentRegistrationController@getInstitutebyid');
Route::get('get-institute/{id}/{ids}','Nref\Admin\AdminStudentRegistrationController@show');
Route::get('get-institute/{id}/edit/{ids}','Nref\Admin\AdminStudentRegistrationController@edit');
Route::get('get-institute/{id}/delete/{ids}','Nref\Admin\AdminStudentRegistrationController@destroy');
//************Admin Get ALL Student End***********//

//************Get ALL Student Considered by level 1 Start***********//
Route::get('admin-student-considered','Nref\Admin\AdminStudentRegistrationController@considered_level_1')->name('admin-student-considered');
Route::post('admin-student-considered','Nref\Admin\AdminStudentRegistrationController@considered_level_1')->name('admin-student-considered');
Route::get('admin-student-considered/{id}','Nref\Admin\AdminStudentRegistrationController@considered_level_1_ins');
Route::get('admin-student-considered/{id}/{ids}','Nref\Admin\AdminStudentRegistrationController@consider_show');
Route::get('admin-student-considered/{id}/edit/{ids}','Nref\Admin\AdminStudentRegistrationController@edit');
Route::get('admin-student-considered/{id}/delete/{ids}','Nref\Admin\AdminStudentRegistrationController@considered_delete');
//************Get ALL Student Considered by level 1 End***********//

//************Get ALL Student rejected Start***********//
Route::get('admin-student-rejected','Nref\Admin\AdminStudentRegistrationController@rejected_student')->name('admin-student-rejected');
Route::post('admin-student-rejected','Nref\Admin\AdminStudentRegistrationController@rejected_student')->name('admin-student-rejected');
Route::get('admin-student-rejected/{id}','Nref\Admin\AdminStudentRegistrationController@reject_ins');
Route::get('admin-student-rejected/{id}/{ids}','Nref\Admin\AdminStudentRegistrationController@reject_show');
Route::get('admin-student-rejected/{id}/edit/{ids}','Nref\Admin\AdminStudentRegistrationController@edit');
Route::get('admin-student-rejected/{id}/delete/{ids}','Nref\Admin\AdminStudentRegistrationController@reject_delete');
//************Get ALL Student rejected End***********//

//************Get ALL Student forward to committe Start***********//
Route::get('admin-student-forward-to-committee','Nref\Admin\AdminStudentRegistrationController@forward_to_committee')->name('admin-student-forward-to-committee');
Route::post('admin-student-forward-to-committee','Nref\Admin\AdminStudentRegistrationController@forward_to_committee')->name('admin-student-forward-to-committee');
Route::get('admin-student-forward-to-committee/{id}','Nref\Admin\AdminStudentRegistrationController@forward_committee_ins');
Route::get('admin-student-forward-to-committee/{id}/{ids}','Nref\Admin\AdminStudentRegistrationController@committee_show');
Route::get('admin-student-forward-to-committee/{id}/edit/{ids}','Nref\Admin\AdminStudentRegistrationController@edit');
Route::get('admin-student-forward-to-committee/{id}/delete/{ids}','Nref\Admin\AdminStudentRegistrationController@committee_delete');
//************Get ALL Student forward to committe End***********//

//************Get ALL Student committee recommand Start
Route::get('admin-student-committee-rec','Nref\Admin\AdminStudentRegistrationController@committee_recom')->name('admin-student-final-selected');
Route::post('admin-student-committee-rec','Nref\Admin\AdminStudentRegistrationController@committee_recom')->name('admin-student-final-selected');
Route::get('admin-student-committee-rec/{id}','Nref\Admin\AdminStudentRegistrationController@committee_recom_ins');
Route::get('admin-student-committee-rec/{id}/{ids}','Nref\Admin\AdminStudentRegistrationController@committee_recom_show');
Route::get('admin-student-committee-rec/{id}/edit/{ids}','Nref\Admin\AdminStudentRegistrationController@edit');
Route::get('admin-student-committee-rec/{id}/delete/{ids}','Nref\Admin\AdminStudentRegistrationController@committee_recom_delete');
//************Get ALL Student committee recommand End

//************Get ALL Student Selecetd by committe Start
Route::get('admin-student-final-selected','Nref\Admin\AdminStudentRegistrationController@final_selected')->name('admin-student-final-selected');
Route::post('admin-student-final-selected','Nref\Admin\AdminStudentRegistrationController@final_selected')->name('admin-student-final-selected');
Route::get('admin-student-final-selected/{id}','Nref\Admin\AdminStudentRegistrationController@final_selected_ins');
Route::get('admin-student-final-selected/{id}/{ids}','Nref\Admin\AdminStudentRegistrationController@final_selected_show');
Route::get('admin-student-final-selected/{id}/edit/{ids}','Nref\Admin\AdminStudentRegistrationController@edit');
Route::get('admin-student-final-selected/{id}/delete/{ids}','Nref\Admin\AdminStudentRegistrationController@final_selecte_delete');
//************Get ALL Student Selecetd by committe End

//************Get ALL Student Rejected by committe STart
Route::get('admin-student-final-rejected','Nref\Admin\AdminStudentRegistrationController@final_rejected')->name('admin-student-final-rejected');
Route::post('admin-student-final-rejected','Nref\Admin\AdminStudentRegistrationController@final_rejected')->name('admin-student-final-rejected');
Route::get('admin-student-final-rejected/{id}','Nref\Admin\AdminStudentRegistrationController@final_rejected_ins');
Route::get('admin-student-final-rejected/{id}/{ids}','Nref\Admin\AdminStudentRegistrationController@final_rejected_show');
Route::get('admin-student-final-rejected/{id}/edit/{ids}','Nref\Admin\AdminStudentRegistrationController@edit');
Route::get('admin-student-final-rejected/{id}/delete/{ids}','Nref\Admin\AdminStudentRegistrationController@final_reject_delete');
//************Get ALL Student Rejected by committe End


Route::post('registerd-student-update/{id}','Nref\Admin\AdminStudentRegistrationController@update');
Route::post('/consider','Nref\Admin\AdminStudentRegistrationController@consider');
Route::post('/nonconsider','Nref\Admin\AdminStudentRegistrationController@nonConsider');

//****************Admin Student Panel*********************//


//******************Admin Intitute**************************//	
Route::get('/nref-home', 'Nref\Admin\NrefhomeController@index')->name('nref-home');
Route::get('/university', 'Nref\Admin\UniversityController@index')->name('university');
Route::get('/edit-university/{id}', 'Nref\Admin\UniversityController@edit')->name('edit-university');
Route::post('/update-university/{id}', 'Nref\Admin\UniversityController@update')->name('update-university');
Route::get('/view-university/{id}', 'Nref\Admin\UniversityController@view')->name('view-university');
Route::get('/delete-university/{id}', 'Nref\Admin\UniversityController@delete')->name('delete-university');
Route::get('/final-university/{id}', 'Nref\Admin\UniversityController@finalSubmit')->name('final-university');
Route::post('/final-university-submit/{id}', 'Nref\Admin\UniversityController@updateFinalSubmit')->name('final-university-submit');
Route::get('pdfviewAdmin',array('as'=>'pdfviewAdmin','uses'=>'Nref\Admin\UniversityController@pdfviewAdmin'));
Route::get('/universityCons', 'Nref\Admin\UniversityController@index2')->name('universityCons');
Route::get('/universityConsAdmin', 'Nref\Admin\UniversityController@index3')->name('universityConsAdmin');
Route::get('/universityNocons', 'Nref\Admin\UniversityController@index4')->name('universityNocons');
Route::get('/universitySelected', 'Nref\Admin\UniversityController@index5')->name('universitySelected');
Route::get('/final-selected-university/{id}', 'Nref\Admin\UniversityController@final_selected_university')->name('final-selected-university');
Route::post('/api/admin-institute-considered', 'Nref\Admin\UniversityController@institute_status_considered')->name('admin-institute-considered');
Route::post('/api/admin-institute-selected', 'Nref\Admin\UniversityController@institute_status_selected')->name('admin-institute-selected');

Route::get('/universityFinalReject', 'Nref\Admin\UniversityController@index6')->name('universityFinalReject');

Route::get('/universityFinalSelected', 'Nref\Admin\UniversityController@index7')->name('universityFinalSelected');

Route::get('/view-frwdCommite/{id}', 'Nref\Admin\UniversityController@view_frwdCommite')->name('view-frwdCommite');

Route::get('/view-recommendCommite/{id}', 'Nref\Admin\UniversityController@view_recommendCommite')->name('view-recommendCommite');

Route::post('/recommendInstituteAjax', 'Nref\Admin\UniversityController@recommendInstituteAjax')->name('recommendInstituteAjax');

Route::post('/finalrejectInstituteAjax', 'Nref\Admin\UniversityController@finalrejectInstituteAjax')->name('finalrejectInstituteAjax');

Route::get('/view-Pendinguniversity/{id}', 'Nref\Admin\UniversityController@viewPendingUniversity')->name('view-Pendinguniversity');

Route::get('/view-level1university/{id}', 'Nref\Admin\UniversityController@viewlvl1University')->name('view-level1university');

Route::get('/view-rejctlist/{id}', 'Nref\Admin\UniversityController@viewrejectUniversity')->name('view-rejctlist');


Route::post('/pendingInstituteAjax', 'Nref\Admin\UniversityController@pendingInstituteAjax')->name('pendingInstituteAjax'); 
Route::post('/considerInstituteAjax', 'Nref\Admin\UniversityController@considerInstituteAjax')->name('considerInstituteAjax');
Route::post('/nonconsiderInstituteAjax', 'Nref\Admin\UniversityController@nonconsiderInstituteAjax')->name('nonconsiderInstituteAjax');
Route::post('/frwdCommiteInstituteAjax', 'Nref\Admin\UniversityController@frwdCommiteInstituteAjax')->name('frwdCommiteInstituteAjax');
Route::post('/selectedInstituteAjax', 'Nref\Admin\UniversityController@selectedInstituteAjax')->name('selectedInstituteAjax');
Route::post('/exportPdf', 'Nref\Admin\UniversityController@exportPdf')->name('exportPdf');

//******************Admin Intitute**************************//	


Route::get('/acknowledgeAdmin', 'Nref\Admin\AcknowledgeController@index')->name('/acknowledgeAdmin');
Route::post('/acknowledgeAjaxAdmin', 'Nref\Admin\AcknowledgeController@acknowledgeAjaxAdmin')->name('acknowledgeAjaxAdmin');

Route::get('/progressReport', 'Nref\Admin\ProgressreportController@index')->name('/progressReport');
Route::post('/getReportAdminAjaxnew', 'Nref\Admin\ProgressreportController@getReportAdminAjaxnew')->name('/getReportAdminAjaxnew');

Route::get('/attendanceAdmin', 'Nref\Admin\AttendanceController@index')->name('/attendanceAdmin');
Route::post('/attendanceAdmin-form-post', 'Nref\Admin\AttendanceController@attendance_form_post')->name('attendanceAdmin-form-post');
Route::get('/attendanceAjaxadmin', 'Nref\Admin\AttendanceController@attendanceAjax')->name('/attendanceAjaxadmin');

Route::resource('fund-transfer','Nref\Admin\fincaceController');
Route::resource('application-processed','Nref\Admin\applicationProcessedController');
Route::get('export-application','Nref\Admin\applicationProcessedController@exportcsv');

//******************Admin**************************//

 
//------------Nref Scheme code 3--------------------->
	

	
	




//------------Nres Scheme code 2--------------------->	
Route::get('/nres-home', 'Nres\Admin\NreshomeController@index')->name('nres-home');
Route::resource('fellowship-solar-form','Nres\fellowship\fellowshipController');

Route::get('/attendance-solar-form', 'Nres\AttendanceController@index')->name('/attendance-solar-form');
Route::get('add_attendance', 'Nres\AttendanceController@add_attendance')->name('add_attendance');
Route::post('store', 'Nres\AttendanceController@store')->name('store');
Route::get('view_attendance/{id}', 'Nres\AttendanceController@show')->name('view_attendance');
Route::get('/attendanceStudentAjax', 'Nres\AttendanceController@attendanceStudentAjax')->name('/attendanceStudentAjax');

Route::resource('bank-details','Nres\bankDetialController');
Route::resource('bank-details-register','Nres\bankDetialController');
Route::get('bank-details-registers/{id}','Nres\bankDetialController@register');
Route::get('api/get-student-adhaar-number','Nres\bankDetialController@get_student_adhar');
Route::get('/bankMandateForm/{id}', 'Nres\bankDetialController@index2')->name('/bankMandateForm');
Route::post('/bank-form-post-final/{id}', 'Nres\bankDetialController@bank_form_post_final')->name('bank-form-post-final');

Route::get('pdfview_bank',array('as'=>'pdfview_bank','uses'=>'Nres\bankDetialController@pdfview'));

//------------Nres Scheme code 2--------------------->	


//-------------Internship Scheme code 1----------------->	
Route::get('/internship', 'Internship\InternshipController@index')->name('');
Route::post('/internship-form-post', 'Internship\InternshipController@internship_form_post')->name('internship-form-post');
Route::get('/contact-us', 'Internship\InternshipController@contact_us')->name('contact-us');
Route::get('/who-is-eligible', 'Internship\InternshipController@who_is_eligible')->name('who-is-eligible');
Route::get('how-to-apply', 'Internship\InternshipController@how_to_apply')->name('how-to-apply');
Route::get('/internship-print', 'Internship\InternshipController@internship_form_print')->name('internship-print');
Route::get('/internship-guidelines', 'Internship\InternshipController@guidelines')->name('internship-guidelines');
Route::get('/intern-status/{id}', 'Internship\InternshipController@intern_status')->name('intern-status');

//-------------Admin Internship----------------->
	
Route::get('internship-home','Internship\Admin\@index');	
Route::get('admin-internship','Internship\Admin\AdminInternshipController@index');
Route::get('/admin-internship-view/{id}', 'Internship\Admin\AdminInternshipController@view')->name(InternhomeController'admin-internship-view');
Route::get('/admin-internship-edit/{id}', 'Internship\Admin\AdminInternshipController@edit')->name('admin-internship-edit');
Route::post('/admin-internship-update/{id}', 'Internship\Admin\AdminInternshipController@update')->name('admin-internship-update');
Route::get('/admin-internship-delete/{id}', 'Internship\Admin\AdminInternshipController@delete')->name('admin-internship-delete');
Route::get('/status-considered/{status}/{candidate_id}', 'Internship\Admin\AdminInternshipController@status_considered')->name('status-considered');

Route::post('api/admin-internship-considered', 'Internship\Admin\AdminInternshipController@internship_status_considered')->name('admin-internship-considered');

Route::post('/export', 'Internship\Admin\AdminInternshipController@export')->name('export');
Route::post('/export-pdf', 'Internship\Admin\AdminInternshipController@printpdf')->name('export-pdf');

Route::get('/rejected-internship', 'Internship\Admin\AdminInternshipController@rejected_internship')->name('rejected-internship');
Route::get('/considered-internship', 'Internship\Admin\AdminInternshipController@considered_level_1')->name('considered-internship');
Route::get('/forward-to-committee', 'Internship\Admin\AdminInternshipController@forword_to_committee')->name('forward-to-committee');
Route::get('/selected-internship', 'Internship\Admin\AdminInternshipController@selected_internship')->name('selected-internship');
Route::get('/selected-candidate/{id}', 'Internship\Admin\AdminInternshipController@selected_candidate')->name('selected-candidate');
//-------------Admin Internship----------------->
//-------------Internship Student Scheme code 1----------------->	
Route::post('/session-menu', 'HomeController@session_menu')->name('session-menu');		
});