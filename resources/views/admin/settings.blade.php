@extends('layouts.admin')

@section('title', 'Settings')

@push('styles')
    <style>
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

        .btn-back-top:hover {
            border-color: var(--black);
            color: var(--black);
            background: #fafafa;
        }

        .btn-back-top svg {
            width: 14px;
            height: 14px;
        }

        /* ── PAGE CONTENT ── */
        .page-content {
            padding: 40px 36px;
        }

        /* ── SETTINGS GRID ── */
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 32px;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* ── SETTINGS CARD ── */
        .settings-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
            border: 1px solid #f0f0f0;
        }

        .settings-card-header {
            padding: 20px 24px;
            background: var(--black);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .settings-card-header i {
            font-size: 24px;
            color: var(--accent);
        }

        .settings-card-header h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 1.5px;
            color: #fff;
            line-height: 1;
        }

        .settings-card-header p {
            font-size: 11px;
            color: #666;
            margin-top: 2px;
        }

        .settings-card-body {
            padding: 24px;
        }

        /* ── ADD FORM ── */
        .add-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .add-form input {
            flex: 1;
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

        .add-form input:focus {
            border-color: var(--accent);
            background: #fff;
        }

        .btn-add {
            background: var(--black);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 12px;
            font-family: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: var(--accent);
        }

        /* ── ITEMS LIST ── */
        .items-list {
            list-style: none;
            max-height: 320px;
            overflow-y: auto;
        }

        .items-list::-webkit-scrollbar {
            width: 6px;
        }

        .items-list::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 3px;
        }

        .items-list::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .items-list::-webkit-scrollbar-thumb:hover {
            background: #aaa;
        }

        .item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            border-radius: 8px;
            transition: background .15s;
            border-bottom: 1px solid #f5f5f5;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-row:hover {
            background: #f8f9fa;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item-icon {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .item-icon.cabor {
            background: rgba(41, 121, 255, .1);
            color: var(--accent);
        }

        .item-icon.kategori {
            background: rgba(232, 184, 0, .1);
            color: var(--accent2);
        }

        .item-icon i {
            font-size: 14px;
        }

        .item-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--black);
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edit-item,
        .btn-delete-item {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
        }

        .btn-edit-item {
            background: rgba(41, 121, 255, .1);
            color: var(--accent);
        }

        .btn-edit-item:hover {
            background: var(--accent);
            color: #fff;
        }

        .btn-delete-item {
            background: rgba(229, 53, 53, .1);
            color: #e53535;
        }

        .btn-delete-item:hover {
            background: #e53535;
            color: #fff;
        }

        .btn-edit-item i,
        .btn-delete-item i {
            font-size: 14px;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 32px 16px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 40px;
            opacity: .25;
            display: block;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 13px;
        }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 28px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .3);
        }

        .modal-header {
            margin-bottom: 20px;
        }

        .modal-header h4 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            letter-spacing: 1px;
            color: var(--black);
        }

        .modal-header p {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .modal-body input {
            width: 100%;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: border .2s;
        }

        .modal-body input:focus {
            border-color: var(--accent);
        }

        .modal-footer {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-modal-save {
            flex: 1;
            background: var(--black);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 13px;
            font-family: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-modal-save:hover {
            background: var(--accent);
        }

        .btn-modal-cancel {
            flex: 1;
            background: transparent;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 13px;
            font-family: inherit;
            font-weight: 600;
            color: #888;
            cursor: pointer;
            transition: all .18s;
        }

        .btn-modal-cancel:hover {
            border-color: #999;
            color: #333;
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
                padding: 24px 16px;
            }

            .settings-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <!-- ═══════════ TOPBAR ═══════════ -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="topbar-title">SETTINGS</div>
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
                <span>Settings</span>
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ route('admin.dashboard') }}" class="btn-back-top">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>
    </header>

    <div class="page-content">
        <div class="settings-grid">

            {{-- ══ CABANG OLAHRAGA ══ --}}
            <div class="settings-card">
                <div class="settings-card-header">
                    <i class="bi bi-trophy-fill"></i>
                    <div>
                        <h3>CABANG OLAHRAGA</h3>
                        <p>Kelola daftar cabang olahraga untuk filter</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <form action="{{ route('admin.settings.store') }}" method="POST" class="add-form">
                        @csrf
                        <input type="hidden" name="type" value="cabang_olahraga">
                        <input type="text" name="name" placeholder="Contoh: Karate" required>
                        <button type="submit" class="btn-add">Tambah</button>
                    </form>

                    <ul class="items-list">
                        @forelse($cabangOlahraga as $item)
                            <li class="item-row">
                                <div class="item-info">
                                    <div class="item-icon cabor">
                                        <i class="bi bi-dash"></i>
                                    </div>
                                    <span class="item-name">{{ $item->name }}</span>
                                </div>
                                <div class="item-actions">
                                    <button type="button" class="btn-edit-item"
                                        onclick="openEditModal('{{ $item->id }}', '{{ $item->name }}', 'cabang_olahraga')">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <form action="{{ route('admin.settings.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete-item"
                                            onclick="return confirm('Hapus &quot;{{ $item->name }}&quot;?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <div class="empty-state">
                                <i class="bi bi-trophy"></i>
                                <p>Belum ada cabang olahraga. Tambahkan yang pertama!</p>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- ══ KATEGORI PESERTA ══ --}}
            <div class="settings-card">
                <div class="settings-card-header">
                    <i class="bi bi-people-fill"></i>
                    <div>
                        <h3>KATEGORI PESERTA</h3>
                        <p>Kelola kategori peserta lomba</p>
                    </div>
                </div>
                <div class="settings-card-body">
                    <form action="{{ route('admin.settings.store') }}" method="POST" class="add-form">
                        @csrf
                        <input type="hidden" name="type" value="kategori_peserta">
                        <input type="text" name="name" placeholder="Contoh: SD/SMP/SMA" required>
                        <button type="submit" class="btn-add">Tambah</button>
                    </form>

                    <ul class="items-list">
                        @forelse($kategoriPeserta as $item)
                            <li class="item-row">
                                <div class="item-info">
                                    <div class="item-icon kategori">
                                        <i class="bi bi-dash"></i>
                                    </div>
                                    <span class="item-name">{{ $item->name }}</span>
                                </div>
                                <div class="item-actions">
                                    <button type="button" class="btn-edit-item"
                                        onclick="openEditModal('{{ $item->id }}', '{{ $item->name }}', 'kategori_peserta')">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <form action="{{ route('admin.settings.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete-item"
                                            onclick="return confirm('Hapus &quot;{{ $item->name }}&quot;?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <p>Belum ada kategori peserta. Tambahkan yang pertama!</p>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>

    {{-- ══ EDIT MODAL ══ --}}
    <div class="modal-overlay" id="editModal">
        <div class="modal">
            <div class="modal-header">
                <h4>Edit Data</h4>
                <p id="modalSubtitle">Ubah nama item</p>
            </div>
            <form action="" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" id="editType">
                <div class="modal-body">
                    <input type="text" name="name" id="editName" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-modal-save">Simpan</button>
                    <button type="button" class="btn-modal-cancel" onclick="closeEditModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openEditModal(id, name, type) {
            document.getElementById('editName').value = name;
            document.getElementById('editType').value = type;
            document.getElementById('editForm').action = '/admin/settings/' + id;
            document.getElementById('modalSubtitle').textContent = type === 'cabang_olahraga' ?
                'Ubah nama cabang olahraga' : 'Ubah nama kategori peserta';
            document.getElementById('editModal').classList.add('show');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('show');
        }

        // Tutup modal saat klik di luar
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Tutup modal dengan Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });
    </script>
@endpush
