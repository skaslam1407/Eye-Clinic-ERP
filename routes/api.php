<?php

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/patients', fn () => Patient::latest()->paginate(20));
Route::get('/patients/{patient}', fn (Patient $patient) => $patient);
Route::post('/patients', function (Request $request) {
    $data = $request->validate([
        'patient_code' => ['required', 'string', 'max:20', 'unique:patients,patient_code'],
        'name' => ['required', 'string', 'max:120'],
        'age' => ['required', 'integer', 'min:1', 'max:120'],
        'gender' => ['required', 'in:Male,Female,Other'],
        'phone' => ['required', 'string', 'max:20'],
        'address' => ['required', 'string', 'max:255'],
        'email' => ['nullable', 'email'],
        'eye_problem' => ['nullable', 'string'],
        'registration_date' => ['required', 'date'],
    ]);

    return response()->json(Patient::create($data), 201);
});

Route::get('/appointments', fn () => Appointment::with(['patient', 'doctor'])->latest()->paginate(20));
Route::get('/appointments/{appointment}', fn (Appointment $appointment) => $appointment->load(['patient', 'doctor']));

Route::get('/invoices', fn () => Invoice::with(['patient', 'doctor'])->latest()->paginate(20));
Route::get('/invoices/{invoice}', fn (Invoice $invoice) => $invoice->load(['patient', 'doctor']));
