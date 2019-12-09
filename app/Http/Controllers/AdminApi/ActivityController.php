<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {

        $activities = auth()->user()->actions->load('causer');
        

    	// return Activity::latest()->paginate(10);
    	return $activities;
    }

    //     public function index()
    // {
    //     return Activity::latest()->paginate(10);
    // }
}
