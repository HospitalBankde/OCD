<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use App\Models\Doctor_Schedule;
use App\Http\Controllers\SessionManager;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
    public function postShowDoctorSchedule()
    {
        # code...
        $doc_id = Input::get('doc_id');
        //$doc_id = 11;
        $schedule = Doctor_Schedule::where('doc_id', '=', $doc_id)
                                    ->orderBy('weekday_id', 'ASC')
                                    ->get();

        // replace with readable day
        $DAY = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
        foreach ($schedule as $index => $day) {
            $day->weekday_id = $DAY[$index];
        }                                                            
        return view('doctor.schedule')->with([
            'schedule' => $schedule
            ]);                                
    }
    public function postPageAppointmentList()
    {
        # code...
        $doc_id = Input::get('doc_id');

        // get all apointments from now, for this patient
        $appointments = Appointment::where('doc_id','=',$doc_id)
                        ->where('app_date', '>', date("Y-m-d"))
                      //  ->select('doc_id', 'app_time', 'app_date')
                        ->orderBy('app_date', 'ASC') 
                        ->join('patient', 'patient.pat_id', '=', 'appointment.pat_id')                                                                                        
                        ->select('app_time', 'app_date', 'pat_name')
                        ->get();                    

        return view('appointment.appointmentList')->with([
                'appointments' => $appointments
            ]);
    }
    public function getPageDayOff() {
        $session_info = SessionManager::getSessionInfo();
        if ($session_info['role'] != 'doctor') {
            # code...
            return redirect('/403');
        } else {
            $date = Input::get('date');
            $doc_id = $session_info['id'];
            $description = Input::get('description');
            $cancels = DB::table('cancel_schedule')
                            ->where('doc_id' ,'=', $doc_id)
                            ->orderBy('cancel_date')
                            ->get();                            
            return view('doctor.dayoff')->with([
                    'cancels' => $cancels,
                    'doc_id' => $doc_id
                ]);
        }        
    }
    public function postDayOff() {
        $doc_id = Input::get('doc_id');
        $cancel_date = Input::get('date');
        $cancel_description = Input::get('description');
        $id = DB::table('cancel_schedule')->insertGetId([
                            'doc_id' => $doc_id,
                            'cancel_date' => $cancel_date,
                            'cancel_description' => $cancel_description                                
                        ]);
                        
        return view('doctor.completePostDayOff');
    }
}
