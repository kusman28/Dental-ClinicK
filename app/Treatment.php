<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'patient',
    	'tooth_no',
        'procedure',
    	'status',
        'amount_charge',
        'amount_paid',
    	'type'
    ];

    // public function patients()
    // {
    // 	return $this->hasMany(Patient::class);
    // }
}
