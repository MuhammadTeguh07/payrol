<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

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


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', function() {
    return view("auth/login");
});
Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/staff', [StaffController::class, 'index']);
    Route::get('/staff/get', [StaffController::class, 'get']);
    Route::get('/staff/insert', [StaffController::class, 'insert']);
    Route::get('/staff/update/{id}', [StaffController::class, 'update']);
    Route::get('/staff/delete/{id}', [StaffController::class, 'delete']);
    
    Route::get('/permission', [PermissionController::class, 'index']);
    Route::post('/permission/insert', [PermissionController::class, 'insert'])->name('permission-insert');
    Route::put('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission-update');
    Route::delete('/permission/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission-destroy');

    Route::get('/absence', [AbsenceController::class, 'index']);

    Route::get('/overtime', [OvertimeController::class, 'index']);
    Route::post('/overtime/insert', [OvertimeController::class, 'insert'])->name('overtime-insert');
    Route::put('/overtime/update/{id}', [OvertimeController::class, 'update'])->name('overtime-update');
    Route::delete('/overtime/destroy/{id}', [OvertimeController::class, 'destroy'])->name('overtime-destroy');

    Route::get('/payroll', [PayrollController::class, 'index']);
    Route::get('/payroll/generate', [PayrollController::class, 'create']);
    Route::get('/payroll/save', [PayrollController::class, 'store']);
    Route::put('/payroll/approve/{id}', [PayrollController::class, 'approve'])->name('payroll-approve');
    
    Route::get('/data-payroll', [PayrollController::class, 'data_payroll']);
});