<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
    	'patient',
    	'procedure',
    	'amount_charge',
    	'amount_paid',
    	'balance',
    	'type'
    ];

    // public function patients()
    // {
    // 	return $this->hasMany(Patient::class);
    // }
}
