<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome2');
});

Auth::routes();

Route::get('treatment', 'TreatmentController@index');
Route::get('treatment/denture', 'TreatmentController@denture');
Route::get('treatment/extraction', 'TreatmentController@extraction');
Route::get('treatment/allpatient', 'TreatmentController@allPatient');
// Route::put('treatment/update', 'TreatmentController@update');


Route::resources(['treatment' => 'TreatmentController']); 

Route::resources(['pdf' => 'PDFController']); 
Route::get('pdfexport/{id}', 'PDFController@pdfexport');

// Route::resources(['treatment' => 'DentureController']);
// Route::resources(['brace' => 'BraceController']);
// Route::resources(['treatment' => 'DentureController']);
// Route::resources(['treatment' => 'ExtractionController']);
// Route::get('/brace', 'TreatmentController')->name('show');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+?)');
