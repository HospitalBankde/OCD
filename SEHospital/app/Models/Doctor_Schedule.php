<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 12:58 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Doctor_Schedule extends Model {
    protected $table = 'doctor_schedule';
    public $timestamps = false;    
    //public $primaryKey = ['doc_id', 'weekday_id'];
    protected $fillable = [
        'doc_id', 'weekday_id', 'morning', 'afternoon'
    ];
}