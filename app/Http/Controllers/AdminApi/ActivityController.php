<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {

        // $activities = auth()->user()->actions->load('causer');
        
        $activities = auth()->user()->actions()->with('causer')->latest()->get();
    	// $activities = Activity::with('causer')->where('causer_id', auth()->user()->id)->latest()->get();
        return $activities;
    }
}
