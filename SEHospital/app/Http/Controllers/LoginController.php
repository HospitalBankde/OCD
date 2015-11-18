<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/17/15 AD
 * Time: 11:48 PM
 */

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Nurse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\SessionManager;
class LoginController extends Controller{

	public function postLogin() {
		$email = Input::get('email');
        $password = Input::get('password');
        $role = Input::get('role');


        // redirect to correct table
        if($role=='patient'){
            $user = Patient::where('pat_email','=', $email)
                        ->where('pat_password','=', $password )
                        ->select('pat_id','pat_name','pat_surname')
                        ->first();
        } elseif ($role=='doctor') {
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
        		'warning' => 'Wrong role (must be patient, doctor or nurse).'
        		]);
        }
       

        if (!isset($user)) {
            if ($role=='doctor' || $role=='nurse'){
                return view('home/loginOfficer')->with([
                'warning' => 'email หรือ รหัสผ่านไม่ถูกต้อง'
                ]);
            } else {
                return view('home.login')->with([
                    'warning' => 'email หรือ รหัสผ่านไม่ถูกต้อง'
                    ]);
            }      
        }

        session_start();

        if ($role == 'patient'){
            $_SESSION['id'] = $user->pat_id;
            $_SESSION['name'] = $user->pat_name . " " . $user->pat_surname;            
        } elseif ($role=='doctor') {
        	# code...
        	$_SESSION['id'] = $user->doc_id;
      	  	$_SESSION['name'] = $user->doc_name . " " . $user->doc_surname;                                
        } elseif ($role=='nurse') {
        	# code...
        	$_SESSION['id'] = $user->nurse_id;
        	$_SESSION['name'] = $user->nurse_name . " " . $user->nurse_surname;                    
        } else {
            return 'error';
        }
        $_SESSION['role'] = $role;   
        session_write_close();
        return redirect('dashboard');
	}
    public function logout() {
        session_start();
        $role = $_SESSION['role'];                
        $_SESSION = [];
        session_destroy();
        if ($role == 'patient'){
            return view('home.logout');
        } else {
            return view('home.loginOfficer');
        }
    }



}