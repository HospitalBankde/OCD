<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 12:58 AM
 */

namespace App\Models;

class DoctorSchedule extends Model {

    protected $table = 'doctor_schedule';
    public $timestamps = false;
    protected $fillable = [
        'doc_id', 'weekday_id', 'schedule'
    ];
}