<div class="row g-3">
<div class="col-md-6"><label class="form-label">Name</label><input name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" required></div>
<div class="col-md-4"><label class="form-label">Phone</label><input name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">Role</label><select name="role_id" class="form-select" required><option value="">Select role</option>@foreach($roles as $role)<option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>{{ $role->name }}</option>@endforeach</select></div>
<div class="col-md-4">
    <label class="form-label">Password {{ isset($user) ? '(leave blank to keep old)' : '' }}</label>
    <div class="input-group">
        <input type="password" id="password-field" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
        <button class="btn btn-outline-dark password-toggle" type="button" aria-label="Show password" data-target="password-field">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
        </button>
    </div>
    <button type="button" class="btn btn-outline-dark btn-sm mt-2" id="generate-password">Generate & fill new password</button>
</div>
<div class="col-md-4">
    <label class="form-label">Confirm Password</label>
    <div class="input-group">
        <input type="password" id="password-confirm-field" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
        <button class="btn btn-outline-dark password-toggle" type="button" aria-label="Show password confirmation" data-target="password-confirm-field">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
        </button>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.password-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = document.getElementById(btn.dataset.target);
                if (!input) return;
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                btn.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
            });
        });

        const genBtn = document.getElementById('generate-password');
        if (genBtn) {
            genBtn.addEventListener('click', () => {
                const pwd = Array.from(window.crypto.getRandomValues(new Uint8Array(12)))
                    .map(n => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%'.charAt(n % 67))
                    .join('');
                const p = document.getElementById('password-field');
                const c = document.getElementById('password-confirm-field');
                if (p) { p.type = 'text'; p.value = pwd; }
                if (c) { c.type = 'text'; c.value = pwd; }
            });
        }
    });
</script>
