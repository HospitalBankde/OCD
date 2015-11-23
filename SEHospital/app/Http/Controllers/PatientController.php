<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medicine_Allergy;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;

class PatientController extends Controller
{

    public function getPageAddPatientInfo()
    {
        return view('officer.addPatientInfo');
    }

    public function postPatientInfo()
    {
        $json  = Input::get('senddata');
        $data  = json_decode($json,true);
        $allergys = $data['allergy'];
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $id = DB::table('patient')->where('pat_name', $firstname)
                                  ->where('pat_surname', $lastname) 
                                  ->pluck('pat_id');

        if(is_null($id)) {
            return view('officer.addPatientInfo')->with([
                'errorText' => 'ไม่พบชื่อ และ นามสกุลของผู้ป่วย: ' . $firstname . ' '. $lastname
                ]);
        }
        $weight = Input::get('weight');
        $height = Input::get('height');
        $temperature = Input::get('temperature');
        $bloodpressure = Input::get('bloodpressure');
        $heartrate = Input::get('heartrate');

        // $json  = Input::get('senddata');
        // $data  = json_decode($json,true);
        // $allergys = $data['allergy'];

        session_start();
        if (isset($_SESSION['id'])) {
            if ($_SESSION['role'] == "nurse")
            {
                $nurse_id = $_SESSION['id'];
                //delete previous one (update patient_info)
                DB::table('patient_info')->where('pat_id', '=', $id)
                                        ->where('date_of_record', '=', date("Y-m-d"))
                                        ->delete();
                DB::table('patient_info')->insert([
                    'pat_id' => $id,
                    'pat_height' => $height,
                    'pat_weight' => $weight,
                    'pat_temperature' => $temperature,
                    'pat_heartRate' => $heartrate,
                    'pat_bloodPressure' => $bloodpressure,
                    'nurse_id' => $nurse_id,
                    'date_of_record' => date("Y-m-d")
                ]);

                foreach ($allergys as $allergy) {
                 # code...
                    //delete previous one (update allergy_desc and date_of_record)
                    DB::table('medicine_allergy')->where('pat_id', '=', $id)
                                            ->where('med_id', '=', $allergy['id'])
                                            ->delete();
                    DB::table('medicine_allergy')->insert([
                    'pat_id' => $id,
                    'med_id' => $allergy['id'],
                    'allergy_desc' => $allergy['description'],
                    'date_of_record' => date("Y-m-d")
                    ]);
                }
                
                session_write_close();                
                return view('officer.showPatientInfo')->with([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'weight' => $weight,
                    'height' => $height,
                    'temperature' => $temperature,
                    'bloodpressure' => $bloodpressure,
                    'heartrate' => $heartrate,
                    'allergys' => $allergys
                ]); 
            }
        }
        session_write_close();
        return "Must login as nurse first";  
    }
}
