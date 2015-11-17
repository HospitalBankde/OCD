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

Route::get('/','HomeController@getIndex');


Route::get('appointment','AppointmentController@getIndex');
Route::get('appointment/time','AppointmentController@getPageTime');
Route::post('appointment/complete','AppointmentController@postApp');
Route::get('doctorList', 'AppointmentController@getDoctorList');
Route::get('doctorDay', 'AppointmentController@getDoctorDay');
Route::get('doctorTime', 'AppointmentController@getDoctorTime');


Route::get('register','HomeController@getPageRegister');
Route::post('/actionRegister','HomeController@postRegister');

Route::get('login','HomeController@getPageLogin');
Route::post('actionLogin','HomeController@postLogin');
Route::get('logout','HomeController@logout');

Route::get('patientInfo','PatientController@index');

Route::get('schedule','DoctorController@index');
Route::get('dayoff','DoctorController@getPageDayOff');
Route::get('createPrescription', 'DoctorController@getCreatePrescription');
Route::get('currentPrescription', 'DoctorController@getCurrentPrescription');



Route::get('test','TestSomethingController@getIndex');
Route::get('testdata', 'TestSomethingController@getTestData');
Route::post('justposttest','TestSomethingController@postTest');

