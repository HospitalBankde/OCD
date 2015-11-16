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
        $id = DB::table('patient')->insertGetId([
            'pat_name' => Input::get('firstname'),
            'pat_surname' => Input::get('lastname'),
            'pat_SSN' => Input::get('ssn'),
            'pat_tel' => Input::get('tel'),
            'pat_email' => Input::get('email'),
            'pat_password' => Input::get('password')
        ]);
    	return view('home.showRegister')->with([
                'id' => $id,
                'firstname' => Input::get('firstname'),
                'surname' => Input::get('lastname'),
                'ssn' => Input::get('ssn'),
                'tel' => Input::get('tel'),
                'email' => Input::get('email'),
                'password' => Input::get('password')
            ]
        );;
    }
}