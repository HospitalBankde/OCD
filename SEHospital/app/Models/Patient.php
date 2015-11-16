<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $table = 'patient';
    public $timestamps = false;
    protected $fillable = [
        'pat_id', 'pat_name','pat_surname','pat_SSN','pat_tel','pat_email','pat_password'
    ];
}
