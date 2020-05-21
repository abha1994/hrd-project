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
	
	Route::get('nrest-home','shortterm\Admin\NresthomeController@index');
//**************Short Term Form*******************/
	Route::resource('short-term-program','shortterm\shortTermProgramController');
	Route::get('pdfview/{id}',array('as'=>'pdfview','uses'=>'shortterm\shortTermProgramController@pdfview'));
	Route::post('uploadsignature/{id}','shortterm\shortTermProgramController@uploadSignature');
	
	Route::resource('short-term-application','shortterm\Admin\adminShortTermApplicationController');
    Route::post('/short-term-application-consider','shortterm\Admin\adminShortTermApplicationController@student_consider');
	Route::get('/short-term-application-level1','shortterm\Admin\adminShortTermApplicationController@considerlvel1');
    Route::get('/short-term-application-admin','shortterm\Admin\adminShortTermApplicationController@consideradmin');
//************Short Term Form******************/

//***************Student Form******************/ 
   Route::resource('st-student-registration','shortterm\studentRegistrationController');
//**************Student Form**********************/

//************************Admin Student*******************//
Route::get('/nrest-participants', 'shortterm\Admin\NrestParticipantsController@index');
Route::get('/nrest-participants-show/{id}', 'shortterm\Admin\NrestParticipantsController@show');
//************************Admin Student*******************//


});

