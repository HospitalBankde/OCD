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
        $today = getdate();
        $todayDate = $today['mday'];
        $todayWeekday = date('N', strtotime($today['weekday']) ) % 7;

        $doctor = Doctor::where('doc_id','=',$select_doc)
                        ->select('doc_name','doc_surname')->first();
        $doc_schedule = Doctor_Schedule::where('doc_id','=', $select_doc)
                        ->select('weekday_id','morning','afternoon')
                        ->orderBy('weekday_id', 'asc')
                        ->get();

        $nextMonth = date('Y-m-d', strtotime("+31 days"));

        $appointment = Appointment::where('doc_id','=', $select_doc)
                        ->where('app_date','>', date("Y-m-d") )
                        ->where('app_date','<', $nextMonth)
                        ->select(DB::raw('count(*) as count, app_date, app_time'))
                        ->groupBy('app_date', 'app_time')
                        ->get();

        $availday = array();

        for ($i = 0; $i < 31; $i++) {
            $tempDate = $todayDate + $i;
            $tempWeekday = ($todayWeekday + $i) % 7;

            if ( ! isset($doc_schedule[6])) {
                return "doc_id " . $select_doc . " error, please contact the admin";
            }

            //Add the condition check here. Here I only checked the schedule.
            //More to add: appointment being full, add time to array to check in time.blade
            if ($doc_schedule[$tempWeekday]->morning == 0 && $doc_schedule[$tempWeekday]->afternoon == 0) {
                array_push($availday, 0);
                continue;
            }

            array_push($availday, 1);
        }

        $doc_name = $doctor->doc_name;
        $doc_surname = $doctor->doc_surname;

        return view('appointment.time')->with([
                'select_doc' => $select_doc,
                'select_dep' => $select_dep,
                'doc_name' => $doc_name,
                'doc_surname' => $doc_surname,
                'availday' => $availday
            ]
        );
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
}