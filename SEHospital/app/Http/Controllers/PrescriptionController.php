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
        $app_id = Input::get('app_id');        
        $json  = Input::get('senddata');
        $data  = json_decode($json,true);
        //echo $data['prescriptions'];
        $prescriptions = $data['prescriptions'];

        $pat_id = $data['pat_id'];
        session_start();
        if (isset($_SESSION['id'])) {
            if($_SESSION['role'] == "doctor"){
                $doc_id = $_SESSION['id'];
                $id = DB::table('diagnosis')->insertGetId([
                    'app_id' => $app_id,
                    'doc_id' => $doc_id,
                    'pat_id' => $data['pat_id'],
                    'diagnosis_datetime' => date("Y-m-d H:i:s"),
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
                        'pat_id' => $pat_id,
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

    function getUpdatedPrescription(){

        $Current = DB::table('diagnosis') // Current Prescription
        -> whereDate('diagnosis.diagnosis_datetime', '=', date("Y-m-d"))
        -> leftJoin('patient','diagnosis.pat_id','=','patient.pat_id')
        -> select('diagnosis.diagnosis_id','diagnosis.pat_id','diagnosis.symptom_description'
            ,'patient.pat_name','patient.pat_surname','diagnosis.diagnosis_datetime') 
        -> where('status','=','0')        
        -> get();

        $Finished = DB::table('diagnosis') // Finished Prescription
        -> whereDate('diagnosis.diagnosis_datetime', '=', date("Y-m-d"))
        -> leftJoin('patient','diagnosis.pat_id','=','patient.pat_id')
        -> select('diagnosis.diagnosis_id','diagnosis.pat_id','diagnosis.symptom_description'
            ,'patient.pat_name','patient.pat_surname','diagnosis.diagnosis_datetime') 
        -> where('status','=','1')
        -> get();

        $Cancelled = DB::table('diagnosis') // Cancelled Prescription
        -> whereDate('diagnosis.diagnosis_datetime', '=', date("Y-m-d"))
        -> leftJoin('patient','diagnosis.pat_id','=','patient.pat_id')
        -> select('diagnosis.diagnosis_id','diagnosis.pat_id','diagnosis.symptom_description'
            ,'patient.pat_name','patient.pat_surname','diagnosis.diagnosis_datetime') 
        -> where('status','=','2')
        -> get();
        
        return  response()->json(['Current_info' => $Current 
            ,'Finished_info' => $Finished ,'Cancelled_info' => $Cancelled ]);

        // pat_id , pat_name, pat_surname, med_name, med_id, med_num, use_description, diagnosis_id, date, time
        // ,status
    }

    function getPrescriptionDetail(){
        $diagnosis_id = Input::get('diagnosis_id');
        $Current = DB::table('diagnosis') // Current Prescription
        -> leftJoin('medicine_prescription','diagnosis.diagnosis_id','=','medicine_prescription.diagnosis_id')
        -> leftJoin('patient','diagnosis.pat_id','=','patient.pat_id')
        -> leftJoin('medicine','medicine_prescription.med_id','=','medicine.med_id')
        -> select('diagnosis.diagnosis_id','diagnosis.pat_id','diagnosis.symptom_description'
            ,'medicine_prescription.med_id','medicine_prescription.med_num','medicine_prescription.use_description'
            ,'patient.pat_name','patient.pat_surname'
            ,'med_name') 
        -> where('status','=','0')
        -> where('diagnosis.diagnosis_id','=', $diagnosis_id)
        -> get();

        return  response()->json(['Current_info' => $Current ]);

    }

    function getChangeStatus(){    
        $diagnosis_id = Input::get('diagnosis_id');
        $status = Input::get('status');
        DB::table('diagnosis')
            -> where('diagnosis.diagnosis_id','=', $diagnosis_id)
            ->update(['status' => $status]);
        return response()->json(['status'=> $diagnosis_id]);
    }
}


