@extends('layouts.admin')

@section('title', 'Tambah Forum')

@push('styles')
<style>
    :root {
        --black: #0f0f0f; --accent: #2979ff; --text-muted: #888;
        --bg: #f0f0f0; --card-bg: #ffffff; --radius: 14px;
    }
    body { font-family: 'DM Sans', sans-serif; background: var(--bg); }

    /* ── TOPBAR ── */
    .topbar {
        background: var(--card-bg);
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 32px;
        border-bottom: 1px solid #e8e8e8;
        position: sticky;
        top: 0;
        z-index: 50;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
    }
    .topbar-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .topbar-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 26px;
        letter-spacing: 2px;
        color: var(--black);
    }
    .topbar-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-muted);
    }
    .topbar-breadcrumb a {
        color: var(--text-muted);
        text-decoration: none;
        transition: color .18s;
    }
    .topbar-breadcrumb a:hover {
        color: var(--accent);
    }
    .topbar-breadcrumb span {
        color: var(--black);
        font-weight: 600;
    }
    .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .btn-back-top {
        display: flex;
        align-items: center;
        gap: 7px;
        background: transparent;
        border: 1.5px solid #ddd;
        border-radius: 8px;
        padding: 8px 18px;
        font-size: 12px;
        font-weight: 600;
        font-family: inherit;
        color: #555;
        text-decoration: none;
        transition: all .18s;
    }
    .btn-back-top svg {
        width: 14px;
        height: 14px;
    }
    .btn-back-top:hover {
        border-color: var(--black);
        color: var(--black);
        background: #fafafa;
    }

    /* ── PAGE CONTENT ── */
    .page-content { padding: 40px 36px; }

    /* ── FORM CARD ── */
    .form-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 44px 48px;
        max-width: 800px;
        margin: 0 auto;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
        border: 1px solid #f0f0f0;
    }
    .form-header {
        margin-bottom: 36px;
        padding-bottom: 24px;
        border-bottom: 1px solid #f0f0f0;
    }
    .form-header h2 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 36px;
        letter-spacing: 2px;
        color: var(--black);
        line-height: 1;
        margin-bottom: 8px;
    }
    .form-header p {
        font-size: 13px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .form-header p svg {
        width: 14px;
        height: 14px;
    }

    .form-group { margin-bottom: 22px; }
    .form-group label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .8px;
        color: #444;
        text-transform: uppercase;
        margin-bottom: 7px;
    }
    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13px;
        font-family: inherit;
        outline: none;
        transition: border .2s, background .2s;
        color: var(--black);
        background: #fafafa;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: var(--accent);
        background: #fff;
    }
    .form-group textarea { resize: vertical; min-height: 100px; }
    .form-group input.is-error, .form-group select.is-error, .form-group textarea.is-error {
        border-color: #e53535;
        background: #fff8f8;
    }
    .form-group .invalid-feedback { font-size: 11px; color: #e53535; margin-top: 5px; }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .form-divider { height: 1px; background: #f0f0f0; margin: 28px 0; }
    .form-section-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #bbb;
        margin-bottom: 18px;
    }

    /* Actions */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 36px;
        padding-top: 28px;
        border-top: 1px solid #f0f0f0;
    }
    .btn-submit {
        background: var(--black);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px 36px;
        font-size: 14px;
        font-family: inherit;
        font-weight: 700;
        letter-spacing: .5px;
        cursor: pointer;
        transition: background .2s, transform .15s;
    }
    .btn-submit:hover { background: var(--accent); transform: translateY(-1px); }
    .btn-cancel {
        background: transparent;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 13px;
        font-family: inherit;
        font-weight: 600;
        color: #888;
        cursor: pointer;
        text-decoration: none;
        transition: all .18s;
        display: inline-flex;
        align-items: center;
    }
    .btn-cancel:hover { border-color: #999; color: #333; }

    .alert-error {
        background: #fff0f0;
        border: 1.5px solid #fcc;
        border-left: 4px solid #e53535;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 24px;
        font-size: 13px;
        color: #c0392b;
    }
    .alert-error ul { margin: 6px 0 0 16px; }
    .alert-error li { margin-bottom: 2px; }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
        .topbar {
            padding: 0 20px;
            height: 60px;
        }
        .topbar-title {
            font-size: 20px;
        }
        .topbar-breadcrumb {
            display: none;
        }
        .page-content {
            padding: 24px 20px;
        }
        .form-card {
            padding: 28px 24px;
            border-radius: 12px;
        }
        .form-header h2 {
            font-size: 28px;
        }
    }

    @media (max-width: 480px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- ═══════════ TOPBAR ═══════════ -->
<header class="topbar">
    <div class="topbar-left">
        <div class="topbar-title">INPUT FORUM</div>
        <div class="topbar-breadcrumb">
            <a href="{{ route('admin.dashboard') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
            </a>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;color:#ccc">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
            <span>Input Forum</span>
        </div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('admin.forum.index') }}" class="btn-back-top">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>
</header>

<div class="page-content">
    <div class="form-card">

        <div class="form-header">
            <h2>Tambah Forum</h2>
            <p>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="12"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
                Isi data di bawah untuk membuat postingan forum baru.
            </p>
        </div>

        @if($errors->any())
        <div class="alert-error">
            <strong>Terdapat kesalahan:</strong>
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.forum.store') }}" method="POST">
            @csrf

            {{-- ── INFO FORUM ── --}}
            <div class="form-section-label">Informasi Forum</div>

            <div class="form-group">
                <label>Judul Postingan <span style="color:#e53535">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                       placeholder="Contoh: Tips Memilih Tempat Latihan Karate"
                       class="{{ $errors->has('title') ? 'is-error' : '' }}"/>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Cabang Olahraga</label>
                <input type="text" name="cabor" value="{{ old('cabor') }}"
                       placeholder="Contoh: Karate, Taekwondo, Pencak Silat"
                       class="{{ $errors->has('cabor') ? 'is-error' : '' }}"/>
                @error('cabor')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Isi Postingan <span style="color:#e53535">*</span></label>
                <textarea name="content" rows="8"
                          placeholder="Tulis konten forum di sini..."
                          class="{{ $errors->has('content') ? 'is-error' : '' }}">{{ old('content') }}</textarea>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan</button>
                <a href="{{ route('admin.forum.index') }}" class="btn-cancel">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection
