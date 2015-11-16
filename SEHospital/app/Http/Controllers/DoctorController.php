<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('doctor.schedule_alt');
    }
    public function getPageDayOff()
    {
        return view('doctor.dayoff');
    }
    public function getCreatePrescription()
    {
        return view('doctor.createPrescription');
    }
    public function getCurrentPrescription()
    {
        return view('doctor.currentPrescription');
    }
}
