<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/19/15 AD
 * Time: 2:43 PM
 */

namespace App\Http\Controllers;



use App\Models\Patient;

class TestSomethingController extends Controller {


    public function getIndex() {


        $patients = Patient::all();
        foreach($patients as $patient){
            echo $patient->pat_name ;
        }
        return view('testview')->with([
            'patients' => $patients
        ]);
    }
}