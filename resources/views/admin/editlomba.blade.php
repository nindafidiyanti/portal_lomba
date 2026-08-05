@extends('layouts.admin')

@section('title', 'Edit Lomba')

@push('styles')
    <style>
        :root {
            --black: #0f0f0f;
            --accent: #2979ff;
            --text-muted: #888;
            --bg: #f0f0f0;
            --card-bg: #ffffff;
            --radius: 14px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
        }

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
        .page-content {
            padding: 40px 36px;
        }

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

        .form-group input.is-error,
        .form-group select.is-error,
        .form-group textarea.is-error {
            border-color: #e53535;
            background: #fff8f8;
        }

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
            <div class="topbar-title">EDIT LOMBA</div>
            <div class="topbar-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        style="width:12px;height:12px">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </a>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    style="width:12px;height:12px;color:#ccc">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
                <span>Edit Lomba</span>
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('admin.dashboard') }}" class="btn-back-top">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>
    </header>

    <div class="page-content">
        <div class="form-card">

            <div class="form-header">
                <h2>Edit Lomba</h2>
                <p>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    Perbarui data lomba di bawah.
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

            <form action="{{ route('admin.lomba.update', $lomba->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ── INFO DASAR ── --}}
                <div class="form-section-label">Informasi Dasar</div>

                <div class="form-group">
                    <label>Nama Lomba <span style="color:#e53535">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $lomba->judul) }}"
                        placeholder="Contoh: Kapolres Cup I" class="{{ $errors->has('judul') ? 'is-error' : '' }}" />
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori Peserta <span style="color:#e53535">*</span></label>
                        <select name="kategori" class="{{ $errors->has('kategori') ? 'is-error' : '' }}">
                            <option value="">-- Pilih --</option>
                            @foreach($settings['kategoriPeserta'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $lomba->kategori) === $kat ? 'selected' : '' }}>
                                    {{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Cabang Olahraga <span style="color:#e53535">*</span></label>
                        <select name="cabor" class="{{ $errors->has('cabor') ? 'is-error' : '' }}">
                            <option value="">-- Pilih --</option>
                            @foreach($settings['cabangOlahraga'] as $cabor)
                                <option value="{{ $cabor }}" {{ old('cabor', $lomba->cabor) === $cabor ? 'selected' : '' }}>
                                    {{ $cabor }}</option>
                            @endforeach
                        </select>
                        @error('cabor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-divider"></div>

                {{-- ── WAKTU & TEMPAT ── --}}
                <div class="form-section-label">Waktu &amp; Tempat</div>

                <div class="form-group">
                    <label>Lokasi <span style="color:#e53535">*</span></label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $lomba->lokasi) }}"
                        placeholder="Contoh: Gor Bima Cirebon" class="{{ $errors->has('lokasi') ? 'is-error' : '' }}" />
                    @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Tingkat Wilayah <span style="color:#e53535">*</span></label>
                    <input type="text" name="tingkat_wilayah" value="{{ old('tingkat_wilayah', $lomba->tingkat_wilayah) }}"
                        placeholder="Contoh: Jawa Barat" class="{{ $errors->has('tingkat_wilayah') ? 'is-error' : '' }}" />
                    @error('tingkat_wilayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tanggal Mulai <span style="color:#e53535">*</span></label>
                        <input type="date" name="tanggal_mulai"
                            value="{{ old('tanggal_mulai', $lomba->tanggal_mulai ? \Carbon\Carbon::parse($lomba->tanggal_mulai)->format('Y-m-d') : '') }}"
                            class="{{ $errors->has('tanggal_mulai') ? 'is-error' : '' }}" />
                        @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai <span style="color:#e53535">*</span></label>
                        <input type="date" name="tanggal_selesai"
                            value="{{ old('tanggal_selesai', $lomba->tanggal_selesai ? \Carbon\Carbon::parse($lomba->tanggal_selesai)->format('Y-m-d') : '') }}"
                            class="{{ $errors->has('tanggal_selesai') ? 'is-error' : '' }}" />
                        @error('tanggal_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-divider"></div>

                {{-- ── DETAIL TAMBAHAN ── --}}
                <div class="form-section-label">Detail Tambahan</div>

                <div class="form-group">
                    <label>Penyelenggara</label>
                    <input type="text" name="penyelenggara" value="{{ old('penyelenggara', $lomba->penyelenggara) }}"
                        placeholder="Contoh: Polres Cirebon" />
                </div>

                <div class="form-group">
                    <label>Link Pendaftaran Peserta</label>
                    <input type="url" name="link" value="{{ old('link', $lomba->link) }}" placeholder="https://..." />
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi"
                        placeholder="Informasi tambahan mengenai lomba...">{{ old('deskripsi', $lomba->deskripsi) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Poster / Gambar</label>
                    <div class="upload-area" onclick="document.getElementById('poster-input').click()">
                        <input type="file" id="poster-input" name="poster" accept="image/*" onchange="previewPoster(this)"
                            onclick="event.stopPropagation()">

                        <div class="upload-icon">🖼️</div>
                        <div class="upload-text">Klik untuk upload poster</div>
                        <div class="upload-hint">PNG, JPG, WEBP — maks. 2MB</div>

                        @if($lomba->poster)
                            <div class="upload-preview" style="display:block;">
                                <img src="{{ asset('storage/' . $lomba->poster) }}" alt="poster lama" />
                            </div>
                        @endif

                        <div class="upload-preview" id="poster-preview" style="display:none;">
                            <img id="poster-preview-img" src="" alt="preview" />
                        </div>
                    </div>
                </div>

                {{-- ── ACTIONS ── --}}
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Update Lomba</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Batal</a>
                </div>

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
                    const preview = document.getElementById('poster-preview');
                    const img = document.getElementById('poster-preview-img');
                    img.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush