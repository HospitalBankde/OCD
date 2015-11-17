<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\SessionManager;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // This middleware check that session has correct role.


        $session_info = SessionManager::getSessionInfo();

        // Not login yet
        if (is_null($session_info)) {
            if($role == 'patient') {
                return view('home/login')->with([
                    'warning' => 'กรุณาเข้าสู่ระบบผู้ป่วยก่อนทำรายการ'
                    ]);
            } elseif ($role == 'doctor') {
                # change to doctor login page
                return view('home/loginOfficer')->with([
                    'warning' => 'กรุณาเข้าสู่ระบบแพทย์ก่อนทำรายการ',
                    'selectedRole' => 'doctor'
                    ]);
            } elseif ($role == 'nurse') {
                # change to nurse login page
                return view('home/loginOfficer')->with([
                    'warning' => 'กรุณาเข้าสู่ระบบพยาบาลก่อนทำรายการ',
                    'selectedRole' => 'nurse'
                    ]);
            } else {
                return view('errors/errorText')->with([
                    'text' => 'Error: Middleware นี้รับแค่ patient, doctor, nurse'
                    ]);
            }
        } 
        // login but not correct role
        if ($session_info['role'] != $role) {
            return view('errors/errorText')->with([
                'text' => 'เกิดข้อผิดพลาด ท่านไม่มมีสิทธิ์ทำรายการนี้'
                ]);
        }
        // login & correct role => proceed
        return $next($request);
    }
}
