<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/17/15 AD
 * Time: 11:48 PM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;


class HomeController extends Controller{


    public function getIndex() {
        return view('home.index');
    }
    public function getRegister() {
        return view('home.register');
    }
    public function getLogin() {
        return view('home.login');
    }
    public function getLoginOfficer() {
        return view('home.loginOfficer');
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
    	return view('home.showRegister')->with([
                'id' => $id,
                'firstname' => $firstname,
                'surname' => $lastname,
                'ssn' => $ssn,
                'tel' => $tel,
                'email' => $email,
                'password' => $password
            ]
        );;
    }
}