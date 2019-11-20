<?php

use Illuminate\Http\Request;

Route::apiResources(['user' => 'API\UserController']);
Route::apiResources(['patient' => 'API\PatientController']);
Route::apiResources(['activities' => 'AdminApi\ActivityController']);
