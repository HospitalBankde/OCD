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

            // Redirect login page for primary role (first role specified in roles)
            // and automatically select role required for the user.
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
            } elseif($roles[0] == 'pharmacist') {
                return view('home.loginOfficer')->with([
                    'warning' => 'กรุณาเข้าระบบเภสัชกรก่อนทำรายการ',
                    'selectedRole' => 'pharmacist'
                    ]);
            }
            else { // Patient
                return view('errors/errorText')->with([
                    'text' => 'Error: Middleware นี้รับแค่ patient, doctor, nurse'
                    ]);
            }
        } 
        // login but not correct role        
        $user_role = $session_info['role'];

        // check if user_role exists in valid roles
        $contain = 0;            
        foreach ($roles as $role) {    
            //echo "The role $role $user_role\n";                              
            // echo strcmp($role, $user_role);     
            //WTF , == cannot use to compare string!!!!       
            if (strcmp($role, $user_role) == 0 ){
                $contain = 1;
            
            }
        }            
        // echo $contain;    
        if ($contain == 0) {

            //return view('errors.503');
            return view('errors.errorText')->with([
                    'text' => 'ท่านไม่สามารถทำรายการนี้ได้'
                ]);
        }        
        // login & correct role => proceed
        return $next($request);
    }
}
