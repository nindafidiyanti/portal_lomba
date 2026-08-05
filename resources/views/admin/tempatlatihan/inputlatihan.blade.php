@extends('layouts.admin')

@section('title', 'Tambah Tempat Latihan')

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

        /* Upload foto */
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

        /* ── JADWAL ROW ── */
        .jadwal-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
            margin-bottom: 12px;
            background: #f9f9f9;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .jadwal-row .form-group {
            flex: 1 1 0;
            min-width: 100px;
            margin-bottom: 0;
        }

        .jadwal-row .form-group:first-child {
            flex: 1.2;
            /* hari lebih lebar sedikit */
        }

        .jadwal-row .btn-remove-jadwal {
            flex-shrink: 0;
            height: 38px;
            width: 38px;
            background: #e53535;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            transition: background .2s;
        }

        .jadwal-row .btn-remove-jadwal:hover {
            background: #c41e1e;
        }

        /* Responsif: di layar kecil, semua input jadi 100% */
        @media (max-width: 600px) {
            .jadwal-row .form-group {
                flex: 1 1 100%;
                min-width: 100%;
            }

            .jadwal-row .btn-remove-jadwal {
                margin-left: auto;
                margin-top: 4px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- ═══════════ TOPBAR ═══════════ -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="topbar-title">INPUT TEMPAT LATIHAN</div>
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
                <span>Input Tempat Latihan</span>
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('admin.tempatlatihan.index') }}" class="btn-back-top">
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
                <h2>Tambah Tempat Latihan</h2>
                <p>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    Isi data di bawah untuk mendaftarkan tempat latihan baru.
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

            <form action="{{ route('admin.tempatlatihan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ── INFO TEMPAT ── --}}
                <div class="form-section-label">Informasi Tempat</div>

                <div class="form-group">
                    <label>Nama Tempat Latihan <span style="color:#e53535">*</span></label>
                    <input type="text" name="nama_tempat" value="{{ old('nama_tempat') }}"
                        placeholder="Contoh: Dojo Shotokan Indramayu"
                        class="{{ $errors->has('nama_tempat') ? 'is-error' : '' }}" />
                    @error('nama_tempat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Cabang Olahraga <span style="color:#e53535">*</span></label>
                    <select name="cabor" class="{{ $errors->has('cabor') ? 'is-error' : '' }}">
                        <option value="">-- Pilih --</option>
                        @foreach($settings['cabangOlahraga'] as $cabor)
                            <option value="{{ $cabor }}" {{ old('cabor') === $cabor ? 'selected' : '' }}>{{ $cabor }}</option>
                        @endforeach
                    </select>
                    @error('cabor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                {{-- ── JADWAL ── --}}
                <div class="form-divider"></div>
                <div class="form-section-label">Jadwal Latihan</div>

                <div id="jadwal-wrapper">
                    @php
                        $jadwalData = old('jadwal', [['hari' => '', 'jam_mulai' => '', 'jam_selesai' => '']]);
                        if (!is_array($jadwalData))
                            $jadwalData = [];
                        if (empty($jadwalData)) {
                            $jadwalData = [['hari' => '', 'jam_mulai' => '', 'jam_selesai' => '']];
                        }
                    @endphp

                    @foreach($jadwalData as $index => $j)
                        <div class="jadwal-row" data-index="{{ $index }}">
                            <div class="form-group">
                                <label>Hari</label>
                                <select name="jadwal[{{ $index }}][hari]" class="jadwal-hari">
                                    <option value="">-- Pilih --</option>
                                    <option value="Senin" {{ ($j['hari'] ?? '') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ ($j['hari'] ?? '') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ ($j['hari'] ?? '') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ ($j['hari'] ?? '') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ ($j['hari'] ?? '') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ ($j['hari'] ?? '') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ ($j['hari'] ?? '') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <input type="time" name="jadwal[{{ $index }}][jam_mulai]" value="{{ $j['jam_mulai'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <input type="time" name="jadwal[{{ $index }}][jam_selesai]"
                                    value="{{ $j['jam_selesai'] ?? '' }}">
                            </div>
                            <button type="button" class="btn-remove-jadwal" title="Hapus jadwal">×</button>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:12px; margin-bottom:24px;">
                    <button type="button" id="btn-tambah-jadwal" class="btn-tambah"
                        style="background:var(--accent);color:#fff;border:none;border-radius:8px;padding:8px 18px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
                        <span style="font-size:18px;line-height:1;">+</span> Tambah Jadwal
                    </button>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap <span style="color:#e53535">*</span></label>
                    <textarea name="alamat" placeholder="Contoh: Jl. Sudirman No. 10, Indramayu, Jawa Barat"
                        class="{{ $errors->has('alamat') ? 'is-error' : '' }}">{{ old('alamat') }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Link Google Maps<span style="color:#e53535">*</span></label>
                    <input type="url" name="link_maps" value="{{ old('link_maps') }}"
                        placeholder="https://maps.google.com/..."
                        class="{{ $errors->has('link_maps') ? 'is-error' : '' }}" />
                    @error('link_maps')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi"
                        placeholder="Informasi tambahan mengenai tempat latihan...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-divider"></div>

                {{-- ── CONTACT PERSON ── --}}
                <div class="form-section-label">Contact Person Pelatih</div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Pelatih <span style="color:#e53535">*</span></label>
                        <input type="text" name="nama_pelatih" value="{{ old('nama_pelatih') }}"
                            placeholder="Contoh: Sensei Budi"
                            class="{{ $errors->has('nama_pelatih') ? 'is-error' : '' }}" />
                        @error('nama_pelatih')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>No. Telepon / WhatsApp</label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                            placeholder="Contoh: 08123456789" />
                    </div>
                </div>

                <div class="form-divider"></div>

                {{-- ── MEDIA & STATUS ── --}}
                <div class="form-section-label">Media &amp; Status</div>

                <div class="form-group">
                    <label>Foto Tempat Latihan</label>
                    <div class="upload-area">
                        <input type="file" name="foto_tempat" accept="image/*" onchange="previewFoto(this)">
                        <div class="upload-icon">🏟️</div>
                        <div class="upload-text">Klik untuk upload foto</div>
                        <div class="upload-hint">PNG, JPG, WEBP — maks. 2MB</div>
                        <div class="upload-preview" id="foto-preview">
                            <img id="foto-preview-img" src="" alt="preview" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Simpan</button>
                    <a href="{{ route('admin.tempatlatihan.index') }}" class="btn-cancel">Batal</a>
                </div>

            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function previewFoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('foto-preview-img').src = e.target.result;
                    document.getElementById('foto-preview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('jadwal-wrapper');
            const btnTambah = document.getElementById('btn-tambah-jadwal');

            function getRowCount() {
                return wrapper.querySelectorAll('.jadwal-row').length;
            }

            function createRow(index) {
                const row = document.createElement('div');
                row.className = 'jadwal-row';
                row.dataset.index = index;
                row.innerHTML = `
                <div class="form-group">
                    <label>Hari</label>
                    <select name="jadwal[${index}][hari]" class="jadwal-hari">
                        <option value="">-- Pilih --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jam Mulai</label>
                    <input type="time" name="jadwal[${index}][jam_mulai]">
                </div>
                <div class="form-group">
                    <label>Jam Selesai</label>
                    <input type="time" name="jadwal[${index}][jam_selesai]">
                </div>
                <button type="button" class="btn-remove-jadwal" title="Hapus jadwal">×</button>
            `;
                return row;
            }

            // Tambah baris baru
            btnTambah.addEventListener('click', function () {
                const index = getRowCount();
                const row = createRow(index);
                wrapper.appendChild(row);

                // Event hapus untuk tombol baru
                row.querySelector('.btn-remove-jadwal').addEventListener('click', function () {
                    if (getRowCount() > 1) {
                        row.remove();
                    } else {
                        alert('Minimal harus ada satu jadwal. Jika tidak ingin, kosongkan saja hari dan jam.');
                    }
                });
            });

            // Event hapus untuk tombol yang sudah ada
            wrapper.querySelectorAll('.btn-remove-jadwal').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const row = this.closest('.jadwal-row');
                    if (getRowCount() > 1) {
                        row.remove();
                    } else {
                        alert('Minimal harus ada satu jadwal. Jika tidak ingin, kosongkan saja hari dan jam.');
                    }
                });
            });
        });
    </script>
@endpush