<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;

class PatientController extends Controller
{

    public function getPatientInfo()
    {
        return view('officer.patientInfo');
    }

    public function postPatientInfo()
    {
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $id = DB::table('patient')->where('pat_name', $firstname)
                                  ->where('pat_surname', $lastname) 
                                  ->pluck('pat_id');
        $weight = Input::get('weight');
        $height = Input::get('height');
        $temperature = Input::get('temperature');
        $bloodpressure = Input::get('bloodpressure');
        $heartrate = Input::get('heartrate');

        // session_start();
        // if (isset($_SESSION['id'])) {
        //     if ($_SESSION['role'] == "nurse")
        //     {
        //         $nurse_id = $_SESSION['id'];
        //         DB::table('patient_info')->insert([
        //             'pat_id' => $id,
        //             'pat_height' => $height,
        //             'pat_weight' => $weight,
        //             'pat_temperature' => $temperature,
        //             'pat_heartRate' => $heartrate,
        //             'pat_bloodPressure' => $bloodpressure,
        //             'nurse_id' => $nurse_id,
        //             'date_of_record' => date("Y-m-d")
        //         ]);
        //         session_write_close();
        //         return view('officer.showPatientInfo')->with([
        //             'firstname' => $firstname,
        //             'lastname' => $lastname,
        //             'weight' => $weight,
        //             'height' => $height,
        //             'temperature' => $temperature,
        //             'bloodpressure' => $bloodpressure,
        //             'heartrate' => $heartrate,
        //         ]); 
        //     }
        // }
        // session_write_close();
        // return "Must login as nurse first";
        DB::table('patient_info')->insert([
            'pat_id' => $id,
            'pat_height' => $height,
            'pat_weight' => $weight,
            'pat_temperature' => $temperature,
            'pat_heartRate' => $heartrate,
            'pat_bloodPressure' => $bloodpressure,
            'nurse_id' => '3',
            'date_of_record' => date("Y-m-d")
        ]);
        return view('officer.showPatientInfo')->with([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'weight' => $weight,
            'height' => $height,
            'temperature' => $temperature,
            'bloodpressure' => $bloodpressure,
            'heartrate' => $heartrate,
        ]);  
    }
}
