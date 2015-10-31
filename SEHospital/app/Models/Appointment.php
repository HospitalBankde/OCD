<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 12:52 AM
 */

namespace App\Models;

class Appointment extends Model {

    protected $table = 'appointment';
    public $timestamps = false;
    protected $fillable = [
        'app_id', 'doc_id','pat_id','dep_id','app_date','app_reserve_date','app_reserve_time','app_sym'
    ];
}