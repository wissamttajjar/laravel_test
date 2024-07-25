<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DashboardUniversity\AddStopController;
use App\Http\Controllers\DashboardUniversity\AddTripController;
use App\Http\Controllers\DashboardUniversity\AddYearController;
use App\Http\Controllers\DashboardUniversity\UserAddController;
use App\Http\Controllers\DashboardUniversity\SubscriberController;
use App\Http\Controllers\DashboardUniversity\AddSemesterController;
use App\Http\Controllers\DashboardUniversity\AddStopToTripController;
use App\Http\Controllers\DashboardUniversity\ChangeTripRequestController;
use App\Http\Controllers\DashboardUniversity\AddCompanyContractController;
use App\Http\Controllers\DashboardUniversity\SubscribtionRequestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// , ['only' => ['index', 'show']]
Route::get('/', function () {
    return view('welcome');
});
//university dashboard 
Route::group([], function () {
    Route::resource('UniversityUserAdd', UserAddController::class);
    Route::resource('SubscribtionRequest', SubscribtionRequestController::class);
    Route::resource('Subscriber', SubscriberController::class);
    Route::resource('Add_Year', AddYearController::class);
    Route::resource('Add_Semester', AddSemesterController::class);
    Route::resource('Add_Company_Contract', AddCompanyContractController::class);
    Route::resource('Add_Stop', AddStopController::class);
    Route::resource('Add_Trip', AddTripController::class);
    Route::resource('Add_stop_to_trip', AddStopToTripController::class);
    Route::resource('change_trip_request', ChangeTripRequestController::class);
});
//company dashboard
Route::group([], function () {
    Route::resource('AddBuses', UserAddController::class);
});
