<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\EyeglassOrder;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $todayRevenue = Invoice::whereDate('invoice_date', now()->toDateString())->sum('total_amount');

        return view('dashboard.index', [
            'patientsCount' => Patient::count(),
            'pendingAppointments' => Appointment::where('status', 'Pending')->count(),
            'pendingDeliveries' => EyeglassOrder::where('delivery_status', 'Pending')->count(),
            'todayRevenue' => $todayRevenue,
            'latestAppointments' => Appointment::with(['patient', 'doctor'])->latest()->take(5)->get(),
        ]);
    }
}
