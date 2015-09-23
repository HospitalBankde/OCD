<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/18/15 AD
 * Time: 1:40 AM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Response;

class AppointmentController extends Controller{

    public function getIndex() {
        return view('appointment.index');
    }

    public function getDoctorList($id) {
    	return  response()->json(['id',$id]);
    }
}