<?php

namespace App\Http\Controllers;

use App\Models\NotificationLog;
use App\Models\Patient;
use App\Services\Msg91Service;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(private Msg91Service $msg91)
    {
    }

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
        $log = NotificationLog::create($validated);

        if ($validated['channel'] === 'SMS') {
            $resp = $this->msg91->sendSms($validated['recipient'], $validated['message'], [
                'patient' => optional($log->patient)->name,
            ]);

            $log->update([
                'status' => $resp['ok'] ? 'Sent' : 'Failed',
                'provider_id' => $resp['message_id'] ?? null,
                'error' => $resp['ok'] ? null : json_encode($resp['body']),
            ]);
        } else {
            $log->update(['status' => 'Skipped']);
        }

        return redirect()->route('notifications.index')->with('success', 'Notification queued and logged.');
    }

    public function destroy(NotificationLog $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification log deleted.');
    }
}
