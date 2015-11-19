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
class AppointmentController extends Controller{

    public function getIndex() {                
        $depts = DB::select('SELECT dep_name, dep_id FROM department');
        return view('appointment.index')->with([
                'depts' => $depts
            ]
        );
    }

    public function getPageTime() {
        $select_dep = Input::get('select_dept');
        if ($select_dep == null || $select_dep == "" || $select_dep === "-1") {
            return 'No dep_id sent';
        }

        $select_doc = Input::get('select_doc');
        $doctor = Doctor::where('doc_id','=',$select_doc)
                        ->select('doc_name','doc_surname')->first();

        $doc_name = $doctor->doc_name;
        $doc_surname = $doctor->doc_surname;

        return view('appointment.time')->with([
                'select_doc' => $select_doc,
                'select_dep' => $select_dep,
                'doc_name' => $doc_name,
                'doc_surname' => $doc_surname,
            ]
        );
    }

    public function getDoctorDay() {
        $select_doc = Input::get('select_doc');
        $today = getdate();
        $todayDate = $today['mday'];
        $todayWeekday = date('N', strtotime($today['weekday']) ) % 7;

        $availday = array();

        $doctor = Doctor::where('doc_id','=',$select_doc)
                        ->select('doc_name','doc_surname')->first();
        $doc_schedule = Doctor_Schedule::where('doc_id','=', $select_doc)
                        ->select('weekday_id','morning','afternoon')
                        ->orderBy('weekday_id', 'asc')
                        ->get();

        //if doc_schedule error
        if ( ! isset($doc_schedule[6])) {
            return response()->json(['availday' => $availday]);
        }

        $nextMonth = date('Y-m-d', strtotime("+31 days"));

        //Gather all date that is full (>=30)
        $appointmentFull = Appointment::where('doc_id','=', $select_doc)
                        ->where('app_date','>', date("Y-m-d") )
                        ->where('app_date','<', $nextMonth)
                        ->select(DB::raw('count(*) as count, app_date'))
                        ->groupBy('app_date')
                        ->having('count', '>=', 30)
                        ->get();

        for ($i = 0; $i < 31; $i++) {
            $tempDate = $todayDate + $i;
            $tempWeekday = ($todayWeekday + $i) % 7;

           if ($doc_schedule[$tempWeekday]->morning == 0 && $doc_schedule[$tempWeekday]->afternoon == 0) {
                array_push($availday, 0);
                continue;
            }

            //If that day is full (>=30)
            foreach ($appointmentFull as $eachFull) {
                $tempDate2 = explode("-", $eachFull->app_date);
                if ($tempDate2[2] == $tempDate) {
                    array_push($availday, 0);
                    break;
                }
            }

            array_push($availday, 1);
        }

        return response()->json(['availday' => $availday]);
    }

    public function getDoctorTime() {
        $select_doc = Input::get('select_doc');
        $select_date = Input::get('select_date');
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
        foreach ($appointment as $eachApp) {
            if ($eachApp->app_time == "morning") $doc_schedule->morning = 0;
            if ($eachApp->app_time == "afternoon") $doc_schedule->afternoon = 0;
        }


        return response()->json(['doc_schedule' => $doc_schedule]);
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
        //Assume that client is innocent and never manipulate the post request/javascript file
        //Security here is beyond worst, you know what I mean
        $select_doc = Input::get('select_doc');
        $select_dep = Input::get('select_dept');
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
                $id = DB::table('appointment')->insertGetId([
                    'doc_id' => $select_doc,
                    'pat_id' => $pat_id,
                    'app_time' => $time,
                    'app_date' => $dateSQL,
                    'date_of_record' => date("Y-m-d")
                ]);
                session_write_close();
                return view('appointment.complete');
            }
        }
        session_write_close();


        return "Must login as patient first";
    }
    public function postPageAppointmentList()
    {
        # code...
        $pat_id = Input::get('pat_id');

        // get all apointments from now, for this patient
        $appointments = Appointment::where('pat_id','=',$pat_id)
                        ->where('app_date', '>', date("Y-m-d"))
                      //  ->select('doc_id', 'app_time', 'app_date')
                        ->orderBy('app_date', 'ASC') 
                        ->join('doctor', 'doctor.doc_id', '=', 'appointment.doc_id')                                                                
                        ->join('department', 'department.dep_id', '=', 'doctor.dep_id')
                        ->select('app_time', 'app_date', 'doc_name', 'dep_name')
                        ->get();                    

        return view('appointment.appointmentList')->with([
                'appointments' => $appointments
            ]);
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