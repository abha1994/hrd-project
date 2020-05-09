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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('api/get-distic-list','Nref\studentRegistration\studentRegistrationController@getDisticList');
Route::get('contact/{id}','Auth\registerVerificationController@verify')->name('contact');
Route::get('/auth/regiserThank','Auth\registerVerificationController@thankyou');
Route::get('validateemail','Auth\registerVerificationController@validateemail');
Route::get('validatemobile','Auth\registerVerificationController@validatemobile');
Route::group(['middleware' => ['auth']], function() {
Route::resource('/roles','RoleController');
Route::resource('users','UserController');
Route::resource('products','ProductController');

// *************Pushkar**********************//
Route::get('/forgetusername', 'ForgetUsernameController@index')->name('forgetusername');
Route::post('/forgetusername-form-post','ForgetUsernameController@forgetusername_form')->name('forgetusername-form-post');

Route::get('/forgetpassword', 'ForgetPasswordController@index')->name('forgetpassword');
Route::post('/forgetpassword-form-post','ForgetPasswordController@forgetpassword_form')->name('forgetpassword-form-post');

Route::get('/changepassword', 'ChangePasswordController@index')->name('');
Route::post('/changepassword-post','ChangePasswordController@changepassword')->name('changepassword-post');
// *************Pushkar**********************//

// officer module  rule
		
Route::resource('user', 'adminUserController');
Route::get('changeStatus/{id}','adminUserController@statuChange');
	
Route::resource('link-officer', 'AdminLinkController');	

// Route::get('/link-officer', 'AdminLinkController@index')->name('link-officer');
// Route::get('/add-link-officer', 'AdminLinkController@add')->name('add-link-officer');
// Route::post('/create-link-officer', 'AdminLinkController@create')->name('create-link-officer');
// Route::get('/edit-link-officer/{id}', 'AdminLinkController@edit')->name('edit-link-officer');
// Route::post('/update-link-officer/{id}', 'AdminLinkController@update')->name('update-link-officer');
// Route::get('/view-link-officer/{id}', 'AdminLinkController@view')->name('view-link-officer');
// Route::get('/delete-link-officer/{id}', 'AdminLinkController@delete')->name('delete-link-officer');

// End of officer module rule
	
	
	

	
	
	
	
//------------Nref Scheme code 3--------------------->


Route::resource('student-registration','Nref\studentRegistrationController');
Route::get('validate_email','Nref\studentRegistrationController@validateEmail');
Route::get('validate_mobile','Nref\studentRegistrationController@validateMobile');

Route::get('/attendance', 'Nref\AttendanceController@index')->name('/attendance');
Route::get('/attendanceAjax', 'Nref\AttendanceController@attendanceAjax')->name('/attendanceAjax');
Route::post('/attendance-form-post', 'Nref\AttendanceController@attendance_form_post')->name('attendance-form-post');

Route::get('/acknowledge_slip', 'Nref\AcknowledgeController@index')->name('/acknowledge_slip');
Route::post('/acknowledge-form-post', 'Nref\AcknowledgeController@acknowledge_form_post')->name('acknowledge-form-post');
Route::post('/acknowledgeAjax', 'Nref\AcknowledgeController@acknowledgeAjax')->name('acknowledgeAjax');
Route::get('pdfdown',array('as'=>'pdfdown','uses'=>'Nref\AcknowledgeController@pdfdown'));

/* Yearly Progress Report By ROcky */

Route::get('/yearly_reportProgress', 'Nref\ProgressreportController@index')->name('/yearly_reportProgress');
Route::post('/progress-report-post', 'Nref\ProgressreportController@report_progress_post')->name('progress-report-post');

Route::get('/getReportAjax', 'Nref\ProgressreportController@getReportAjax')->name('/getReportAjax');
Route::post('/getReportAjaxnew', 'Nref\ProgressreportController@getReportAjaxnew')->name('/getReportAjaxnew');

/* Yearly Progress Report By ROcky */


Route::get('/institute', 'Nref\InstituteController@index')->name('/institute');
Route::post('/institute-form-post', 'Nref\InstituteController@institute_form_post')->name('institute-form-post');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'Nref\InstituteController@pdfview'));
Route::get('/preview', 'Nref\InstituteController@previewIndex')->name('/preview');
Route::post('/preview', 'Nref\InstituteController@preview')->name('preview');
Route::get('/institute_status/{id}', 'Nref\InstituteController@institute_status')->name('institute_status');
Route::post('/institute-form-post-final', 'Nref\InstituteController@institute_form_post_final')->name('institute-form-post-final');
	
//******************Admin**************************//	
Route::get('/nref-home', 'Nref\admin\NrefhomeController@index')->name('nref-home');
Route::get('/university', 'Nref\admin\UniversityController@index')->name('university');
Route::get('/edit-university/{id}', 'Nref\admin\UniversityController@edit')->name('edit-university');
Route::post('/update-university/{id}', 'Nref\admin\UniversityController@update')->name('update-university');
Route::get('/view-university/{id}', 'Nref\admin\UniversityController@view')->name('view-university');
Route::get('/delete-university/{id}', 'Nref\admin\UniversityController@delete')->name('delete-university');
Route::get('/final-university/{id}', 'Nref\admin\UniversityController@finalSubmit')->name('final-university');
Route::post('/final-university-submit/{id}', 'Nref\admin\UniversityController@updateFinalSubmit')->name('final-university-submit');
Route::get('pdfviewAdmin',array('as'=>'pdfviewAdmin','uses'=>'Nref\admin\UniversityController@pdfviewAdmin'));
Route::get('/universityCons', 'Nref\admin\UniversityController@index2')->name('universityCons');
Route::get('/universityConsAdmin', 'Nref\admin\UniversityController@index3')->name('universityConsAdmin');
Route::get('/universityNocons', 'Nref\admin\UniversityController@index4')->name('universityNocons');
Route::get('/universitySelected', 'Nref\admin\UniversityController@index5')->name('universitySelected');
Route::get('/final-selected-university/{id}', 'Nref\admin\UniversityController@final_selected_university')->name('final-selected-university');

Route::post('/api/admin-institute-considered', 'Nref\admin\UniversityController@institute_status_considered')->name('admin-institute-considered');


Route::get('/attendanceAdmin', 'Nref\admin\AttendanceController@index')->name('/attendanceAdmin');
Route::post('/attendanceAdmin-form-post', 'Nref\admin\AttendanceController@attendance_form_post')->name('attendanceAdmin-form-post');
Route::get('/attendanceAjaxadmin', 'Nref\admin\AttendanceController@attendanceAjax')->name('/attendanceAjaxadmin');

//******************Admin**************************//

 
//------------Nref Scheme code 3--------------------->
	
//------------Nres Scheme code 2--------------------->	


Route::get('/nres-home', 'Nres\admin\NreshomeController@index')->name('nres-home');
Route::resource('fellowship-solar-form','Nres\fellowship\fellowshipController');

Route::get('/attendance-solar-form', 'Nres\AttendanceController@index')->name('/attendance-solar-form');
Route::get('add_attendance', 'Nres\AttendanceController@add_attendance')->name('add_attendance');
Route::post('store', 'Nres\AttendanceController@store')->name('store');
Route::get('view_attendance/{id}', 'Nres\AttendanceController@show')->name('view_attendance');
Route::get('/attendanceStudentAjax', 'Nres\AttendanceController@attendanceStudentAjax')->name('/attendanceStudentAjax');

Route::resource('bank-details','Nres\bankDetialController');
Route::resource('bank-details-register','Nres\bankDetialController');
Route::get('bank-details-registers/{id}','Nres\bankDetialController@register');
	
//------------Nres Scheme code 2--------------------->	
	
	
//-------------Internship Student Scheme code 1----------------->	
Route::get('/internship', 'Internship\InternshipController@index')->name('');
Route::post('/internship-form-post', 'Internship\InternshipController@internship_form_post')->name('internship-form-post');
Route::get('/contact-us', 'Internship\InternshipController@contact_us')->name('contact-us');
Route::get('/who-is-eligible', 'Internship\InternshipController@who_is_eligible')->name('who-is-eligible');
Route::get('how-to-apply', 'Internship\InternshipController@how_to_apply')->name('how-to-apply');
Route::get('/internship-print', 'Internship\InternshipController@internship_form_print')->name('internship-print');
Route::get('/internship-guidelines', 'Internship\InternshipController@guidelines')->name('internship-guidelines');
Route::get('/intern-status/{id}', 'Internship\InternshipController@intern_status')->name('intern-status');

//-------------Admin Internship----------------->
	
Route::get('internship-home','Internship\Admin\InternhomeController@index');	
Route::get('admin-internship','Internship\Admin\AdminInternshipController@index');
Route::get('/admin-internship-view/{id}', 'Internship\Admin\AdminInternshipController@view')->name('admin-internship-view');
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