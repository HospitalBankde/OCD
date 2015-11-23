<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/18/15 AD
 * Time: 1:40 AM
 */

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SessionManager;

class MailController extends Controller {

    public static function appointmentMail($app_id) {
        $app = Appointment::where('app_id','=', $app_id)
                ->select('doc_id','pat_id','app_date','app_time')
                ->first();

        $doc = Doctor::where('doc_id','=', $app->doc_id)
                ->select('doc_name')
                ->first();

        $pat = Patient::where('pat_id','=', $app->pat_id)
                ->select('pat_name','pat_surname','pat_email')
                ->first();

        $text = "Dear " . $pat->pat_name . " " . $pat->pat_surname . "\r\n\n"
                . "You have recently made an appointment:\r\n"
                . "Doctor: " . $doc->doc_name . "\r\n"
                . "Appointment Date: " . $app->app_date . "\r\n"
                . "Time of Day: " . $app->app_time;
        // MailController::sendEmail($pat->pat_email,"Appointment Alert",$text);
        MailController::sendEmail("bankde@hotmail.com","iHospital Appointment",$text);
    }

    public static function sendEmail($to, $subject, $msg) {        
        // need 'real' SMTP server & some configs to send email.
        // localhost alone cannot send it.
        $from = 'bankde.ihospital@gmail.com';
        Mail::raw($msg, function($message) use ($from, $to, $subject)
        {
            $message->from($from, 'iHospital Noti-Center');
            $message->to($to)->subject($subject);
        });
    }
}