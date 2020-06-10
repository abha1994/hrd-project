<?php

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

Route::group(['middleware' => ['auth']], function() {
	
Route::resource('nrest-home','shortterm\Admin\NresthomeController');

//***************Bank Details Start******************/ 
Route::resource('st-bank-details','shortterm\bankDetialController');
Route::get('api/st-get-student-adhaar-number','shortterm\bankDetialController@get_student_adhar');
Route::get('/st-bankMandateForm/{id}', 'shortterm\bankDetialController@index2')->name('/st-bankMandateForm');
Route::get('st-pdfview',array('as'=>'st-pdfview','uses'=>'shortterm\bankDetialController@pdfview_bank'));
Route::post('/st-bank-form-post-final/{id}', 'shortterm\bankDetialController@bank_form_post_final')->name('bank-form-post-final');

//***************Admin******************/ 
Route::get('/nrest-bankdetails', 'shortterm\Admin\NrestBankDetailsController@index');
Route::get('/nrest-bankdetails-show/{id}', 'shortterm\Admin\NrestBankDetailsController@show');
//***************Admin******************/ 

//***************Bank Details End******************/

//***************Student Start******************/

//***************Admin******************/
Route::resource('st-student-registration','shortterm\studentRegistrationController');

Route::get('/nrest-participants', 'shortterm\Admin\NrestParticipantsController@index');
Route::get('/nrest-participants-show/{id}', 'shortterm\Admin\NrestParticipantsController@show');
//***************Admin******************/

//***************Student End******************/


//***************Short Term Program Start******************/
Route::resource('short-term-program','shortterm\shortTermProgramController');
Route::get('pdfview/{id}',array('as'=>'pdfview','uses'=>'shortterm\shortTermProgramController@pdfview'));
Route::post('uploadsignature/{id}','shortterm\shortTermProgramController@uploadSignature');
Route::get('short-term-program-view/{id}','shortterm\shortTermProgramController@shorttermview');


//***************Short Term Program Admin******************/
Route::resource('short-term-application','shortterm\Admin\adminShortTermApplicationController'); 
Route::get('/pending-application','shortterm\Admin\adminShortTermApplicationController@pendingApplication')->name('pending-application');
Route::get('/consider-by-level1','shortterm\Admin\adminShortTermApplicationController@considerlvel1')->name('consider-by-level1');
Route::get('/consider-by-level1/{id}','shortterm\Admin\adminShortTermApplicationController@considerlvel1show');
Route::get('/nonconsider-by-level1','shortterm\Admin\adminShortTermApplicationController@nonconsiderlvel1')->name('nonconsider-by-level1');
Route::get('/nonconsider-by-level1/{id}','shortterm\Admin\adminShortTermApplicationController@nonconsiderlvel1show');
Route::get('/recommend-by-committe-short-term','shortterm\Admin\adminShortTermApplicationController@recommendByCommitte')->name('recommend-by-committe-short-term');
//------------------------------------------------------------------------------------// 
Route::post('/short-term-application-consider','shortterm\Admin\adminShortTermApplicationController@student_consider');
Route::get('/forward-to-committee-short-term','shortterm\Admin\adminShortTermApplicationController@forwardtocommittee')->name('forward-to-committee-short-term');
Route::get('/short-term-application-admin','recoment-committeeshortterm\adminShortTermApplicationController@consideradmin');
Route::get('/rejected-application','shortterm\Admin\adminShortTermApplicationController@rejectedApplication');
Route::get('/final-selecction','shortterm\Admin\adminShortTermApplicationController@finalselection')->name('final-selecction');
Route::get('/final-selection/{id}','shortterm\Admin\adminShortTermApplicationController@finalselectionview');
Route::get('/final-rejected','shortterm\Admin\adminShortTermApplicationController@rejected')->name('final-rejected');
Route::get('/final-rejected-view/{id}','shortterm\Admin\adminShortTermApplicationController@rejectedview');
Route::get('forward-committee/{id}','shortterm\Admin\adminShortTermApplicationController@considerNonconsider');
Route::get('recoment-committee/{id}','shortterm\Admin\adminShortTermApplicationController@committeerecoment');
Route::post('/short-term-application-selection','shortterm\Admin\adminShortTermApplicationController@student_selection');

//***************Short Term Program Admin******************/


//***************Short Term Program End******************/

Route::get('course-content','shortterm\courseUploadController@index');
Route::post('store_upload','shortterm\courseUploadController@store');

Route::get('admin-course-content','shortterm\Admin\courseUploadController@index');


//------------------------ Acknowlage Slip------------------------------------//

Route::get('/attandanceTerm', 'shortterm\Admin\AttandanceController@index')->name('/attandanceTerm');
Route::post('/getProgramAjax', 'shortterm\Admin\AttandanceController@getProgramAjax')->name('/getProgramAjax');
Route::post('/getattandanceTerm', 'shortterm\Admin\AttandanceController@getattandanceTerm')->name('/getattandanceTerm');

Route::get('/short_termAttandance', 'shortterm\AttendanceController@index')->name('/short_termAttandance');
Route::post('/short-term-attenPost', 'shortterm\AttendanceController@attendance_shortterm_post')->name('short-term-attenPost');
Route::get('/getshortTermAttandanceAjax', 'shortterm\AttendanceController@getAttandanceAjax')->name('/getshortTermAttandanceAjax');
Route::post('/getAttendanceAjaxnew', 'shortterm\AttendanceController@getAttandanceAjaxnew')->name('/getAttendanceAjaxnew');



//****************Report upload User*******************//
Route::resource('report-content','shortterm\UploadReportController');
Route::get('download-content/{content}', array(
    'as'    => 'download-content',
    'uses'  => 'shortterm\UploadReportController@download'
));

Route::post('/utilization-form-post', 'shortterm\UploadReportController@utilization_form_post')->name('utilization-form-post');
Route::post('/audited-form-post', 'shortterm\UploadReportController@audited_form_post')->name('audited-form-post');
Route::post('/program-form-post', 'shortterm\UploadReportController@program_form_post')->name('program-form-post');
Route::post('/training-form-post', 'shortterm\UploadReportController@training_form_post')->name('training-form-post');

//****************Report upload Admin*******************//
Route::resource('shortterm-report','shortterm\Admin\ReportController');
Route::post('/getadminshorttermreport', 'shortterm\Admin\ReportController@getadminshorttermreport')->name('/getadminshorttermreport');
//****************Report upload Admin*******************//
//****************Report upload *******************//

Route::get('/acknowledge_shortTerm', 'shortterm\AcknowledgeController@index')->name('/acknowledge_shortTerm');
Route::post('/acknowledge-shortTerm-post', 'shortterm\AcknowledgeController@acknowledge_short_post')->name('acknowledge-shortTerm-post');
Route::post('/acknowledgeShortAjax', 'shortterm\AcknowledgeController@acknowledgeshortAjax')->name('acknowledgeShortAjax');
Route::get('shortTermpdf',array('as'=>'shortTermpdf','uses'=>'shortterm\AcknowledgeController@shortTermpdf'));

// Acknoweldge admin short term
Route::get('/acknowledgeShortAdmin', 'shortterm\Admin\ShortTermAcknowledgeController@index')->name('/acknowledgeShortAdmin');
Route::post('/acknowledgeshortAjaxAdmin', 'shortterm\Admin\ShortTermAcknowledgeController@acknowledgeAjaxAdmin')->name('acknowledgeshortAjaxAdmin');



Route::post('/getadminparticipantdata','shortterm\Admin\NrestParticipantsController@getadminparticipantdata')->name('getadminparticipantdata');
Route::post('/getadminbankdata','shortterm\Admin\NrestBankDetailsController@getadminbankdata')->name('getadminbankdata');

Route::resource('report-check', 'shortterm\Admin\CheckfieldsController');

});


