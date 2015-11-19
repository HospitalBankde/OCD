<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/17/15 AD
 * Time: 11:48 PM
 */

namespace App\Http\Controllers;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\SessionManager;
class HomeController extends Controller{


    public function getIndex() {
        return view('home.index')->with(SessionManager::getSessionInfo());
    }
    public function getPageRegister() {
        return view('home.register');
    }
    public function getPageLogin() {
        return view('home.login');
    }
    public function getPageLoginOfficer() {
        return view('home.loginOfficer');
    }
    public function getPageDashboard() {
        return view('home.dashboard')->with(Session::getSessionInfo());
    }
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
            'pat_password' => bcrypt($password)
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
                'password' => $password
            ]
        );
    }
}