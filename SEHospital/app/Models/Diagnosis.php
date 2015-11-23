<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 12:52 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model {

    protected $table = 'diagnosis';
    public $timestamps = false;
    protected $fillable = [
        'diagnosis_id', 'app_id', 'doc_id', 'pat_id', 'diagnosis_datetime', 'symptom_description','status'
    ];
}