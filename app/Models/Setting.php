<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
    ];

    /**
     * Scope for cabang olahraga
     */
    public function scopeCabangOlahraga($query)
    {
        return $query->where('type', 'cabang_olahraga');
    }

    /**
     * Scope for kategori peserta
     */
    public function scopeKategoriPeserta($query)
    {
        return $query->where('type', 'kategori_peserta');
    }

    /**
     * Get all cabang olahraga as array for dropdown
     */
    public static function getCabangOlahraga()
    {
        return self::cabangOlahraga()->pluck('name')->toArray();
    }

    /**
     * Get all kategori peserta as array for dropdown
     */
    public static function getKategoriPeserta()
    {
        return self::kategoriPeserta()->pluck('name')->toArray();
    }
}
