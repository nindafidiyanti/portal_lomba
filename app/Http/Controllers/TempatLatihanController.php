<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TempatLatihan;
use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TempatLatihanController extends Controller
{
    /**
     * Tampilkan daftar tempat latihan (dashboard).
     */
    public function index()
    {
        $tempatLatihan = TempatLatihan::latest()->get();
        return view('admin.tempatlatihan.dashboard', compact('tempatLatihan'));
    }

    public function publicIndex(Request $request)
    {
        $tempatLatihan = TempatLatihan::latest()->get();

        // Untuk filter pills (unik berdasarkan cabor)
        $cabors = TempatLatihan::whereNotNull('cabor')
            ->where('cabor', '!=', '')
            ->distinct()
            ->pluck('cabor');

        // Data untuk dropdown search global (navbar) & search lokal halaman ini
        $tempatJson = TempatLatihan::all()->map(function ($item) {
            return [
                'nama' => $item->nama_tempat,
                'cabang' => $item->cabor ?? '',
                'lokasi' => $item->alamat,
                'url' => route('tempatlatihan.show', $item->id),
            ];
        });

        $lombaJson = Lomba::all()->map(function ($item) {
            return [
                'nama' => $item->judul,
                'cabang' => $item->cabor ?? '',
                'lokasi' => $item->lokasi,
                'url' => route('lomba.detail', $item->id),
            ];
        });

        return view('tempatlatihan.index', compact('tempatLatihan', 'cabors', 'tempatJson', 'lombaJson'));
    }

    /**
     * Form tambah tempat latihan.
     */
    public function create()
    {
        return view('admin.tempatlatihan.inputlatihan');
    }

    /**
     * Simpan tempat latihan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:150',
            'alamat' => 'required|string',
            'cabor' => 'required|string|max:150',
            'link_maps' => 'nullable|url|max:500',
            'deskripsi' => 'nullable|string',
            'nama_pelatih' => 'required|string|max:150',
            'no_telepon' => 'nullable|string|max:20',
            'foto_tempat' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'in:aktif,nonaktif',
        ]);

        $data = $request->all();

        // Proses jadwal: filter yang hari-nya tidak kosong
        $jadwal = $request->jadwal ?? [];
        $jadwal = array_filter($jadwal, function ($item) {
            return !empty($item['hari']);
        });
        $data['jadwal'] = array_values($jadwal); // re-index

        if ($request->hasFile('foto_tempat')) {
            $validated['foto_tempat'] = $request->file('foto_tempat')
                ->store('tempat_latihan', 'public');
        }

        $validated['status'] = $request->input('status', 'aktif');

        TempatLatihan::create($validated);

        return redirect()->route('admin.tempatlatihan.index')
            ->with('toast_success', 'Tempat latihan berhasil ditambahkan!');
    }

    /**
     * Form edit tempat latihan.
     */
    public function edit(TempatLatihan $latihan)
    {
        return view('admin.tempatlatihan.editlatihan', compact('latihan'));
    }

    /**
     * Update tempat latihan.
     */
    public function update(Request $request, TempatLatihan $latihan)
    {
        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:150',
            'alamat' => 'required|string',
            'cabor' => 'required|string|max:150',
            'link_maps' => 'nullable|url|max:500',
            'deskripsi' => 'nullable|string',
            'nama_pelatih' => 'required|string|max:150',
            'no_telepon' => 'nullable|string|max:20',
            'foto_tempat' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'in:aktif,nonaktif',
        ]);

        $data = $request->all();

        // Proses jadwal
        $jadwal = $request->jadwal ?? [];
        $jadwal = array_filter($jadwal, function ($item) {
            return !empty($item['hari']);
        });
        $data['jadwal'] = array_values($jadwal);

        if ($request->hasFile('foto_tempat')) {
            // Hapus foto lama jika ada
            if ($latihan->foto_tempat) {
                Storage::disk('public')->delete($latihan->foto_tempat);
            }

            //Simpan foto baru 
            $validated['foto_tempat'] = $request->file('foto_tempat')
                ->store('tempat_latihan', 'public');
        } else {
            unset($validated['foto_tempat']); // jangan overwrite dengan null
        }

        $latihan->update($validated);

        return redirect()->route('admin.tempatlatihan.index')
            ->with('toast_success', 'Tempat latihan berhasil diperbarui!');
    }

    /**
     * Hapus tempat latihan (soft delete).
     */
    public function destroy(TempatLatihan $latihan)
    {
        if ($latihan->foto_tempat) {
            Storage::disk('public')->delete($latihan->foto_tempat);
        }

        $latihan->delete();

        return redirect()->route('admin.tempatlatihan.dashboard')
            ->with('toast_success', 'Tempat latihan berhasil dihapus!');
    }

    public function show(TempatLatihan $latihan)
    {
        $tempatJson = TempatLatihan::all()->map(fn($t) => [
            'nama' => $t->nama_tempat,
            'cabang' => $t->cabor ?? '',
            'lokasi' => $t->alamat,
            'url' => route('tempatlatihan.show', $t->id)
        ]);

        return view('tempatlatihan.detail', compact('latihan', 'tempatJson'));
    }
}
