<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{   
    protected $table = 'treatment';
    protected $fillable = [
        'fullname',
    	'tooth_no',
        'procedure',
        'amount_charge',
        'amount_paid',
        'balance',
    	'type',
    	'status'
    ];

    // public function patients()
    // {
    // 	return $this->hasMany(Patient::class);
    // }
}
