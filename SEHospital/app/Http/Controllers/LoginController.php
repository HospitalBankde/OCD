<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/17/15 AD
 * Time: 11:48 PM
 */

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Nurse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\SessionManager;
class LoginController extends Controller{

	public function getPageLoginOfficer() {
		return view('home.loginOfficer');
	}
	public function postLoginOfficer() {
		$email = Input::get('email');
        $password = Input::get('password');
        $role = Input::get('role');


        if ($role=='doctor') {
        	# code...
        	$user = Doctor::where('doc_email','=', $email)
                        ->where('doc_password','=', $password )
                        ->select('doc_id','doc_name','doc_surname')
                        ->first();
        } elseif ($role=='nurse') {
        	# code...
        	$user  = Nurse::where('nurse_email','=', $email)
                        ->where('nurse_password','=', $password )
                        ->select('nurse_id','nurse_name','nurse_surname')
                        ->first();
        } else {
        	return view('home/loginOfficer')->with([
        		'warning' => 'Wrong role (must be nurse or doctor).'
        		]);
        }
       
        if (!isset($user)) {
            return view('home/loginOfficer')->with([
        		'warning' => 'email หรือ รหัสผ่านไม่ถูกต้อง'
        		]);
        }
        session_start();

        if ($role=='doctor') {
        	# code...
        	$_SESSION['id'] = $user->doc_id;
      	  	$_SESSION['name'] = $user->doc_name . " " . $user->doc_surname;
        } elseif ($role=='nurse') {
        	# code...
        	$_SESSION['id'] = $user->nurse_id;
        	$_SESSION['name'] = $user->nurse_name . " " . $user->nurse_surname;
        }         
        $_SESSION['role'] = $role;
        session_write_close();
    
        return view('officer.dashboard');
	}



}