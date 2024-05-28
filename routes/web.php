<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('auth/verify', [AuthController::class,'verify']);
Route::post('auth/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']); 
    Route::resource('user', UserController::class);
    Route::resource('akun', AkunController::class);
    Route::resource('product', ProductController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('expense', ExpenseController::class);
    Route::get('transaction/print/{noinvoice}', [TransactionController::class, 'print'])->name('transaction.print');
    Route::resource('transaction', TransactionController::class);

    Route::get('jurnal', [ReportController::class, 'jurnal']);
    Route::post('jurnal', [ReportController::class, 'jurnal']);

    Route::get('buku-besar', [ReportController::class, 'bukuBesar']);
    Route::post('buku-besar', [ReportController::class, 'bukuBesar']);

    Route::get('perubahan-modal', [ReportController::class, 'perubahanModal']);
    Route::post('perubahan-modal', [ReportController::class, 'perubahanModal']);
});