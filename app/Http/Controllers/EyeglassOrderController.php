<?php

namespace App\Http\Controllers;

use App\Models\EyeglassOrder;
use App\Models\Patient;
use Illuminate\Http\Request;

class EyeglassOrderController extends Controller
{
    public function index()
    {
        $orders = EyeglassOrder::with('patient')->latest()->paginate(10);
        return view('eyeglass-orders.index', compact('orders'));
    }

    public function create()
    {
        return view('eyeglass-orders.create', [
            'patients' => Patient::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'eyeglass_type' => ['required', 'string', 'max:120'],
            'lens_power' => ['required', 'string', 'max:120'],
            'order_date' => ['required', 'date'],
            'delivery_date' => ['nullable', 'date'],
            'delivery_status' => ['required', 'in:Pending,Delivered'],
        ]);

        EyeglassOrder::create($validated);
        return redirect()->route('eyeglass-orders.index')->with('success', 'Eyeglass order created.');
    }

    public function show(EyeglassOrder $eyeglassOrder)
    {
        return view('eyeglass-orders.show', ['order' => $eyeglassOrder->load('patient')]);
    }

    public function edit(EyeglassOrder $eyeglassOrder)
    {
        return view('eyeglass-orders.edit', [
            'order' => $eyeglassOrder,
            'patients' => Patient::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, EyeglassOrder $eyeglassOrder)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'eyeglass_type' => ['required', 'string', 'max:120'],
            'lens_power' => ['required', 'string', 'max:120'],
            'order_date' => ['required', 'date'],
            'delivery_date' => ['nullable', 'date'],
            'delivery_status' => ['required', 'in:Pending,Delivered'],
        ]);
        $eyeglassOrder->update($validated);

        return redirect()->route('eyeglass-orders.index')->with('success', 'Order updated.');
    }

    public function destroy(EyeglassOrder $eyeglassOrder)
    {
        $eyeglassOrder->delete();
        return redirect()->route('eyeglass-orders.index')->with('success', 'Order deleted.');
    }

    public function markDelivered(EyeglassOrder $eyeglassOrder)
    {
        $eyeglassOrder->update([
            'delivery_status' => 'Delivered',
            'delivery_date' => now()->toDateString(),
        ]);

        return redirect()->route('eyeglass-orders.index')->with('success', 'Order marked as delivered.');
    }
}
