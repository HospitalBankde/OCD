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

class MemberController extends Controller{

    public function postRegister() {
    
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $ssn = Input::get('ssn');
        $tel = Input::get('tel');
        $email = Input::get('email');
        $password = Input::get('password');

        $id = DB::table('patient')->insertGetId([
            'pat_name' => $firstname,
            'pat_surname' => $lastname,
            'pat_SSN' => $ssn,
            'pat_tel' => $tel,
            'pat_email' => $email,            
            'pat_password' => md5($password)
        ]);

        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $firstname . " " . $lastname;
        $_SESSION['role'] = "patient";
        session_write_close();
        
        return view('home.showRegister')->with([
                'id' => $id,
                'firstname' => $firstname,
                'surname' => $lastname,
                'ssn' => $ssn,
                'tel' => $tel,
                'email' => $email,
                'password' => md5($password)
            ]
        );
    }

	public function postLogin() {
		$email = Input::get('email');
        $password = Input::get('password');
        //$password = bcrypt($password);
        $role = Input::get('role');


        // redirect to correct table
        if($role=='patient'){
            $in_password = md5($password);                        
            $user = Patient::where('pat_email','=', $email)
                        ->where('pat_password','=', $in_password )
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
        } else if ($role == 'pharmacist') {
            $user = DB::table('pharmacist')->where('phar_email', '=', $email)
                                        ->where('phar_password', '=', $password)
                                        ->select('phar_id', 'phar_name', 'phar_surname')
                                        ->first();                                        
        } else {
        	return view('home/loginOfficer')->with([
        		'warning' => 'Wrong role (must be patient, doctor or nurse).'
        		]);
        }
       

        if (!isset($user)) {
            if ($role=='doctor' || $role=='nurse' || $role=='pharmacist'){
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
        } elseif ($role=='pharmacist') {
            $_SESSION['id'] = $user->phar_id;
            $_SESSION['name'] = $user->phar_name . " " . $user->phar_surname;
        } else {
            return 'MemberController: error, no selected role.';
        }
        $_SESSION['role'] = $role;   
        session_write_close();
        return redirect('dashboard');
	}
    public function logout() {        
        session_start();
        if(!isset($_SESSION['role'])) {
            session_destroy();
            return redirect('/');
        }
        $role = $_SESSION['role'];                
        $_SESSION = [];
        session_destroy();
        if ($role == 'patient'){
            return view('home.logout');
        } else {
            return view('home.loginOfficer');
        }
    }
    public function getPageProfile() {
        $info = SessionManager::getSessionInfo();
        if (is_null($info)) {
            # code...
            return redirect('503');
        }
        if ($info['role'] == 'patient') {
            $user = DB::table('patient')->where('pat_id', '=', $info['id'])->first();
            $user_info = [
                'name' => $user->pat_name,
                'surname' => $user->pat_surname,
                'ssn' => $user->pat_SSN,
                'tel' => $user->pat_tel,
                'email' => $user->pat_email                
            ];
        } elseif ($info['role'] == 'doctor') {
            $user = DB::table('doctor')->where('doc_id', '=', $info['id'])
                                        ->join('department', 'doctor.dep_id', '=', 'department.dep_id')
                                        ->first();
            $user_info = [
                'name' => $user->doc_name,
                'surname' => $user->doc_surname,
                'ssn' => $user->doc_SSN,
                'dep' => $user->dep_name,
                'tel' => $user->doc_tel,
                'email' => $user->doc_email                
            ];
        } elseif ($info['role'] == 'nurse') {
            $user = DB::table('nurse')->where('nurse_id', '=', $info['id'])->first();
            $user_info = [
                'name' => $user->nurse_name,
                'surname' => $user->nurse_surname,
                'ssn' => $user->nurse_SSN,            
                'tel' => $user->nurse_tel,
                'email' => $user->nurse_email                
            ];
        } elseif ($info['role'] == 'pharmacist') {
            $user = DB::table('pharmacist')->where('phar_id', '=', $info['id'])->first();
            $user_info = [
                'name' => $user->phar_name,
                'surname' => $user->phar_surname,
                'ssn' => $user->phar_SSN,                
                'tel' => $user->phar_tel,
                'email' => $user->phar_email                
            ];
        } else {
            return view('errors.errorText')->with([
                'text' => 'ไม่มี role '. $info['role'] . 'นี้ในระบบ '
                ]);
        }        
        if (is_null($user_info)) {
            return view('errors.errorText')->with([
                'text' => 'ไม่มีข้อมูลในระบบ :' . $info['id']
                ]) ;
        }
    return view('home/profile')->with($user_info);
    }



}