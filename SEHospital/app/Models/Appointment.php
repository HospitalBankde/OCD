<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 12:52 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {

    protected $table = 'appointment';
    public $timestamps = false;
    protected $fillable = [
        'app_id', 'doc_id','pat_id','app_time','app_date','date_of_record'
    ];
}