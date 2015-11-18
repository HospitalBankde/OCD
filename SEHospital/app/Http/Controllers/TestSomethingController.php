<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/19/15 AD
 * Time: 2:43 PM
 */

namespace App\Http\Controllers;



use App\Models\Patient;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

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
    public function getTestData() {
        return 'test data';
    }
    public function postTest() {
        $email = Input::get('email');
        return "You just type: " . $email;
    }


    // Session using PHP and Laravel are different.
    public function sessionTestLaravel(Request $request) {
        $session = $request->session();
        if($session->has('testname')){
            return 'Session already exists' . $session->get('testname') . ' ' . $session->get('testid');
        } else {
            $session->put('testid', 'Laravel');
            $session->put('testname', 'Wirawit Rueopas');
            return 'Session set.';
        }
    }
    public function sessionTestPHP() {
        session_start();
        if(isset($_SESSION['testname'])){
            return 'Session already exists' . $_SESSION['testname'] . ' ' . $_SESSION['testid'];
        } else {
            $_SESSION['testid'] = 'PHP';
            $_SESSION['testname'] = 'Wirawit Rueopas';
            return 'Session set.';
        }
        session_write_close();
    }
    public function sessionTestClose(Request $request) {
        //PHP
        session_start();
        session_destroy();   

        //Laravel
        $session = $request->session();

        //clear all
        $session->flush();
        //clear some
        // $session->forget('key');
        return 'All sessions from Laravel & PHP are cleared.'
    }
}