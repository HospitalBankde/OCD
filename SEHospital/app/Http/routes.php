<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Middleware is utility to help set before & after action of Route without
// manually insert codes in every Controllers.
//
//
// To Use:
// Route:: ... -> middleware('role:somerole'); to check whether user has that somerole.
// Current Roles Checking: patient, doctor, nurse
// Edit in App\Http\Middleware\RoleMiddleware.php
use App\Http\Controllers\SessionManager;

Route::get('/','HomeController@getIndex');

//Appointment
Route::get('appointment','AppointmentController@getIndex');
Route::get('appointment/time','AppointmentController@getPageTime')->middleware('role:patient');
Route::post('appointment/complete','AppointmentController@postApp')->middleware('role:patient');
Route::get('doctorList', 'AppointmentController@getDoctorList');
Route::get('doctorDay', 'AppointmentController@getDoctorDay');//->middleware('role:patient');
Route::get('doctorTime', 'AppointmentController@getDoctorTime')->middleware('role:patient');

Route::get('dashboard/appointmentList', 'AppointmentController@getPageAppointmentList')->middleware('role:patient,doctor');
Route::get('dashboard/todayAppointmentList', 'AppointmentController@getPageAppointmentListForToday')->middleware('role:doctor');
// Register
Route::get('register','HomeController@getPageRegister');
Route::post('/actionRegister','HomeController@postRegister');

// Login (All users login via LoginController@postLogin )
	// page	
	// Bug: who's already login, when manually enter /login url,
	// the sessions are gone, and he can enter this page, which shouldn't.
Route::get('login','HomeController@getPageLogin')->middleware('guest');
Route::get('loginOfficer','HomeController@getPageLoginOfficer');
	// action
Route::post('actionLogin','LoginController@postLogin');
Route::get('logout','LoginController@logout');

Route::get('dashboard', function() {
	$info = SessionManager::getSessionInfo();
	if(is_null($info)) {
		return redirect('/');
	}
	return view('home.dashboard')->with(SessionManager::getSessionInfo());
});

//Patient Info
Route::get('addPatientInfo','PatientController@getPatientInfo');//->middleware('role:nurse');
Route::post('showPatientInfo','PatientController@postPatientInfo');//->middleware('role:doctor');
Route::get('getPatientInfo','DoctorController@getPatientInfo');//->middleware('role:doctor');
Route::post('postPatientInfo','DoctorController@postPatientInfo');//->middleware('role:nurse');

//Schedule
// Route::get('schedule','DoctorController@index')->middleware('role:doctor');
Route::get('dashboard/dayoff','DoctorController@getPageDayOff')->middleware('role:doctor');
Route::post('dashboard/dayoff/postDayOff', 'DoctorController@postDayOff')->middleware('role:doctor');
Route::post('dashboard/showSchedule', 'DoctorController@postShowDoctorSchedule')->middleware('role:doctor');
//Prescription
Route::get('createPrescription', 'DoctorController@getCreatePrescription')->middleware('role:doctor');
Route::get('currentPrescription', 'DoctorController@getCurrentPrescription');


//Error
// Route::get('503', function() {
// 	return view('errors/503');
// });
Route::get('403', function() {
	return view('errors.errorText')->with([
		'text' => 'ท่านไม่มีสิทธิ์ทำรายการนี้'
		]);
});

//Test-----------------------------------------------------------------------------------------
Route::get('test','TestSomethingController@getIndex');
Route::get('testdata', 'TestSomethingController@getTestData');
Route::post('justposttest','TestSomethingController@postTest');
Route::get('sessionTestLaravel', 'TestSomethingController@sessionTestLaravel');
Route::get('sessionTestPHP', 'TestSomethingController@sessionTestPHP');
Route::get('sessionTestClose', 'TestSomethingController@sessionTestClose');
