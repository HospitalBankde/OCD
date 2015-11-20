<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\SessionManager;
class ScheduleController extends Controller{

    public function addSchedule()
    {
        return view('officer.addSchedule');
    }
}