<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lomba extends Model
{
    protected $table = 'lombas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'penyelenggara',
        'cabor',
        'kategori',
        'tingkat_wilayah',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'biaya_pendaftaran',
        'poster',
        'link',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'biaya_pendaftaran' => 'decimal:2',
    ];

    // ── ACCESSORS ──

    /** URL lengkap poster, atau null jika tidak ada */
    public function getPosterUrlAttribute(): ?string
    {
        return $this->poster ? Storage::url($this->poster) : null;
    }

    /** Format tanggal tampilan: "01 Jun 2026 – 02 Jun 2026" */
    public function getTanggalAttribute(): string
    {
        $start = $this->tanggal_mulai?->translatedFormat('d M Y') ?? '-';
        $end = $this->tanggal_selesai?->translatedFormat('d M Y') ?? '-';
        return $start === $end ? $start : "{$start} – {$end}";
    }

    /** Format biaya: "Gratis" atau "Rp 50.000" */
    public function getBiayaFormatAttribute(): string
    {
        if (!$this->biaya_pendaftaran || $this->biaya_pendaftaran == 0) {
            return 'Gratis';
        }
        return 'Rp ' . number_format($this->biaya_pendaftaran, 0, ',', '.');
    }

    public function getStatusOtomatisAttribute(): string
    {
        $now = \Carbon\Carbon::now();

        // Closed: sudah lewat tanggal_selesai
        if ($this->tanggal_selesai && \Carbon\Carbon::parse($this->tanggal_selesai)->isPast()) {
            return 'closed';
        }

        // New: dibuat KURANG dari 24 jam yang lalu
        if ($this->created_at && $this->created_at->gt($now->subHours(24))) {
            return 'new';
        }

        // Open: sudah lebih dari 24 jam
        return 'open';
    }
}
