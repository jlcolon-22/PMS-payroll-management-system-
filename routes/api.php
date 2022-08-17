<?php

use Illuminate\Http\Request;
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
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login',[UserController::class,'logging']);
Route::middleware(['admin'])->prefix('admin')->group(function () {

    // department API
    Route::get('/department',[DepartmentController::class, 'departments']);
    Route::post('/department',[DepartmentController::class, 'store']);
    Route::delete('/department/{id}',[DepartmentController::class, 'destroy']);
    Route::put('/department/{id}/edit',[DepartmentController::class, 'update']);


    // Position API
    Route::get('/departments',[PositionController::class,'departments']);
    Route::post('/position',[PositionController::class,'store']);
    Route::get('/position',[PositionController::class,'positions']);
    Route::delete('/position/{id}',[PositionController::class, 'destroy']);
    Route::put('/position/{id}/edit',[PositionController::class, 'update']);


    // employee API
    Route::get('department/all',[EmployeeController::class,'departments']);
    Route::post('employee',[EmployeeController::class,'store']);
    Route::get('employees',[EmployeeController::class,'employees']);
    Route::post('/employees/{id}/update',[EmployeeController::class, 'update']);
    Route::delete('/employee/{id}',[EmployeeController::class, 'destroy']);

    // dashboard API
    Route::get('dashboard/employees',[DashboardController::class,'employees']);
    Route::get('dashboard/attendances',[DashboardController::class,'attendances']);

    // Attendance API
    Route::post('attendance',[AttendanceController::class,'store']);
    Route::get('attendances',[AttendanceController::class,'attendances']);
    Route::put('attendance/{id}/update',[AttendanceController::class,'update']);
    Route::delete('attendance/{id}',[AttendanceController::class,'destroy']);


    // Payroll API
    Route::get('payrolls',[PayrollController::class,'payrolls']);
    Route::post('payroll',[PayrollController::class,'store']);
    Route::get('payroll/employees',[PayrollController::class,'employees']);
    Route::delete('payroll/{id}',[PayrollController::class,'destroy']);

    //setting API
    Route::get('setting',[SettingController::class,'deduction']);
    Route::put('setting/{id}/update',[SettingController::class,'update']);
});
