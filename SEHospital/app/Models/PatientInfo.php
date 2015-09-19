<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 1:01 AM
 */
namespace App\Models;

class PatientInfo extends Model {

    protected $table = 'patient_info';
    public $timestamps = false;
    protected $fillable = [
        'pad_id', 'pat_weight','pat_height','pat_temp','pat_hr','nurse_id'
    ];
}
