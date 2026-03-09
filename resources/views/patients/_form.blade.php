<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Name</label><input name="name" value="{{ old('name', $patient->name ?? '') }}" class="form-control" required></div>
    <div class="col-md-2"><label class="form-label">Age</label><input type="number" name="age" value="{{ old('age', $patient->age ?? '') }}" class="form-control" required></div>
    <div class="col-md-4">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-select" required>
            @foreach(['Male','Female','Other'] as $gender)
            <option value="{{ $gender }}" @selected(old('gender', $patient->gender ?? '') === $gender)>{{ $gender }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4"><label class="form-label">Phone</label><input name="phone" value="{{ old('phone', $patient->phone ?? '') }}" class="form-control" required></div>
    <div class="col-md-4"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email', $patient->email ?? '') }}" class="form-control"></div>
    <div class="col-md-4"><label class="form-label">Registration Date</label><input type="date" name="registration_date" value="{{ old('registration_date', isset($patient) ? $patient->registration_date?->format('Y-m-d') : now()->toDateString()) }}" class="form-control" required></div>
    <div class="col-md-12"><label class="form-label">Address</label><input name="address" value="{{ old('address', $patient->address ?? '') }}" class="form-control" required></div>
    <div class="col-md-12"><label class="form-label">Eye Problem</label><input name="eye_problem" value="{{ old('eye_problem', $patient->eye_problem ?? '') }}" class="form-control"></div>
</div>
