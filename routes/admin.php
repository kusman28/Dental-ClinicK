<?php

use Illuminate\Http\Request;

Route::get('find', 'API\PatientController@search');

Route::apiResources(['user' => 'API\UserController']);
Route::apiResources(['patient' => 'API\PatientController']);
Route::apiResources(['activities' => 'AdminApi\ActivityController']);
