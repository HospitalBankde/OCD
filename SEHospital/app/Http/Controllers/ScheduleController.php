<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\SessionManager;
use App\Models\Doctor_Schedule;
class ScheduleController extends Controller{

	public function postAddSchedule ()
    {
    	$doc_id = Input::get('doc_id');

        $DAY = ['sun' ,'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
        for ($i=0; $i < 7; $i++) { 
            $get_key_morn = $DAY[$i] . '_morn';   
            $get_key_after = $DAY[$i] . '_after'; 
            $weekday_id = $i;  
            $morning = Input::get($get_key_morn);
            $afternoon = Input::get($get_key_after);            
            DB::statement("INSERT INTO doctor_schedule (doc_id, weekday_id, morning, afternoon) VALUES ($doc_id, $weekday_id, $morning, $afternoon ) 
                            ON DUPLICATE KEY
                            UPDATE morning = $morning, afternoon = $afternoon");                                          
        }        
        $schedule = Doctor_Schedule::where('doc_id', '=', $doc_id)
                                    ->orderBy('weekday_id', 'ASC')
                                    ->get();

        // replace with readable day
        $DAY = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
        foreach ($schedule as $index => $day) {
            $day->weekday_id = $DAY[$index];
        }                                         
        return view('doctor.schedule')->with([
            'schedule' => $schedule,
            'forDoctorID' => $doc_id
            ]);           
    }

    public function getPageAddSchedule()
    {
        return view('officer.addSchedule');
    }

    public function getDoctorInformation() {
        $doc_id = Input::get('doc_id');

        if(isset($doc_id)){
            $information = DB::select("SELECT doc_name, doc_surname  FROM doctor WHERE doc_id = $doc_id");
            if(is_null($information)){
                return 'doc_ids';
            }
            $information = $information[0];
            return  response()->json(['doc_info' => $information ]);
        }
        return response()->json(['doc_info' => [] ]);
    }
}