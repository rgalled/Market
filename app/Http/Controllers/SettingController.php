<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'maxImages' => 'required|integer|min:1',
        ]);

        $setting->update([
            'name' => $request->name,
            'maxImages' => $request->maxImages,
        ]);

        return redirect()->route('settings.index')->with('success', 'Configuración actualizada exitosamente.');
    }
}