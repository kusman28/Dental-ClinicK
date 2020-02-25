<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
    	'fullname',
    	'patient_id',
    	'fullname',
    	'tooth_no',
    	'procedure',
	];
}
