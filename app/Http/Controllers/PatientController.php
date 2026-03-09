<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $search = request('search');
        $patients = Patient::query()
            ->when($search, function ($query, $searchTerm) {
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('patient_code', 'like', "%{$searchTerm}%")
                        ->orWhere('name', 'like', "%{$searchTerm}%")
                        ->orWhere('phone', 'like', "%{$searchTerm}%")
                        ->orWhere('email', 'like', "%{$searchTerm}%")
                        ->orWhere('eye_problem', 'like', "%{$searchTerm}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('patients.index', compact('patients', 'search'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:120'],
            'eye_problem' => ['nullable', 'string', 'max:255'],
            'registration_date' => ['required', 'date'],
        ]);

        $validated['patient_code'] = $this->nextPatientCode();
        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Patient added successfully.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:120'],
            'eye_problem' => ['nullable', 'string', 'max:255'],
            'registration_date' => ['required', 'date'],
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }

    private function nextPatientCode(): string
    {
        $lastId = (int) Patient::max('id') + 1;
        return 'PAT-' . str_pad((string) $lastId, 5, '0', STR_PAD_LEFT);
    }
}
