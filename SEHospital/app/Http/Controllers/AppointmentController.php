<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/18/15 AD
 * Time: 1:40 AM
 */

namespace App\Http\Controllers;
use App\Models\Doctor;
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