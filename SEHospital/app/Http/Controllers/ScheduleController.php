<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\SessionManager;
use App\Models\Doctor_Schedule;
class ScheduleController extends Controller{

	public function showSchedule()
    {
    	$doc_id = Input::get('doc_id');

        DB::table('doctor_schedule')->insert(['doc_id' => $doc_id,'weekday_id' => '0', 'morning' => Input::get('sun_morn'), 'afternoon' => Input::get('sun_after')]);
        DB::table('doctor_schedule')->insert(['doc_id' => $doc_id,'weekday_id' => '1', 'morning' => Input::get('mon_morn'), 'afternoon' => Input::get('mon_after')]);
		DB::table('doctor_schedule')->insert(['doc_id' => $doc_id,'weekday_id' => '2', 'morning' => Input::get('tue_morn'), 'afternoon' => Input::get('tue_after')]);
		DB::table('doctor_schedule')->insert(['doc_id' => $doc_id,'weekday_id' => '3', 'morning' => Input::get('wed_morn'), 'afternoon' => Input::get('wed_after')]);
		DB::table('doctor_schedule')->insert(['doc_id' => $doc_id,'weekday_id' => '4', 'morning' => Input::get('thu_morn'), 'afternoon' => Input::get('thu_after')]);
		DB::table('doctor_schedule')->insert(['doc_id' => $doc_id,'weekday_id' => '5', 'morning' => Input::get('fri_morn'), 'afternoon' => Input::get('fri_after')]);
		DB::table('doctor_schedule')->insert(['doc_id' => $doc_id,'weekday_id' => '6', 'morning' => Input::get('sat_morn'), 'afternoon' => Input::get('sat_after')]);

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

    public function addSchedule()
    {
        return view('officer.addSchedule');
    }

    public function getDoctorInformation() {
        $doc_id = Input::get('doc_id');
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');

        if(isset($doc_id)){
            $information = DB::select("SELECT doc_name, doc_surname  FROM doctor WHERE doc_id = $doc_id");
            if(empty($information)){
                return 'doc_id';
            }
            $information = $information[0];
            return  response()->json(['doc_info' => $information ]);
        }
        return response()->json(['doc_info' => [] ]);
    }
}