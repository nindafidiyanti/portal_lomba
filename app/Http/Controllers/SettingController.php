<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $cabangOlahraga = Setting::cabangOlahraga()->orderBy('name')->get();
        $kategoriPeserta = Setting::kategoriPeserta()->orderBy('name')->get();

        return view('admin.settings', compact('cabangOlahraga', 'kategoriPeserta'));
    }

    /**
     * Store new setting (cabang olahraga or kategori peserta)
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:cabang_olahraga,kategori_peserta',
            'name' => 'required|string|max:255|unique:settings,name,NULL,id,type,' . $request->type,
        ], [
            'name.unique' => 'Data ini sudah ada sebelumnya.',
        ]);

        Setting::create([
            'type' => $request->type,
            'name' => $request->name,
        ]);

        $label = $request->type === 'cabang_olahraga' ? 'Cabang Olahraga' : 'Kategori Peserta';

        return redirect()->back()->with('toast_success', $label . ' "' . $request->name . '" berhasil ditambahkan.');
    }

    /**
     * Update existing setting
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:settings,name,' . $id . ',id,type,' . $setting->type,
        ], [
            'name.unique' => 'Data ini sudah ada sebelumnya.',
        ]);

        $oldName = $setting->name;
        $setting->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('toast_success', 'Berhasil diperbarui menjadi "' . $setting->name . '".');
    }

    /**
     * Delete setting
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $name = $setting->name;
        $setting->delete();

        return redirect()->back()->with('toast_success', '"' . $name . '" berhasil dihapus.');
    }
}
