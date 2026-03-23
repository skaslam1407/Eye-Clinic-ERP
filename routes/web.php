<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EyeCheckupController;
use App\Http\Controllers\EyeglassOrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->middleware('permission:dashboard')->name('dashboard');

    Route::resource('patients', PatientController::class)->middleware('permission:patients');
    Route::resource('appointments', AppointmentController::class)->middleware('permission:appointments');
    Route::get('appointments-calendar', [AppointmentController::class, 'calendar'])->middleware('permission:appointments')->name('appointments.calendar');
    Route::patch('appointments/{appointment}/approve', [AppointmentController::class, 'approve'])
        ->middleware(['role:Super Admin,Admin,Doctor', 'permission:appointments'])
        ->name('appointments.approve');
    Route::patch('appointments/{appointment}/reject', [AppointmentController::class, 'reject'])
        ->middleware(['role:Super Admin,Admin,Doctor', 'permission:appointments'])
        ->name('appointments.reject');

    Route::resource('invoices', InvoiceController::class)->middleware('permission:invoices');
    Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->middleware('permission:invoices')->name('invoices.print');
    Route::get('invoices/{invoice}/download', [InvoiceController::class, 'download'])->middleware('permission:invoices')->name('invoices.download');

    Route::resource('eyeglass-orders', EyeglassOrderController::class)->middleware('permission:eyeglass-orders')->parameters([
        'eyeglass-orders' => 'eyeglassOrder',
    ]);
    Route::patch('eyeglass-orders/{eyeglassOrder}/mark-delivered', [EyeglassOrderController::class, 'markDelivered'])->middleware('permission:eyeglass-orders')
        ->name('eyeglass-orders.mark-delivered');

    Route::resource('checkups', EyeCheckupController::class)->middleware('permission:checkups');

    Route::get('sales-reports', [SalesReportController::class, 'index'])->middleware('permission:reports')->name('sales-reports.index');
    Route::get('sales-reports/export-csv', [SalesReportController::class, 'exportCsv'])->middleware('permission:reports')->name('sales-reports.export-csv');

    Route::middleware('role:Super Admin,Admin')->group(function () {
        Route::resource('users', UserController::class)->middleware('permission:users');
        Route::get('notifications', [NotificationController::class, 'index'])->middleware('permission:notifications')->name('notifications.index');
        Route::get('notifications/create', [NotificationController::class, 'create'])->middleware('permission:notifications')->name('notifications.create');
        Route::post('notifications', [NotificationController::class, 'store'])->middleware('permission:notifications')->name('notifications.store');
        Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->middleware('permission:notifications')->name('notifications.destroy');
        Route::get('branding', [SettingController::class, 'edit'])->middleware('permission:branding')->name('settings.edit');
        Route::post('branding', [SettingController::class, 'update'])->middleware('permission:branding')->name('settings.update');
        Route::get('permissions', [PermissionController::class, 'edit'])->middleware('permission:permissions')->name('permissions.edit');
        Route::post('permissions', [PermissionController::class, 'update'])->middleware('permission:permissions')->name('permissions.update');
    });
});
