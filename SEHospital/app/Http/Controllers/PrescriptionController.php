<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/18/15 AD
 * Time: 1:40 AM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
class PrescriptionController extends Controller{

    public function getMedicineList() {
        $med_str = Input::get('med_str');
        if(isset($med_str)){
            $medicines = DB::select('SELECT med_id, med_name  FROM medicine');
            $meds = array();

            foreach($medicines as $medicine ) {
                $med_info = [
                    'med_id' => $medicine->med_id,
                    'med_name' => $medicine->med_name];
                array_push($meds, $med_info);
            }

            return  response()->json(['medicine_list' => $meds ]);
        }
        return 'No med_str typed.';
    }

    public function getPatientInformation() {
        $pat_id = Input::get('pat_id');
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');

        if(isset($pat_id)){
            $information = DB::select("SELECT pat_name, pat_surname  FROM patient WHERE pat_id = $pat_id");
            if(empty($information)){
                return 'pat_id';
            }
            $information = $information[0];
            return  response()->json(['pat_info' => $information ]);
        }
        return response()->json(['pat_info' => [] ]);
    }

    public function postCreatePrescription() {
        $json  = Input::get('senddata');
        $data  = json_decode($json,true);

        $prescriptions = $data['prescriptions'];

        $pat_id = $data['pat_id'];
        session_start();
        if (isset($_SESSION['id'])) {
            if($_SESSION['role'] == "doctor"){
                $doc_id = $_SESSION['id'];
                $id = DB::table('diagnosis')->insertGetId([
                    'doc_id' => $doc_id,
                    'pat_id' => $pat_id,
                    'date' => date("Y-m-d"),
                    'symptom_description' => $data['symtom'],
                    'status' => '0'
                 ]);
                $pat_name = DB::table('patient')->where('pat_id',$pat_id)->pluck('pat_name');
                $pat_surname = DB::table('patient')->where('pat_id',$pat_id)->pluck('pat_surname');
                foreach ($prescriptions as $prescription) {
                 # code...
                    DB::table('medicine_prescription')->insert([
                    'diagnosis_id' => $id,
                    'med_id' => $prescription['id'],
                    'use_description' => $prescription['description'],
                    'med_num' => $prescription['num']
                    ]);
                }
                session_write_close();
                return view('doctor.finishPrescription')->with([
                        'pat_name' => $pat_name,
                        'pat_surname' => $pat_surname,
                        'symptom' => $data['symtom'],
                        'prescriptions' => $prescriptions
                    ]);
            }

        }
        session_write_close();
        return "Must log in as doctor first";
       // return $data; 
    }

}