<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();

        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'brand_color' => ['nullable', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
            'font_family' => ['nullable', 'in:Manrope,Inter,Poppins,Nunito,Work Sans'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        $setting = Setting::firstOrCreate([]);

        if ($request->hasFile('logo')) {
            if ($setting->logo_path) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('branding', 'public');
        }

        $setting->update($validated);

        cache()->forget('branding_settings');

        return back()->with('success', 'Branding updated successfully.');
    }
}
