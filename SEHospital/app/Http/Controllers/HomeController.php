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
}