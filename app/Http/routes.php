<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api'],
    'namespace' => 'Api\v1'
], function () {

    Route::resource('clinics', 'ClinicController', ['except' => ['create', 'edit', 'destroy']]);
    Route::resource('clinics.professionals', 'ClinicProfessionalController', ['except' => ['create', 'edit', 'update']]);
    Route::post('clinics/{clinics}/patients/{patients}/rehabilitations', ['as' => 'api.v1.rehabilitation.store', 'uses' => 'RehabilitationController@store']);
    Route::put('clinics/{clinics}/patients/{patients}/status', ['as' => 'api.v1.clinics.patients.status', 'uses' => 'ClinicPatientController@status']);
    Route::resource('clinics.patients', 'ClinicPatientController', ['except' => ['create', 'edit', 'destroy']]);
    Route::post('password/reset', 'PasswordController@reset');

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
