<div class="row g-3">
<div class="col-md-6"><label class="form-label">Name</label><input name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" required></div>
<div class="col-md-4"><label class="form-label">Phone</label><input name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">Role</label><select name="role_id" class="form-select" required><option value="">Select role</option>@foreach($roles as $role)<option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>{{ $role->name }}</option>@endforeach</select></div>
<div class="col-md-4"><label class="form-label">Password {{ isset($user) ? '(leave blank to keep old)' : '' }}</label><input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}></div>
<div class="col-md-4"><label class="form-label">Confirm Password</label><input type="password" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}></div>
</div>
