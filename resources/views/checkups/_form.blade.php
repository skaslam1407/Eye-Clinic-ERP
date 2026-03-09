<div class="row g-3">
<div class="col-md-6"><label class="form-label">Patient</label><select name="patient_id" class="form-select" required><option value="">Select</option>@foreach($patients as $patient)<option value="{{ $patient->id }}" @selected(old('patient_id', $checkup->patient_id ?? '') == $patient->id)>{{ $patient->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Doctor</label><select name="doctor_id" class="form-select"><option value="">Select</option>@foreach($doctors as $doctor)<option value="{{ $doctor->id }}" @selected(old('doctor_id', $checkup->doctor_id ?? '') == $doctor->id)>{{ $doctor->name }}</option>@endforeach</select></div>
<div class="col-md-3"><label class="form-label">Vision Test</label><input name="vision_test" value="{{ old('vision_test', $checkup->vision_test ?? '') }}" class="form-control"></div>
<div class="col-md-3"><label class="form-label">Right Eye Vision</label><input name="right_eye_vision" value="{{ old('right_eye_vision', $checkup->right_eye_vision ?? '') }}" class="form-control"></div>
<div class="col-md-3"><label class="form-label">Left Eye Vision</label><input name="left_eye_vision" value="{{ old('left_eye_vision', $checkup->left_eye_vision ?? '') }}" class="form-control"></div>
<div class="col-md-3"><label class="form-label">Lens Power</label><input name="lens_power" value="{{ old('lens_power', $checkup->lens_power ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">SPH</label><input name="sph" value="{{ old('sph', $checkup->sph ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">CYL</label><input name="cyl" value="{{ old('cyl', $checkup->cyl ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">Axis</label><input name="axis" value="{{ old('axis', $checkup->axis ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">Eye Condition</label><select name="eye_condition" class="form-select" required>@foreach(['Cataract','Glaucoma','Dry Eye','Normal'] as $condition)<option value="{{ $condition }}" @selected(old('eye_condition', $checkup->eye_condition ?? 'Normal') === $condition)>{{ $condition }}</option>@endforeach</select></div>
<div class="col-md-8"><label class="form-label">Recommended Glasses</label><input name="recommended_glasses" value="{{ old('recommended_glasses', $checkup->recommended_glasses ?? '') }}" class="form-control"></div>
<div class="col-md-6"><label class="form-label">Doctor Notes</label><textarea name="doctor_notes" class="form-control" rows="3">{{ old('doctor_notes', $checkup->doctor_notes ?? '') }}</textarea></div>
<div class="col-md-6"><label class="form-label">Prescription</label><textarea name="prescription" class="form-control" rows="3">{{ old('prescription', $checkup->prescription ?? '') }}</textarea></div>
<div class="col-md-4"><label class="form-label">Follow-up Date</label><input type="date" name="follow_up_date" value="{{ old('follow_up_date', isset($checkup) && $checkup->follow_up_date ? $checkup->follow_up_date->format('Y-m-d') : '') }}" class="form-control"></div>
</div>
