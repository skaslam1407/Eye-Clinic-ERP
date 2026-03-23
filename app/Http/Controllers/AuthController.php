<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectByRole(auth()->user());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }

    private function redirectByRole($user)
    {
        $role = optional($user->role)->name;

        return match ($role) {
            'Doctor' => redirect()->route('appointments.index'),
            'Staff' => redirect()->route('eyeglass-orders.index'),
            'Receptionist' => redirect()->route('appointments.index'),
            'Admin' => redirect()->route('dashboard'),
            'Super Admin' => redirect()->route('dashboard'),
            default => $this->redirectToFirstPermission($user),
        };
    }

    private function redirectToFirstPermission($user)
    {
        $features = config('permissions.features');
        $perms = optional($user->role)->permissions ?? [];

        // Fallback to defaults if empty
        if (empty($perms)) {
            $perms = config('permissions.defaults')[optional($user->role)->name] ?? [];
        }

        foreach ($features as $key => $label) {
            if (in_array($key, $perms, true)) {
                return redirect($this->featureRoute($key));
            }
        }

        return redirect()->route('dashboard');
    }

    private function featureRoute(string $feature): string
    {
        return match ($feature) {
            'dashboard' => route('dashboard'),
            'patients' => route('patients.index'),
            'appointments' => route('appointments.index'),
            'invoices' => route('invoices.index'),
            'eyeglass-orders' => route('eyeglass-orders.index'),
            'checkups' => route('checkups.index'),
            'reports' => route('sales-reports.index'),
            'users' => route('users.index'),
            'notifications' => route('notifications.index'),
            'branding' => route('settings.edit'),
            'permissions' => route('permissions.edit'),
            default => route('dashboard'),
        };
    }
}
