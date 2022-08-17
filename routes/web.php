<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SettingController;

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
    return view('welcome');
});
Route::middleware(['admin'])->prefix('admin')->group(function () {

    // dashboard route
    Route::get('/dashboard',[DashboardController::class,'index']);

    // Employee route
    Route::get('/employees',[EmployeeController::class,'index']);

    // attendance route
    Route::get('/attendances',[AttendanceController::class,'index']);
    Route::get('/scan',[AttendanceController::class,'scan']);

    //payroll 
    Route::get('payrolls',[PayrollController::class,'index']);

    // user route
    Route::get('/logout',[UserController::class, 'loggingout']);


    // department
    Route::get('/department',[DepartmentController::class, 'index']);
    

    //position
    Route::get('/positions',[PositionController::class,'index']);

    // setting
    Route::get('/setting',[SettingController::class,'index']);


});