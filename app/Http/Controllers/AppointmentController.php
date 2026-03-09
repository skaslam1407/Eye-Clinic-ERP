<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $status = request('status');
        $appointments = Appointment::with(['patient', 'doctor'])
            ->when($status, fn ($query, $value) => $query->where('status', $value))
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->paginate(10)
            ->withQueryString();

        return view('appointments.index', compact('appointments', 'status'));
    }

    public function create()
    {
        return view('appointments.create', [
            'patients' => Patient::orderBy('name')->get(),
            'doctors' => User::whereHas('role', fn ($q) => $q->where('name', 'Doctor'))->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['nullable', 'exists:users,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'status' => ['required', 'in:Pending,Approved,Cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        Appointment::create($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment requested successfully.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient', 'doctor']);
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
            'patients' => Patient::orderBy('name')->get(),
            'doctors' => User::whereHas('role', fn ($q) => $q->where('name', 'Doctor'))->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['nullable', 'exists:users,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'status' => ['required', 'in:Pending,Approved,Cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $appointment->update($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    public function approve(Appointment $appointment)
    {
        $appointment->update(['status' => 'Approved']);
        return redirect()->route('appointments.index')->with('success', 'Appointment approved.');
    }

    public function reject(Appointment $appointment)
    {
        $appointment->update(['status' => 'Cancelled']);
        return redirect()->route('appointments.index')->with('success', 'Appointment rejected.');
    }

    public function calendar()
    {
        $appointments = Appointment::with(['patient', 'doctor'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();
        return view('appointments.calendar', compact('appointments'));
    }
}
