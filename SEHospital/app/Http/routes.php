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
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
// Profile

Route::get('dashboard/profile', 'LoginController@getPageProfile')->middleware('role:patient,doctor,nurse,pharmacist');
//XXXXXXXXX
//XXXXXXXXX
//==================BEGIN PATIENT==================
//Appointment
Route::get('appointment','AppointmentController@getIndex');
Route::get('appointment/time','AppointmentController@getPageTime')->middleware('role:patient');
Route::post('appointment/complete','AppointmentController@postApp')->middleware('role:patient');
Route::post('appointment/cancel', 'AppointmentController@patCancelApp');
Route::get('doctorList', 'AppointmentController@getDoctorList');
Route::get('doctorDay', 'AppointmentController@getDoctorDay');//->middleware('role:patient');
Route::get('doctorTime', 'AppointmentController@getDoctorTime')->middleware('role:patient');
Route::get('doctorScheduleDay', 'AppointmentController@getDoctorScheduleDay');

// Register
Route::get('register','HomeController@getPageRegister');
Route::post('/actionRegister','HomeController@postRegister');

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
//==================END PATIENT==================
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//==================BEGIN Patient Info==================
// For nurse to add and show result.
Route::get('dashboard/addPatientInfo','PatientController@getPageAddPatientInfo')->middleware('role:nurse');
Route::post('dashboard/postPatientInfo','PatientController@postPatientInfo')->middleware('role:nurse');

// For doctor to query and show?
Route::get('getPatientInfo','DoctorController@getPatientInfo')->middleware('role:doctor');
Route::post('postPatientInfo','DoctorController@postPatientInfo')->middleware('role:doctor');

//==================END Patient Info==================
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//==================BEGIN Doctor==================

 //Diagnosis
Route::get('dashboard/appointmentList', 'AppointmentController@getPageAppointmentList')->middleware('role:patient,doctor');
Route::get('dashboard/todayAppointmentList', 'AppointmentController@getPageAppointmentListForToday')->middleware('role:doctor');
Route::get('dashboard/todayAppointmentList/patientDiagnosis/{pat_id}/{app_id}', 'DoctorController@getPagePatientDiagnosis')->middleware('role:doctor');
 //Create Prescription
Route::get('dashboard/createPrescription/{pat_id}/{app_id}', 'DoctorController@getCreatePrescription')->middleware('role:doctor');
Route::post('dashboard/postPrescription','PrescriptionController@postCreatePrescription')->middleware('role:doctor');
Route::get('medicineList','PrescriptionController@getMedicineList');
 //Show Schedule
Route::get('dashboard/showSchedule', 'DoctorController@getPageDoctorSchedule')->middleware('role:doctor,nurse');

 //Day Off
Route::get('dashboard/dayoff','DoctorController@getPageDayOff')->middleware('role:doctor');
Route::post('dashboard/dayoff/postDayOff', 'DoctorController@postDayOff')->middleware('role:doctor');
//==================END Doctor==================
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//==================BEGIN Nurse==================

 //Add Schedule
Route::post('dashboard/actionAddSchedule', 'ScheduleController@postAddSchedule')->middleware('role:nurse');
Route::get('dashboard/addSchedule','ScheduleController@getPageAddSchedule')->middleware('role:nurse');
Route::get('getDoctorInformation','ScheduleController@getDoctorInformation')->middleware('role:nurse');
//==================END Nurse==================
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//==================BEGIN Pharmacist==================

//Current Prescription
Route::get('dashboard/currentPrescription', 'DoctorController@getCurrentPrescription')->middleware('role:pharmacist');
Route::get('dashboard/getPrescriptionDetail','PrescriptionController@getPrescriptionDetail')->middleware('role:pharmacist');
Route::get('dashboard/updatedPrescription','PrescriptionController@getUpdatedPrescription')->middleware('role:pharmacist');
Route::get('getPatientInformation', 'PrescriptionController@getPatientInformation');
Route::get('dashboard/getChangeStatus','PrescriptionController@getChangeStatus');
//==================END Pharmacist==================
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//XXXXXXXXX
//==================BEGIN OTHERS==================
Route::get('403', function() {
	return view('errors.errorText')->with([
		'text' => 'ท่านไม่มีสิทธิ์ทำรายการนี้'
		]);
});
//Test
Route::get('test','TestSomethingController@getIndex');
Route::get('testdata', 'TestSomethingController@getTestData');
Route::post('justposttest','TestSomethingController@postTest');
Route::get('sessionTestLaravel', 'TestSomethingController@sessionTestLaravel');
Route::get('sessionTestPHP', 'TestSomethingController@sessionTestPHP');
Route::get('sessionTestClose', 'TestSomethingController@sessionTestClose');
