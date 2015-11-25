<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use App\Models\Doctor_Schedule;
use App\Models\Appointment;
use App\Http\Controllers\SessionManager;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCreatePrescription($pat_id, $app_id)
    {
        $patient = DB::table('patient')->where('pat_id', '=', $pat_id)
                                        ->select('pat_id', 'pat_name', 'pat_surname')                                        
                                        ->first();     
        if (is_null($patient)) {
            return 'Error: no patient with id = ' . $pat_id;
        }   
        return view('doctor.createPrescription')->with([
                'pat_id' => $patient->pat_id,
                'pat_name' => $patient->pat_name,
                'pat_surname' => $patient->pat_surname,
                'app_id' => $app_id
            ]);
    }
    public function getCurrentPrescription()
    {
        return view('doctor.currentPrescription');
    }

    // For nurse to search and edit?
    // Doctor doesn't have to use this.
    public function getPatientInfo()
    {
        return view('doctor.searchPatientInfo');
    }

    // Doctor diagnoses patient
    public function getPagePatientDiagnosis($pat_id, $app_id) {

        $patient = DB::table('patient')->where('pat_id', '=', $pat_id)
                                        ->select('pat_id', 'pat_name', 'pat_surname')                                        
                                        ->first();     
        if (is_null($patient)) {
               return 'Error: no patient with id = ' . $pat_id;
           }   
        $firstname = $patient->pat_name;
        $lastname = $patient->pat_surname;
        $patientInfo = DB::table('patient_Info')->where('pat_id', $pat_id)
                                                ->where('date_of_record', date("Y-m-d"))
                                                ->first();
        if (is_null($patientInfo)) {
               return view('doctor.patientDiagnosis')->with([
                'firstname' => $firstname,
                'lastname' => $lastname
                ]);
           }   
        $allergys_id = DB::table('medicine_allergy')->where('pat_id', $pat_id)
                                                    ->select('med_id','allergy_desc')->get();
        $allergys = array();        

        foreach($allergys_id as $allergy) {
            $allergy_med = DB::table('medicine')->where('med_id',$allergy->med_id)->first();
            $dict = array("id" => $allergy->med_id,
                          "name" => $allergy_med->med_name,
                          "description" => $allergy->allergy_desc);
            array_push($allergys, $dict);
        }
        return view('doctor.patientDiagnosis')->with([
                'pat_id' => $pat_id,
                'app_id' => $app_id,
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

    public function postPatientInfo()
    {
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $patID = DB::table('patient')->where('pat_name', $firstname)
                                     ->where('pat_surname', $lastname)
                                     ->pluck('pat_id');
        if (is_null($patID)) {
            return view('doctor.searchPatientInfo')->with([
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
    public function getPageDoctorSchedule()
    {
        # code...        
        $session_info = SessionManager::getSessionInfo();
        if (!isset($session_info['id'])) {
            # code...
            return redirect('/403');
        }
        $doc_id = $session_info['id'];
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

        $check = DB::table('cancel_schedule')
                        ->where('doc_id', '=', $doc_id)
                        ->where('cancel_date', '=', $cancel_date)
                        ->first();
        if (!is_null($check)) {
            # code...
            return view('errors.errorText')->with([
                'text' => 'ท่านได้ลาพักในวันที่ ' . $cancel_date . ' ไปแล้ว'
                ]);
        }

        $id = DB::table('cancel_schedule')->insertGetId([
                            'doc_id' => $doc_id,
                            'cancel_date' => $cancel_date,
                            'cancel_desc' => $cancel_description                                
                        ]);
        $cancelList = Appointment::where('appointment.app_date', '=', $cancel_date)
                                ->where('appointment.doc_id', '=', $doc_id)
                                ->join('patient','patient.pat_id','=','appointment.pat_id')
                                ->orderBy('appointment.date_of_record', 'ASC')
                                ->orderBy('appointment.app_time', 'DESC') //because morning vs afternoon
                                ->orderBy('patient.pat_name', 'ASC')
                                ->select('appointment.app_id','patient.pat_id','patient.pat_name','patient.pat_surname','appointment.app_time','appointment.date_of_record','patient.pat_tel')
                                ->get();

        foreach ($cancelList as $cancelPat) {
            MailController::appointmentCancelMail($cancelPat->app_id);
        }

        DB::table('appointment')->where('app_date', '=', $cancel_date)
                                ->where('doc_id', '=', $doc_id)
                                ->delete();
                        
        return view('doctor.completePostDayOff')->with([
                'cancel_date' => $cancel_date,
                'cancelList' => $cancelList
            ]);
    }
}
