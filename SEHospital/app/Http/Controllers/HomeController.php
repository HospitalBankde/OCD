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
    public function getPageContact() {
        return view('home.contact');
    }
    public function getPageAbout() {
        return view('home.about');
    }
}