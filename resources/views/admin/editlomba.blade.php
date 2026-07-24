@extends('layouts.admin')

@section('title', 'Input Lomba')

@push('styles')
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --sidebar-w: 240px;
            --black: #0f0f0f;
            --dark: #1a1a1a;
            --accent: #2979ff;
            --accent2: #e8b800;
            --text-muted: #888;
            --bg: #f0f0f0;
            --card-bg: #ffffff;
            --radius: 14px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--black);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            border-right: 3px solid var(--accent);
            z-index: 100;
        }

        .sidebar-profile {
            padding: 28px 20px 24px;
            border-bottom: 1px solid #2a2a2a;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #2a2a2a;
            border: 2px solid var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            flex-shrink: 0;
        }

        .avatar svg {
            width: 24px;
            height: 24px;
        }

        .profile-info .name {
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            line-height: 1.2;
        }

        .profile-info .role {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 22px;
            color: #888;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all .18s ease;
            text-decoration: none;
            border-left: 3px solid transparent;
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .nav-item:hover {
            color: #fff;
            background: #1e1e1e;
        }

        .nav-item.active {
            color: #fff;
            background: #1e1e1e;
            border-left-color: var(--accent);
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid #2a2a2a;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 8px;
            transition: all .18s;
        }

        .btn-logout svg {
            width: 16px;
            height: 16px;
        }

        .btn-logout:hover {
            color: #ff4d4d;
            background: rgba(255, 77, 77, .08);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: #fff;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            border-bottom: 1px solid #e5e5e5;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 1.5px;
            color: var(--black);
            flex: 1;
        }

        .btn-back-top {
            display: flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            padding: 6px 16px;
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
        }

        /* ── PAGE CONTENT ── */
        .page-content {
            flex: 1;
            padding: 40px 36px;
        }

        /* ── FORM ── */
        .form-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 40px 44px;
            max-width: 720px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .08);
        }

        .form-header {
            margin-bottom: 32px;
        }

        .form-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 1.5px;
            color: var(--black);
            line-height: 1;
            margin-bottom: 6px;
        }

        .form-header p {
            font-size: 13px;
            color: var(--text-muted);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .8px;
            color: #444;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
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

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--accent);
            background: #fff;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* error state */
        .form-group input.is-error,
        .form-group select.is-error,
        .form-group textarea.is-error {
            border-color: #e53535;
            background: #fff8f8;
        }

        .error-msg {
            font-size: 11px;
            color: #e53535;
            margin-top: 5px;
            display: none;
        }

        .error-msg.show {
            display: block;
        }

        /* Laravel validation errors */
        .form-group .invalid-feedback {
            font-size: 11px;
            color: #e53535;
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media(max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-divider {
            height: 1px;
            background: #f0f0f0;
            margin: 28px 0;
        }

        .form-section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #bbb;
            margin-bottom: 18px;
        }

        /* ── POSTER UPLOAD ── */
        .upload-area {
            border: 2px dashed #e0e0e0;
            border-radius: 10px;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: border .2s, background .2s;
            background: #fafafa;
            position: relative;
        }

        .upload-area:hover {
            border-color: var(--accent);
            background: #f0f5ff;
        }

        .upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            border: none;
            background: none;
            padding: 0;
        }

        .upload-icon {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .upload-text {
            font-size: 13px;
            font-weight: 600;
            color: #555;
        }

        .upload-hint {
            font-size: 11px;
            color: #bbb;
            margin-top: 4px;
        }

        .upload-preview {
            margin-top: 12px;
            display: none;
        }

        .upload-preview img {
            max-height: 120px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        /* ── ACTIONS ── */
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

        .btn-submit:hover {
            background: var(--accent);
            transform: translateY(-1px);
        }

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

        .btn-cancel:hover {
            border-color: #999;
            color: #333;
        }

        /* ── ALERT ── */
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

        .alert-error ul {
            margin: 6px 0 0 16px;
        }

        .alert-error li {
            margin-bottom: 2px;
        }
    </style>
@endpush

@section('content')

    <header class="topbar">
        <div class="topbar-title">Edit Lomba</div>
        <a href="{{ route('admin.dashboard') }}" class="btn-back-top">
            ← Kembali
        </a>
    </header>

    <div class="page-content">
        <div class="form-card">

            <div class="form-header">
                <h2>Edit Lomba</h2>
                <p>Perbarui data lomba.</p>
            </div>

            @if($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.lomba.update', $lomba->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- JUDUL -->
                <div class="form-group">
                    <label>Nama Lomba</label>
                    <input type="text" name="judul" value="{{ old('judul', $lomba->judul) }}">
                </div>

                <!-- KATEGORI -->
                <div class="form-group">
                    <label>Kategori Peserta</label>
                    <select name="kategori">
                        <option value="">-- Pilih --</option>
                        @foreach($settings['kategoriPeserta'] as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $lomba->kategori) === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- CABOR -->
                <div class="form-group">
                    <label>Cabang Olahraga</label>
                    <select name="cabor">
                        <option value="">-- Pilih --</option>
                        @foreach($settings['cabangOlahraga'] as $cabor)
                            <option value="{{ $cabor }}" {{ old('cabor', $lomba->cabor) === $cabor ? 'selected' : '' }}>{{ $cabor }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- LOKASI -->
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $lomba->lokasi) }}">
                </div>

                <!-- TINGKAT -->
                <div class="form-group">
                    <label>Tingkat Wilayah</label>
                    <input type="text" name="tingkat_wilayah" value="{{ old('tingkat_wilayah', $lomba->tingkat_wilayah) }}">
                </div>

                <!-- TANGGAL MULAI -->
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai"
                        value="{{ old('tanggal_mulai', $lomba->tanggal_mulai ? \Carbon\Carbon::parse($lomba->tanggal_mulai)->format('Y-m-d') : '') }}">
                </div>

                <!-- TANGGAL SELESAI -->
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai"
                        value="{{ old('tanggal_selesai', $lomba->tanggal_selesai ? \Carbon\Carbon::parse($lomba->tanggal_selesai)->format('Y-m-d') : '') }}">
                </div>

                <!-- PENYELENGGARA -->
                <div class="form-group">
                    <label>Penyelenggara</label>
                    <input type="text" name="penyelenggara" value="{{ old('penyelenggara', $lomba->penyelenggara) }}">
                </div>

                {{-- Link + Deadline PESERTA --}}
                <div class="form-row">
                    <div class="form-group">
                        <label>Link Pendaftaran Peserta</label>
                        <input type="url" name="link" value="{{ old('link', $lomba->link) }}" placeholder="https://..." />
                    </div>
                    <div class="form-group">
                        <label>Deadline Pendaftaran Peserta</label>
                        <input type="date" name="deadline_pendaftaran"
                            value="{{ old('deadline_pendaftaran', $lomba->deadline_pendaftaran) }}"
                            class="{{ $errors->has('deadline_pendaftaran') ? 'is-error' : '' }}" />
                        @error('deadline_peserta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Link + Deadline PANITIA --}}
                <div class="form-row">
                    <div class="form-group">
                        <label>Link Pendaftaran Panitia</label>
                        <input type="url" name="link_pendaftaran_panitia"
                            value="{{ old('link_pendaftaran_panitia', $lomba->link_pendaftaran_panitia) }}"
                            placeholder="https://..." />
                    </div>
                    <div class="form-group">
                        <label>Deadline Pendaftaran Panitia</label>
                        <input type="date" name="deadline_panitia"
                            value="{{ old('deadline_panitia', $lomba->deadline_panitia) }}"
                            class="{{ $errors->has('deadline_panitia') ? 'is-error' : '' }}" />
                        @error('deadline_panitia')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- DESKRIPSI -->
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi">{{ old('deskripsi', $lomba->deskripsi) }}</textarea>
                </div>

                <!-- POSTER -->
                <div class="form-group">
                    <label>Poster</label>

                    @if($lomba->poster)
                        <div style="margin-bottom:10px;">
                            <img src="{{ asset('storage/' . $lomba->poster) }}" width="120">
                        </div>
                    @endif

                    <input type="file" name="poster">
                </div>

                <button type="submit" class="btn-submit">
                    Update Lomba
                </button>

            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function previewPoster(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('poster-preview-img').src = e.target.result;
                    document.getElementById('poster-preview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush