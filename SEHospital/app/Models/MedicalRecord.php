<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 1:02 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model {

    protected $table = 'medical_record';
    public $timestamps = false;
    protected $fillable = [
        'med_id', 'doc_id','pat_id','sym_id'
    ];
}