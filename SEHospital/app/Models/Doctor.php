<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 12:55 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {

    protected $table = 'doctor';
    public $timestamps = false;
    protected $fillable = [
        'doc_id', 'doc_name','doc_surname','doc_password','doc_SSN','dep_id','doc_email','doc_tel'
    ];
}