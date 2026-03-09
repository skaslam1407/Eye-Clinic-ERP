<?php

namespace App\Http\Controllers;

use App\Models\EyeCheckup;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class EyeCheckupController extends Controller
{
    public function index()
    {
        $checkups = EyeCheckup::with(['patient', 'doctor'])->latest()->paginate(10);
        return view('checkups.index', compact('checkups'));
    }

    public function create()
    {
        return view('checkups.create', [
            'patients' => Patient::orderBy('name')->get(),
            'doctors' => User::whereHas('role', fn ($q) => $q->where('name', 'Doctor'))->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['nullable', 'exists:users,id'],
            'vision_test' => ['nullable', 'string', 'max:120'],
            'right_eye_vision' => ['nullable', 'string', 'max:60'],
            'left_eye_vision' => ['nullable', 'string', 'max:60'],
            'lens_power' => ['nullable', 'string', 'max:120'],
            'sph' => ['nullable', 'string', 'max:50'],
            'cyl' => ['nullable', 'string', 'max:50'],
            'axis' => ['nullable', 'string', 'max:50'],
            'eye_condition' => ['required', 'in:Cataract,Glaucoma,Dry Eye,Normal'],
            'doctor_notes' => ['nullable', 'string'],
            'prescription' => ['nullable', 'string'],
            'recommended_glasses' => ['nullable', 'string', 'max:255'],
            'follow_up_date' => ['nullable', 'date'],
        ]);

        EyeCheckup::create($validated);
        return redirect()->route('checkups.index')->with('success', 'Eye checkup saved.');
    }

    public function show(EyeCheckup $checkup)
    {
        return view('checkups.show', ['checkup' => $checkup->load(['patient', 'doctor'])]);
    }

    public function edit(EyeCheckup $checkup)
    {
        return view('checkups.edit', [
            'checkup' => $checkup,
            'patients' => Patient::orderBy('name')->get(),
            'doctors' => User::whereHas('role', fn ($q) => $q->where('name', 'Doctor'))->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, EyeCheckup $checkup)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['nullable', 'exists:users,id'],
            'vision_test' => ['nullable', 'string', 'max:120'],
            'right_eye_vision' => ['nullable', 'string', 'max:60'],
            'left_eye_vision' => ['nullable', 'string', 'max:60'],
            'lens_power' => ['nullable', 'string', 'max:120'],
            'sph' => ['nullable', 'string', 'max:50'],
            'cyl' => ['nullable', 'string', 'max:50'],
            'axis' => ['nullable', 'string', 'max:50'],
            'eye_condition' => ['required', 'in:Cataract,Glaucoma,Dry Eye,Normal'],
            'doctor_notes' => ['nullable', 'string'],
            'prescription' => ['nullable', 'string'],
            'recommended_glasses' => ['nullable', 'string', 'max:255'],
            'follow_up_date' => ['nullable', 'date'],
        ]);

        $checkup->update($validated);
        return redirect()->route('checkups.index')->with('success', 'Checkup updated.');
    }

    public function destroy(EyeCheckup $checkup)
    {
        $checkup->delete();
        return redirect()->route('checkups.index')->with('success', 'Checkup deleted.');
    }
}
