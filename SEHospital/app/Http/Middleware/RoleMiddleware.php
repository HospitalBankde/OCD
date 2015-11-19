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
    public function handle($request, Closure $next, ...$roles)
    {
        // This middleware check that session has correct role to enter the page.

        $session_info = SessionManager::getSessionInfo();

        // Not login yet
        if (is_null($session_info)) {

            // Redirect for primary role (first role specified in roles)
            if($roles[0] == 'patient') {                
                return view('home.login')->with([
                    'warning' => 'กรุณาเข้าสู่ระบบผู้ป่วยก่อนทำรายการ'
                    ]);
            } elseif ($roles[0] == 'doctor') {
                # change to doctor login page
                return view('home.loginOfficer')->with([
                    'warning' => 'กรุณาเข้าสู่ระบบแพทย์ก่อนทำรายการ',
                    'selectedRole' => 'doctor'
                    ]);
            } elseif ($roles[0] == 'nurse') {
                # change to nurse login page
                return view('home.loginOfficer')->with([
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
        $user_role = $session_info['role'];
        if (!in_array($user_role, $roles)) {
            //return view('errors.503');
            return view('errors.errorText')->with([
                    'text' => 'ท่านไม่สามารถทำรายการนี้ได้'
                ]);
        }        
        // login & correct role => proceed
        return $next($request);
    }
}
