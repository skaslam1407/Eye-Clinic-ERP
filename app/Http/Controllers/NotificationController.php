<?php

namespace App\Http\Controllers;

use App\Models\NotificationLog;
use App\Models\Patient;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $logs = NotificationLog::with('patient')->latest()->paginate(10);
        return view('notifications.index', compact('logs'));
    }

    public function create()
    {
        return view('notifications.create', [
            'patients' => Patient::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['nullable', 'exists:patients,id'],
            'channel' => ['required', 'in:SMS,WhatsApp,Push'],
            'type' => ['required', 'in:Eye Checkup Reminder,Appointment Reminder,Eye Camp Schedule'],
            'recipient' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string'],
        ]);

        $validated['sent_at'] = now();
        NotificationLog::create($validated);

        return redirect()->route('notifications.index')->with('success', 'Notification queued and logged.');
    }
}
