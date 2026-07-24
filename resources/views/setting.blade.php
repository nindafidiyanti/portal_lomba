@extends('layouts.app')

@section('title', 'Pengaturan Akun - LombaKU')
@section('page_label', 'PENGATURAN')

@push('styles')
    <style>
        .settings-wrap {
            padding: 20px 16px 32px;
            max-width: 600px;
            margin: 0 auto;
        }
        .settings-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
        }
        .settings-card-header {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 14px 16px 8px;
            border-bottom: 1px solid #f0f0f0;
        }
        .settings-item {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            border-bottom: 1px solid #f5f5f5;
            gap: 14px;
        }
        .settings-item:last-child {
            border-bottom: none;
        }
        .settings-item .label {
            font-weight: 500;
            font-size: 14px;
            color: var(--black);
            min-width: 100px;
        }
        .settings-item .value {
            font-size: 14px;
            color: var(--text-muted);
            flex: 1;
        }
        .settings-item .value input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        .settings-item .value input:focus {
            border-color: var(--accent);
            outline: none;
        }
        .settings-item .action {
            margin-left: auto;
        }
        .btn-save {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-save:hover {
            background: #1a5fd0;
        }
        .btn-danger {
            background: #e53535;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
        }
        .btn-danger:hover {
            background: #c41e1e;
        }
        .text-muted {
            color: var(--text-muted);
            font-size: 12px;
        }
        .error-text {
            color: #e53535;
            font-size: 12px;
            margin-top: 4px;
        }
        .back-link {
            display: inline-block;
            margin-top: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
<div class="settings-wrap">

    {{-- ── INFORMASI AKUN (READ-ONLY) ── --}}
    <div class="settings-card">
        <div class="settings-card-header">Informasi Akun</div>
        <div class="settings-item">
            <span class="label">Nama</span>
            <span class="value">{{ $user->name }}</span>
        </div>
        <div class="settings-item">
            <span class="label">Email</span>
            <span class="value">{{ $user->email }}</span>
        </div>
        <div class="settings-item">
            <span class="label">Bergabung</span>
            <span class="value">{{ $user->created_at->format('d M Y') }}</span>
        </div>
    </div>

    {{-- ── FORM UPDATE NAMA & EMAIL ── --}}
    <div class="settings-card">
        <div class="settings-card-header">Edit Profil</div>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="settings-item">
                <span class="label">Nama</span>
                <div class="value">
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="action">
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </div>
            @error('name')
                <div class="settings-item" style="border-top: none; padding-top: 0;">
                    <span class="error-text">{{ $message }}</span>
                </div>
            @enderror

            <div class="settings-item">
                <span class="label">Email</span>
                <div class="value">
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="action">
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </div>
            @error('email')
                <div class="settings-item" style="border-top: none; padding-top: 0;">
                    <span class="error-text">{{ $message }}</span>
                </div>
            @enderror
        </form>
    </div>

    {{-- ── FORM GANTI PASSWORD ── --}}
    <div class="settings-card">
        <div class="settings-card-header">Ganti Password</div>
        <form action="{{ route('profile.update-password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="settings-item">
                <span class="label">Password Lama</span>
                <div class="value">
                    <input type="password" name="current_password" placeholder="Masukkan password lama" required>
                </div>
            </div>
            @error('current_password')
                <div class="settings-item" style="border-top: none; padding-top: 0;">
                    <span class="error-text">{{ $message }}</span>
                </div>
            @enderror

            <div class="settings-item">
                <span class="label">Password Baru</span>
                <div class="value">
                    <input type="password" name="new_password" placeholder="Minimal 6 karakter" required>
                </div>
            </div>

            <div class="settings-item">
                <span class="label">Konfirmasi</span>
                <div class="value">
                    <input type="password" name="new_password_confirmation" placeholder="Ulangi password baru" required>
                </div>
                <div class="action">
                    <button type="submit" class="btn-danger">Ganti Password</button>
                </div>
            </div>
            @error('new_password')
                <div class="settings-item" style="border-top: none; padding-top: 0;">
                    <span class="error-text">{{ $message }}</span>
                </div>
            @enderror
        </form>
    </div>

    <a href="{{ route('profil') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Profil
    </a>
</div>
@endsection