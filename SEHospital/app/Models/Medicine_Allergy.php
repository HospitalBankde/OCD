<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 1:02 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Medicine_Allergy extends Model {

    protected $table = 'medicine_allergy';
    public $timestamps = false;
    protected $fillable = [
        'pat_id', 'med_id','date_of_record','allergy_desc'
    ];
}