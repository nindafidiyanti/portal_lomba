<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempatLatihan extends Model
{
    use SoftDeletes;

    protected $table = 'tempat_latihan';

    protected $fillable = [
        'nama_tempat',
        'alamat',
        'cabor',
        'link_maps',
        'deskripsi',
        'nama_pelatih',
        'no_telepon',
        'foto_tempat',
        'status',
        'jadwal',
    ];

    protected $casts = [
        'status' => 'string',
        'jadwal' => 'array',
    ];

    // Scope untuk filter aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
