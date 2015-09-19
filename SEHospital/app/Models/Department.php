<?php
/**
 * Created by PhpStorm.
 * User: AunN
 * Date: 9/20/15 AD
 * Time: 12:56 AM
 */

namespace App\Models;

class Department extends Model {

    protected $table = 'department';
    public $timestamps = false;
    protected $fillable = [
        'dep_id', 'dep_name'
    ];
}