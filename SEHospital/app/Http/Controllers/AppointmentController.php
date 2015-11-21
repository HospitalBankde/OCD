<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/18/15 AD
 * Time: 1:40 AM
 */

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Doctor_Schedule;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SessionManager;

class AppointmentController extends Controller {

    public function getIndex() {                
        $deps = DB::select('SELECT dep_name, dep_id FROM department');
        return view('appointment.index')->with([
                'deps' => $deps
            ]
        );
    }

    public function getPageTime() {
        $select_dep = Input::get('select_dep');
        if ($select_dep == null || $select_dep == "" || $select_dep === "-1") {
            return 'No dep_id sent';
        }

        $select_doc = Input::get('select_doc');
        if ($select_doc >= 0)
        {
            $doctor = Doctor::where('doc_id','=',$select_doc)
                            ->select('doc_name','doc_surname')->first();
            $doc_name = $doctor->doc_name;
            $doc_surname = $doctor->doc_surname;
        }
        else if ($select_doc == -1)
        {
            $doc_name = "Any doctor";
            $doc_surname = "";
        }

        return view('appointment.time')->with([
                'select_doc' => $select_doc,
                'select_dep' => $select_dep,
                'doc_name' => $doc_name,
                'doc_surname' => $doc_surname,
            ]
        );
    }

    function getSpecificDoctorDay($select_doc) {
        $availday = array();
        $today = getdate();
        $todayDate = $today['mday'];
        $todayWeekday = date('N', strtotime($today['weekday']) ) % 7;
        $nextMonth = date('Y-m-d', strtotime("+31 days"));
        $doctor = Doctor::where('doc_id','=',$select_doc)
                        ->select('doc_name','doc_surname')->first();
        $doc_schedule = Doctor_Schedule::where('doc_id','=', $select_doc)
                        ->select('weekday_id','morning','afternoon')
                        ->orderBy('weekday_id', 'asc')
                        ->get();

        //if doc_schedule error
        if ( ! isset($doc_schedule[6])) {
            return $availday;
        }

        //Gather all date that is full (>=30)
        $appointmentFull = Appointment::where('doc_id','=', $select_doc)
                        ->where('app_date','>', date("Y-m-d") )
                        ->where('app_date','<', $nextMonth)
                        ->select(DB::raw('count(*) as count, app_date'))
                        ->groupBy('app_date')
                        ->having('count', '>=', 15)
                        ->get();

        for ($i = 0; $i < 31; $i++) {
            $tempDate = $todayDate + $i;
            $tempWeekday = ($todayWeekday + $i) % 7;

            $availcheck = 1;
            if ($doc_schedule[$tempWeekday]->morning == 0 && $doc_schedule[$tempWeekday]->afternoon == 0) {
                array_push($availday, 0);
                $availcheck = 0;
                continue;
            }

            //If that day is full (>=30)
            foreach ($appointmentFull as $eachFull) {
                $tempDate2 = explode("-", $eachFull->app_date);
                if ($tempDate2[2] == $tempDate) {
                    if ($eachFull->count >= ($doc_schedule[$tempWeekday]->morning + $doc_schedule[$tempWeekday]->afternoon)*15)
                    {
                        array_push($availday, 0);
                        $availcheck = 0;
                        break;
                    }
                }
            }

            if ($availcheck == 1) {
                array_push($availday, 1);
            }
        }
        return $availday;
    }

    public function getDoctorDay() {
        $select_doc = Input::get('select_doc');

        $availday = array(0,0,0,0,0,0,0,0,0,0,
                        0,0,0,0,0,0,0,0,0,0,
                        0,0,0,0,0,0,0,0,0,0);

        //Specific doctor
        if ($select_doc >= 0)
        {
            return response()->json(['availday' => $this->getSpecificDoctorDay($select_doc)]);
        }
        //Any doctor
        else if ($select_doc == -1)
        {
            $select_dep = Input::get('select_dep');
            $doctors = Doctor::where('dep_id','=',$select_dep)
                            ->select('doc_id')->get();

            foreach ($doctors as $doctor)
            {
                $doc_availday = $this->getSpecificDoctorDay($doctor->doc_id);
                $index = 0;
                while ($index < 30)
                {
                    $availday[$index] = $availday[$index] | $doc_availday[$index];
                    $index++;
                }
            }
            return response()->json(['availday' => $availday]);
        }
    }

    function getSpecificDoctorTime($select_doc, $select_date) {
        $date = date("j-m-Y", strtotime($select_date)); 
        $weekday = date("w", strtotime($date));
        $availtime = array();

        $doc_schedule = Doctor_Schedule::where('doc_id','=', $select_doc)
                        ->where('weekday_id','=', $weekday)
                        ->select('morning','afternoon')
                        ->first();

        //Check if that time is full (>=15)
        $dateSplit = explode("/", $select_date);
        $dateSQL = $dateSplit[2] . "-" . $dateSplit[0] . "-". $dateSplit[1];
        $nextMonth = date('Y-m-d', strtotime("+31 days"));
        $appointment = Appointment::where('doc_id','=', $select_doc)
                ->where('app_date','=', $dateSQL)
                ->select(DB::raw('count(*) as count, app_date, app_time'))
                ->groupBy('app_date', 'app_time')
                ->having('count', '>=', 15)
                ->get();
        //$appointment will only have 2 length -> one morning and one afternoon
        foreach ($appointment as $eachApp) {
            if ($eachApp->app_time == "morning") $doc_schedule->morning = 0;
            if ($eachApp->app_time == "afternoon") $doc_schedule->afternoon = 0;
        }
        return $doc_schedule;
    }

    public function getDoctorTime() {
        $select_doc = Input::get('select_doc');
        $select_date = Input::get('select_date');
        
        if ($select_doc >= 0)
        {
            return response()->json(['doc_schedule' => $this->getSpecificDoctorTime($select_doc,$select_date)]);
        }
        else if ($select_doc == -1)
        {
            $select_dep = Input::get('select_dep');
            $doctors = Doctor::where('dep_id','=',$select_dep)
                            ->select('doc_id')->get();
            $doc_schedule = array('morning' => 0,
                                'afternoon' => 0);

            foreach ($doctors as $doctor)
            {
                $doc_availtime = $this->getSpecificDoctorTime($doctor->doc_id,$select_date);
                $doc_schedule['morning'] = $doc_schedule['morning'] | $doc_availtime['morning'];
                $doc_schedule['afternoon'] = $doc_schedule['afternoon'] | $doc_availtime['afternoon'];
            }
            return response()->json(['doc_schedule' => $doc_schedule]);
        }
    }

    public function getDoctorList() {
        $dep_id = Input::get('dep_id');
        if(isset($dep_id)){
            $doctors = Doctor::where('dep_id','=',$dep_id)->select('doc_id','doc_name','doc_surname')->get();
            $docs = array();

            foreach($doctors as $doctor ) {
                $doc_info = [
                    'doc_id' => $doctor->doc_id,
                    'doc_name' => $doctor->doc_name,
                    'doc_surname' => $doctor->doc_surname];
                array_push($docs, $doc_info);
            }

            return  response()->json(['doctor_list' => $docs ]);
        }
        return 'No dep_id sent.';
    }

    public function postApp() {
        //Assume that client is innocent and never inject the post request/javascript file
        //Security here is beyond worst, you know what I mean
        //Performance on "any doctor" is really bad, just ignore it plz :D
        $select_doc = Input::get('select_doc');
        $select_dep = Input::get('select_dep');
        $select_date = Input::get('select_date');
        $select_time = Input::get('select_time');
        $time = "";
        if ($select_time == "1") $time = "morning";
        else if ($select_time == "2") $time = "afternoon";

        $dateSplit = explode("/", $select_date);
        $dateSQL = $dateSplit[2] . "-" . $dateSplit[0] . "-". $dateSplit[1];

        session_start();
        if (isset($_SESSION['id'])) {
            if ($_SESSION['role'] == "patient")
            {
                $pat_id = $_SESSION['id'];
                if ($select_doc >= 0)
                {
                    $id = DB::table('appointment')->insertGetId([
                        'doc_id' => $select_doc,
                        'pat_id' => $pat_id,
                        'app_time' => $time,
                        'app_date' => $dateSQL,
                        'date_of_record' => date("Y-m-d")
                    ]);
                }
                else if ($select_doc == -1)
                {
                    $tempDate = date("j-m-Y", strtotime($select_date)); 
                    $weekday = date("w", strtotime($tempDate));

                    $appointments = Appointment::where('app_date','=', $dateSQL)
                                    ->where('app_time', '=', $time)
                                    ->select(DB::raw('count(*) as count, doc_id'))
                                    ->groupBy('doc_id')
                                    ->having('count', '>=', 15)
                                    ->get();

                    $fulldoc = array();
                    foreach ($appointments as $appointment)
                    {
                        array_push($fulldoc, $appointment->doc_id);
                    }

                    $doctors = Doctor_Schedule::whereNotIn('doctor_schedule.doc_id',$fulldoc)
                                    ->where('weekday_id','=',$weekday)
                                    ->where($time, '=', 1)
                                    ->join('doctor','doctor_schedule.doc_id','=','doctor.doc_id')
                                    ->where('doctor.dep_id','=',$select_dep)
                                    ->select('doctor.doc_id')
                                    ->get();

                    if (count($doctors) == 0) return "All doctors are full, sry";

                    //Select random doctor and put in database
                    $select_doc = $doctors[rand(0,count($doctors)-1)]->doc_id;
                    $id = DB::table('appointment')->insertGetId([
                        'doc_id' => $select_doc,
                        'pat_id' => $pat_id,
                        'app_time' => $time,
                        'app_date' => $dateSQL,
                        'date_of_record' => date("Y-m-d")
                    ]);

                }
                session_write_close();
                return view('appointment.complete');
            }
        }
        session_write_close();

        return "Must login as patient first";
    }
    public function getPageAppointmentList()
    {
        # code...
        $session_info = SessionManager::getSessionInfo();

        if ($session_info['role'] == 'patient') {
            // get all apointments from now, for this patient
            $pat_id = $session_info['id'];            
            $appointments = Appointment::where('pat_id','=',$pat_id)
                            ->where('app_date', '>', date("Y-m-d"))
                          //  ->select('doc_id', 'app_time', 'app_date')
                            ->orderBy('app_date', 'ASC')
                            ->join('doctor', 'doctor.doc_id', '=', 'appointment.doc_id')                                                                
                            ->join('department', 'department.dep_id', '=', 'doctor.dep_id')
                            ->select('app_time', 'app_date', 'doc_name', 'dep_name')
                            ->get();                    

            return view('appointment.appointmentList')->with([
                    'appointments' => $appointments,
                    'role' => $session_info['role']
                ]);
        } elseif ($session_info['role'] == 'doctor') {
            // get all apointments from now, for doctor
            $doc_id = $session_info['id'];
            $appointments = Appointment::where('doc_id','=',$doc_id)
                            ->where('app_date', '>', date("Y-m-d"))
                          //  ->select('doc_id', 'app_time', 'app_date')
                            ->orderBy('app_date', 'ASC')
                            ->orderBy('app_time', 'DESC')
                            ->join('patient', 'patient.pat_id', '=', 'appointment.pat_id')                                                                                        
                            ->select('app_time', 'app_date', 'pat_name')
                            ->get();                   
            return view('appointment.appointmentList')->with([
                    'appointments' => $appointments,
                    'role' => $session_info['role']
            ]);
        } else {
            return view('errors.errorText') -> with([
                    'text' => 'ท่านไม่มีสิทธิ์ทำรายการนี้'
                ]);
        }

        
    }
    public function getPageAppointmentListForToday () {
        $session_info = SessionManager::getSessionInfo();
        if ($session_info['role'] == 'patient') {
            return redirect('/403');
        } elseif ($session_info['role'] == 'doctor') {
            $role = $session_info['role'];
            $doc_id = $session_info['id'];
            $appointments = Appointment::where('doc_id','=',$doc_id)
                            ->where('app_date', '=', date("Y-m-d"))                          
                            ->orderBy('app_time', 'DESC') 
                            ->join('patient', 'patient.pat_id', '=', 'appointment.pat_id')                                                                                        
                            ->select('app_time', 'app_date', 'pat_name')
                            ->get(); 
            return view('appointment.appointmentList')->with([
                'appointments' => $appointments ,
                'role' => $role ,
                'today' => date("Y-m-d")               
                ]);
        }
    }
    public function sendEmail($to, $subject, $msg) {        
        // need 'real' SMTP server & some configs to send email.
        // localhost alone cannot send it.
        $from = 'aunkung_only@hotmail.com';
        Mail::raw($msg, function($message) use ($from, $to)
        {
            $message->from($from, 'Laravel');

            $message->to($to);
        });
    }
}