<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
    	'fullname',
    	'firstname',
    	'middlename',
    	'lastname',
    	'age',
    	'address',
    	'contact_no',
    	'type'
    ];

    // public function treatment()
    // {
    // 	return $this->belongsTo(Treatment::class);
    // }
}
