<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function edit()
    {
        $roles = Role::orderBy('name')->get();
        $features = config('permissions.features');

        return view('permissions.edit', compact('roles', 'features'));
    }

    public function update(Request $request)
    {
        $features = config('permissions.features');
        $rolesInput = $request->input('roles', []);

        Role::orderBy('name')->get()->each(function (Role $role) use ($rolesInput, $features) {
            $selected = $rolesInput[$role->id] ?? [];
            $clean = array_values(array_intersect(array_keys($features), $selected));

            // Super Admin always keeps full access
            if ($role->name === 'Super Admin') {
                $role->update(['permissions' => ['*']]);
                return;
            }

            $role->update(['permissions' => $clean]);
        });

        return back()->with('success', 'Permissions updated.');
    }
}
