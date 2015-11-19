<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 1:01 AM
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientInfo extends Model {

    protected $table = 'patient_info';
    public $timestamps = false;
    protected $fillable = [
        'pad_id', 'pat_weight','pat_height','pat_temperature','pat_heartRate','pat_bloodPressure','nurse_id','date_of_record'
    ];
}
