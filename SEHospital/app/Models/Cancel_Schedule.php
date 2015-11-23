<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 12:58 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cancel_Schedule extends Model {
    protected $table = 'cancel_schedule';
    public $timestamps = false;    
    //public $primaryKey = ['doc_id', 'weekday_id'];
    protected $fillable = [
        'doc_id', 'cancel_date', 'cancel_desc'
    ];
}