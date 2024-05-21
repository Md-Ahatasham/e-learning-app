<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['apiToken','activityTracker']], function () {
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::post('forgotPassword', 'ForgotPasswordController@submitEmail');
    Route::post('resetPassword', 'ForgotPasswordController@resetPassword');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('getPatientList', 'ApiPatientController@patientListByRounder');     
        Route::get('getPatientById', 'ApiPatientController@patientById');     
        Route::post('logout', 'AuthController@logout');     
        Route::post('transferPatient', 'PatientTransferHistoryController@store');     
        Route::get('getTransferPatientList', 'PatientTransferHistoryController@index');     
        Route::put('updateTransferPatientList', 'PatientTransferHistoryController@update');     
        Route::get('getRounderList', 'ApiRounderController@index');     
        Route::get('getInactiveRounderList', 'ApiRounderController@inActiveList');     
        Route::put('activateRounder', 'ApiRounderController@activateRounder');     
        Route::post('completeRound', 'RoundingHistoryController@store');        
    });
});


