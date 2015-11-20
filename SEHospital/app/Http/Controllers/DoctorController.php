<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('doctor.schedule_alt');
    }

    public function getPageDayOff()
    {
        return view('doctor.dayoff');
    }
    public function getCreatePrescription()
    {
        return view('doctor.createPrescription');
    }
    public function getCurrentPrescription()
    {
        return view('doctor.currentPrescription');
    }
    public function getPatientInfo()
    {
        return view('doctor.getPatientInfo');
    }
    public function postPatientInfo()
    {
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $patID = DB::table('patient')->where('pat_name', $firstname)
                                     ->where('pat_surname', $lastname)
                                     ->pluck('pat_id');
        if (is_null($patID)) {
            return view('doctor.getPatientInfo')->with([
                    'warning' => "ไม่มีผู้ป่วย $firstname $lastname ในระบบ"
                ]);
        }
        $patientInfo = DB::table('patient_Info')->where('pat_id', $patID)
                                                ->where('date_of_record', date("Y-m-d"))
                                                ->first();
        $allergys_id = DB::table('medicine_allergy')->where('pat_id', $patID)
                                                    ->select('med_id','allergy_desc')->get();
        $allergys = array();

        foreach($allergys_id as $allergy) {
            $allergy_med = DB::table('medicine')->where('med_id',$allergy->med_id)->first();
            $dict = array("id" => $allergy->med_id,
                          "name" => $allergy_med->med_name,
                          "description" => $allergy->allergy_desc);
            array_push($allergys, $dict);
        }  

        return view('officer.showPatientInfo')->with([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'weight' => $patientInfo->pat_weight,
                'height' => $patientInfo->pat_height,
                'temperature' => $patientInfo->pat_temperature,
                'bloodpressure' => $patientInfo->pat_bloodPressure,
                'heartrate' => $patientInfo->pat_heartRate,
                'allergys' => $allergys
            ]
        );
    }
}
