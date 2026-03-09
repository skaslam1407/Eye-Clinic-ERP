<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EyeCheckupController;
use App\Http\Controllers\EyeglassOrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('patients', PatientController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::get('appointments-calendar', [AppointmentController::class, 'calendar'])->name('appointments.calendar');
    Route::patch('appointments/{appointment}/approve', [AppointmentController::class, 'approve'])
        ->middleware('role:Super Admin,Admin,Doctor')
        ->name('appointments.approve');
    Route::patch('appointments/{appointment}/reject', [AppointmentController::class, 'reject'])
        ->middleware('role:Super Admin,Admin,Doctor')
        ->name('appointments.reject');

    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
    Route::get('invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');

    Route::resource('eyeglass-orders', EyeglassOrderController::class)->parameters([
        'eyeglass-orders' => 'eyeglassOrder',
    ]);
    Route::patch('eyeglass-orders/{eyeglassOrder}/mark-delivered', [EyeglassOrderController::class, 'markDelivered'])
        ->name('eyeglass-orders.mark-delivered');

    Route::resource('checkups', EyeCheckupController::class);

    Route::get('sales-reports', [SalesReportController::class, 'index'])->name('sales-reports.index');
    Route::get('sales-reports/export-csv', [SalesReportController::class, 'exportCsv'])->name('sales-reports.export-csv');

    Route::middleware('role:Super Admin,Admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
        Route::post('notifications', [NotificationController::class, 'store'])->name('notifications.store');
    });
});
