<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // =====================================================
    // INDEX — Daftar Lomba → admin/dashboard.blade.php
    // =====================================================
    public function index()
    {
        $lomba = Lomba::latest()->get();

        return view('admin.dashboard', compact('lomba'));
    }

    // =====================================================
    // CREATE — Form tambah → admin/inputlomba.blade.php
    // =====================================================
    public function create()
    {
        return view('admin.inputlomba');
    }

    // =====================================================
    // STORE — Simpan lomba baru ke database
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'cabor' => 'required|string|max:255',
            'tingkat_wilayah' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'penyelenggara' => 'required|string|max:255',
            'biaya_pendaftaran' => 'nullable|numeric|min:0',
            'link' => 'nullable|url|max:500',
            'deskripsi' => 'required|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul lomba wajib diisi.',
            'kategori.required' => 'Kategori peserta wajib dipilih.',
            'cabor.required' => 'Cabang olahraga wajib diisi.',
            'tingkat_wilayah.required' => 'Tingkat wilayah wajib dipilih.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'penyelenggara.required' => 'Penyelenggara wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'link.url' => 'Format link pendaftaran tidak valid.',
            'poster.image' => 'File poster harus berupa gambar.',
            'poster.max' => 'Ukuran poster maksimal 2MB.',
        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        Lomba::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'cabor' => $request->cabor,
            'tingkat_wilayah' => $request->tingkat_wilayah,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'penyelenggara' => $request->penyelenggara,
            'biaya_pendaftaran' => $request->biaya_pendaftaran ?? 0,
            'link' => $request->link,
            'deskripsi' => $request->deskripsi,
            'poster' => $posterPath,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('toast_success', 'Lomba "' . $request->judul . '" berhasil ditambahkan!');
    }

    // =====================================================
    // EDIT — Form edit lomba (reuse inputlomba.blade.php)
    // =====================================================
    public function edit($id)
    {
        $lomba = Lomba::findOrFail($id);

        return view('admin.editlomba', compact('lomba'));
    }

    // =====================================================
    // UPDATE — Simpan perubahan ke database
    // =====================================================
    public function update(Request $request, $id)
    {
        $lomba = Lomba::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'cabor' => 'required|string|max:255',
            'tingkat_wilayah' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'penyelenggara' => 'required|string|max:255',
            'biaya_pendaftaran' => 'nullable|numeric|min:0',
            'link' => 'nullable|url|max:500',
            'deskripsi' => 'required|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul lomba wajib diisi.',
            'kategori.required' => 'Kategori peserta wajib dipilih.',
            'cabor.required' => 'Cabang olahraga wajib diisi.',
            'tingkat_wilayah.required' => 'Tingkat wilayah wajib dipilih.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'penyelenggara.required' => 'Penyelenggara wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'link.url' => 'Format link pendaftaran tidak valid.',
            'poster.image' => 'File poster harus berupa gambar.',
            'poster.max' => 'Ukuran poster maksimal 2MB.',
        ]);

        $posterPath = $lomba->poster;
        if ($request->hasFile('poster')) {
            if ($lomba->poster) {
                Storage::disk('public')->delete($lomba->poster);
            }
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        $lomba->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'cabor' => $request->cabor,
            'tingkat_wilayah' => $request->tingkat_wilayah,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'penyelenggara' => $request->penyelenggara,
            'biaya_pendaftaran' => $request->biaya_pendaftaran ?? 0,
            'link' => $request->link,
            'deskripsi' => $request->deskripsi,
            'poster' => $posterPath,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('toast_success', 'Lomba "' . $request->judul . '" berhasil diperbarui!');
    }

    // =====================================================
    // DESTROY — Hapus lomba dari database
    // =====================================================
    public function destroy($id)
    {
        $lomba = Lomba::findOrFail($id);

        if ($lomba->poster) {
            Storage::disk('public')->delete($lomba->poster);
        }

        $judul = $lomba->judul;
        $lomba->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('toast_success', 'Lomba "' . $judul . '" berhasil dihapus.');
    }
}
