<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\TempatLatihan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LombaController extends Controller
{
    // =====================================================
    // INDEX — Landing page publik → daftar-lomba.blade.php
    // =====================================================
// Di LombaController.php atau controller yang me-render landing page
    public function index()
    {
        $lomba = Lomba::whereDate(
            'tanggal_selesai',
            '>=',
            now()->subDay()->toDateString()
        )->latest()->get();

        $tempatLatihan = TempatLatihan::latest()->get();

        // Siapkan data JSON untuk search
        $lombaJson = $lomba->map(function ($item) {
            return [
                'nama' => $item->judul,
                'cabang' => $item->cabor ?? '',
                'lokasi' => $item->lokasi,
                'url' => route('lomba.detail', $item->id)
            ];
        });

        $tempatJson = $tempatLatihan->map(function ($item) {
            return [
                'nama' => $item->nama_tempat,
                'cabang' => $item->cabor ?? '',
                'lokasi' => $item->alamat,
                'url' => route('tempatlatihan.show', $item->id)
            ];
        });

        return view('landing', compact('lomba', 'tempatLatihan', 'lombaJson', 'tempatJson'));
    }

    // =====================================================
    // SHOW — Detail lomba publik → detail-lomba.blade.php
    // =====================================================
    public function show($id)
    {
        $lomba = Lomba::findOrFail($id);

        return view('detail', compact('lomba'));
    }
}
