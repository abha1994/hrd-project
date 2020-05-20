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
//************Short Term Form******************/

//***************Student Form******************/ 
   Route::resource('st-student-registration','shortterm\studentRegistrationController');
//**************Student Form**********************/

//************************Admin Student*******************//
Route::get('/nrest-participants', 'shortterm\Admin\NrestParticipantsController@index');
Route::get('/nrest-participants-show/{id}', 'shortterm\Admin\NrestParticipantsController@show');
//************************Admin Student*******************//


});

