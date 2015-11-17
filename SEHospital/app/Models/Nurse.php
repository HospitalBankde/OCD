<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    //
    protected $table = 'nurse';
    public $timestamps = false;
    protected $fillable = [
        'nurse_id', 'nurse_name','nurse_surname','nurse_password','nurse_SSN','nurse_email','nurse_tel'
    ];
}
