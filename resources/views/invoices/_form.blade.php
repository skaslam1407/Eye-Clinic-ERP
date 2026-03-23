<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Patient</label>
        <select name="patient_id" class="form-select" required>
            <option value="">Select patient</option>
            @foreach($patients as $patient)
            <option value="{{ $patient->id }}" @selected(old('patient_id', $invoice->patient_id ?? '') == $patient->id)>{{ $patient->patient_code }} - {{ $patient->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Doctor</label>
        <select name="doctor_id" class="form-select">
            <option value="">Select doctor</option>
            @foreach($doctors as $doctor)
            <option value="{{ $doctor->id }}" @selected(old('doctor_id', $invoice->doctor_id ?? '') == $doctor->id)>{{ $doctor->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3"><label class="form-label">Eye Test Charges</label><input type="number" step="0.01" min="0" name="eye_test_charges" id="eye_test_charges" value="{{ old('eye_test_charges', $invoice->eye_test_charges ?? 0) }}" class="form-control" required></div>
    <div class="col-md-3"><label class="form-label">Eyeglass Charges</label><input type="number" step="0.01" min="0" name="eyeglass_charges" id="eyeglass_charges" value="{{ old('eyeglass_charges', $invoice->eyeglass_charges ?? 0) }}" class="form-control" required></div>
    <div class="col-md-3"><label class="form-label">Medicine Charges</label><input type="number" step="0.01" min="0" name="medicine_charges" id="medicine_charges" value="{{ old('medicine_charges', $invoice->medicine_charges ?? 0) }}" class="form-control" required></div>
    <div class="col-md-3"><label class="form-label">Total</label><input id="total_amount" class="form-control" value="{{ old('total_amount', $invoice->total_amount ?? 0) }}" readonly></div>
    <div class="col-md-6">
        <label class="form-label">Payment Status</label>
        <select name="payment_status" class="form-select" required>
            @foreach(['Paid','Pending'] as $status)
            <option value="{{ $status }}" @selected(old('payment_status', $invoice->payment_status ?? 'Pending') === $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Invoice Logo (optional)</label>
        <input type="file" name="logo" class="form-control" accept="image/*">
        @if(!empty($invoice?->logo_path))
            <div class="mt-2">
                <small class="text-muted d-block">Current logo</small>
                <img src="{{ asset('storage/'.$invoice->logo_path) }}" alt="Invoice logo" style="height:48px;width:auto;border-radius:8px;object-fit:contain;" />
            </div>
        @endif
    </div>
    <div class="col-md-6"><label class="form-label">Invoice Date</label><input type="date" name="invoice_date" value="{{ old('invoice_date', isset($invoice) ? $invoice->invoice_date?->format('Y-m-d') : now()->toDateString()) }}" class="form-control" required></div>
</div>
