<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Patient extends Model
{

	use Notifiable, LogsActivity, CausesActivity;
	protected static $logFillable = true;
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
