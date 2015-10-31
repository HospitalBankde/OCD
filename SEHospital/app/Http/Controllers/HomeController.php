<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/17/15 AD
 * Time: 11:48 PM
 */

namespace App\Http\Controllers;


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
    public function postRegister() {
    	return view('home.index');
    }
}