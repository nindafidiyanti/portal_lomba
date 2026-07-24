@extends('layouts.admin')

@push('styles')
    <style>
        :root {
            --black: #0f0f0f;
            --accent: #2979ff;
            --accent2: #e8b800;
            --text-muted: #888;
            --bg: #f0f0f0;
            --card-bg: #fff;
            --radius: 14px;
        }

        body { font-family: 'DM Sans', sans-serif; background: var(--bg); }

        /* ══ TOPBAR ══ */
        .topbar {
            background: var(--card-bg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            border-bottom: 1px solid #e8e8e8;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        .topbar-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .topbar-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            letter-spacing: 2px;
            color: var(--black);
            line-height: 1;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
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
            gap: 12px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f5f5f5;
            padding: 6px 8px 6px 12px;
            border-radius: 10px;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .search-input {
            border: none;
            border-radius: 0;
            padding: 8px 12px;
            font-size: 13px;
            font-family: inherit;
            width: 200px;
            outline: none;
            transition: background .2s;
            background: transparent;
        }

        .search-input:focus {
            background: #fff;
        }

        .btn-search {
            background: transparent;
            color: var(--text-muted);
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 13px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-search:hover {
            color: var(--accent);
            background: #fff;
        }

        .btn-search svg {
            width: 16px;
            height: 16px;
        }

        .btn-tambah {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-size: 13px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: .3px;
            transition: all .2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-tambah:hover {
            background: #1565c0;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(41, 121, 255, .3);
        }

        .btn-tambah svg {
            width: 16px;
            height: 16px;
        }

        /* ══ PAGE CONTENT ══ */
        .page-content {
            padding: 40px 36px;
        }

        /* ══ SECTION HEADER ══ */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 1.5px;
            color: var(--black);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title svg {
            width: 24px;
            height: 24px;
            color: var(--accent);
        }

        .section-count {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .section-count strong {
            color: var(--black);
            font-weight: 700;
        }

        /* ══ CARDS GRID — 2 columns ══ */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        /* ══ LOMBA CARD ══ */
        .lomba-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: visible;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
            border: 1px solid #f0f0f0;
            transition: transform .25s, box-shadow .25s;
            position: relative;
        }

        .lomba-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, .12);
            border-color: #e8e8e8;
        }

        /* clip only poster area */
        .card-poster-wrap {
            border-radius: 16px 16px 0 0;
            overflow: hidden;
            position: relative;
        }

        /* ══ POSTER ══ */
        .card-poster {
            height: 180px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 14px 12px 10px;
        }

        .card-poster img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-poster-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.4) 100%);
        }

        .card-poster-logos {
            display: flex;
            gap: 6px;
            margin-bottom: 6px;
            position: relative;
            z-index: 2;
        }

        .logo-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .8);
            border: 1px solid rgba(0, 0, 0, .12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #333;
            font-weight: 700;
        }

        .card-poster-trophy {
            font-size: 32px;
            margin: 8px 0 4px;
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.2));
        }

        .card-poster-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            color: #fff;
            letter-spacing: 1.5px;
            text-align: center;
            line-height: 1.2;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .card-poster-sub {
            font-size: 10px;
            color: rgba(255,255,255,0.9);
            text-align: center;
            margin-top: 4px;
            line-height: 1.4;
            position: relative;
            z-index: 2;
        }

        .card-poster-stamp {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            color: rgba(255, 255, 255, .15);
            position: absolute;
            bottom: 20px;
            letter-spacing: 3px;
            transform: rotate(-8deg);
            white-space: nowrap;
        }

        /* Play btn */
        .card-play-btn {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(41, 121, 255, .5);
            border: none;
            transition: transform .15s, box-shadow .15s;
            z-index: 3;
        }

        .card-play-btn:hover {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 6px 16px rgba(41, 121, 255, .6);
        }

        .card-play-btn svg {
            width: 14px;
            height: 14px;
            fill: #fff;
            margin-left: 2px;
        }

        /* Badge */
        .card-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--accent);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 5px 10px;
            border-radius: 6px;
            z-index: 3;
            text-transform: uppercase;
            box-shadow: 0 2px 8px rgba(41, 121, 255, .4);
        }

        /* ══ HAMBURGER BUTTON ══ */
        .card-more-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, .95);
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all .18s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            padding: 0;
        }

        .card-more-btn:hover {
            background: #fff;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        }

        .card-more-btn svg {
            width: 18px;
            height: 18px;
            color: #444;
        }

        /* ══ DROPDOWN CARD ══ */
        .card-dd {
            position: absolute;
            top: 52px;
            right: 12px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .15);
            border: 1px solid #ececec;
            min-width: 170px;
            z-index: 200;
            display: none;
            overflow: hidden;
        }

        .card-dd.open {
            display: block;
            animation: ddIn .15s ease;
        }

        @keyframes ddIn {
            from {
                opacity: 0;
                transform: translateY(-8px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .dd-link,
        .dd-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            color: #333;
            text-decoration: none;
            cursor: pointer;
            transition: background .13s;
            width: 100%;
            border: none;
            background: none;
            text-align: left;
        }

        .dd-link svg,
        .dd-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .dd-link:hover,
        .dd-btn:hover {
            background: #f5f5f5;
        }

        .dd-link.view {
            color: var(--accent);
        }

        .dd-link.view:hover {
            background: #f0f5ff;
        }

        .dd-link.edit {
            color: var(--black);
        }

        .dd-link.edit:hover {
            background: #f5f5f5;
        }

        .dd-btn.danger {
            color: #e53535;
        }

        .dd-btn.danger:hover {
            background: #fff0f0;
        }

        .dd-sep {
            height: 1px;
            background: #f0f0f0;
            margin: 2px 0;
        }

        /* ══ DETAIL BTN ══ */
        .card-detail-btn {
            background: #fff;
            border: 1.5px solid #e0e0e0;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 11px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 10px auto 12px;
            color: #333;
            transition: all .15s;
            width: fit-content;
            text-decoration: none;
        }

        .card-detail-btn:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            transform: translateY(-1px);
        }

        .card-detail-btn svg {
            width: 12px;
            height: 12px;
        }

        /* ══ CARD BODY ══ */
        .card-body {
            padding: 6px 16px 18px;
        }

        .card-name {
            font-weight: 700;
            font-size: 15px;
            color: var(--black);
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-meta {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .card-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #666;
        }

        .card-meta-item svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
            color: #999;
        }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            text-align: center;
            padding: 100px 20px;
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid #f0f0f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .04);
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f0f0f0, #e8e8e8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .empty-state-icon svg {
            width: 36px;
            height: 36px;
            color: var(--text-muted);
            opacity: .5;
        }

        .empty-state h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            letter-spacing: 1px;
            color: var(--black);
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: var(--text-muted);
        }

        .empty-state a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
        }

        .empty-state a:hover {
            text-decoration: underline;
        }

        /* ══ TOAST ══ */
        .toast {
            position: fixed;
            bottom: 28px;
            right: 28px;
            background: var(--black);
            color: #fff;
            padding: 14px 24px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            border-left: 4px solid var(--accent);
            opacity: 0;
            transform: translateY(12px);
            transition: all .3s ease;
            z-index: 999;
            pointer-events: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .2);
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 1024px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 16px 20px;
                flex-wrap: wrap;
                gap: 16px;
            }

            .topbar-title {
                font-size: 20px;
            }

            .topbar-breadcrumb {
                display: none;
            }

            .topbar-right {
                width: 100%;
                justify-content: flex-end;
            }

            .topbar-actions {
                flex: 1;
                max-width: 400px;
            }

            .search-input {
                width: 160px;
            }

            .page-content {
                padding: 24px 20px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .card-poster {
                height: 150px;
            }
        }

        @media (max-width: 600px) {
            .topbar-actions {
                max-width: 100%;
            }

            .search-input {
                width: 100%;
            }

            .btn-tambah span {
                display: none;
            }

            .btn-tambah {
                padding: 10px 12px;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .topbar-actions {
                background: transparent;
                padding: 0;
            }

            .search-wrapper {
                flex: 1;
                background: #f5f5f5;
                border-radius: 8px;
                padding: 4px;
            }

            .search-input {
                background: #fff;
                border-radius: 6px;
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')

    <!-- ═══════════ TOPBAR ═══════════ -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="topbar-title">DAFTAR LOMBA</div>
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
                <span>Daftar Lomba</span>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-actions">
                <div class="search-wrapper">
                    <input class="search-input" id="search-input" type="text" placeholder="Cari judul, cabor, lokasi..."
                        oninput="filterCards()" />
                    <button class="btn-search" onclick="filterCards()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7"/>
                            <path d="M21 21l-4-4"/>
                        </svg>
                    </button>
                </div>
                <a href="{{ route('admin.lomba.create') }}" class="btn-tambah">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    <span>Tambah</span>
                </a>
            </div>
        </div>
    </header>

    <div class="page-content">

        @if(session('success'))
            <div id="session-toast" style="display:none">{{ session('success') }}</div>
        @endif

        @if(($lomba ?? collect())->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="7" />
                        <path d="M21 21l-4-4" />
                    </svg>
                </div>
                <h3>Belum Ada Lomba</h3>
                <p>Tambahkan lomba baru untuk ditampilkan di portal.</p>
                <p style="margin-top: 12px;">
                    <a href="{{ route('admin.lomba.create') }}">Tambah sekarang →</a>
                </p>
            </div>
        @else
            <div class="section-header">
                <div class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M8 21h8M12 17v4M7 4h10l-2 8H9L7 4z"/>
                        <path d="M7 4c0-1 1-2 2-2h6c1 0 2 1 2 2"/>
                    </svg>
                    Semua Lomba
                </div>
                <div class="section-count">
                    Total: <strong>{{ $lomba->count() }}</strong> lomba
                </div>
            </div>

            <div class="cards-grid" id="cards-container">
                @foreach($lomba as $item)

                    <div class="lomba-card" data-judul="{{ strtolower($item->judul) }}" data-cabor="{{ strtolower($item->cabor) }}"
                        data-lokasi="{{ strtolower($item->lokasi) }}" data-kategori="{{ strtolower($item->kategori) }}">

                        {{-- ══ POSTER WRAP ══ --}}
                        <div class="card-poster-wrap">
                            <div class="card-poster">
                                @if($item->poster)
                                    <img src="{{ Storage::url($item->poster) }}" alt="{{ $item->judul }}">
                                    <div class="card-poster-overlay"></div>
                                @else
                                    <div class="card-poster-logos">
                                        <div class="logo-circle">🏆</div>
                                    </div>
                                    <div class="card-poster-trophy">🏆</div>
                                    <div class="card-poster-title">
                                        {{ strtoupper(Str::limit($item->judul, 18)) }}
                                    </div>
                                    <div class="card-poster-sub">{{ $item->kategori }} • {{ $item->cabor }}</div>
                                    <div class="card-poster-stamp">{{ strtoupper($item->cabor) }}</div>
                                @endif

                                @php $status = $item->status_otomatis; @endphp
                                <div class="card-badge"
                                    style="background:{{ $status === 'new' ? '#2979ff' : ($status === 'open' ? '#22c55e' : '#e53535') }}">
                                    {{ strtoupper($status) }}
                                </div>

                                <button class="card-play-btn" onclick="window.location='{{ route('lomba.detail', $item->id) }}'">
                                    <svg viewBox="0 0 10 12">
                                        <polygon points="0,0 10,6 0,12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- ══ HAMBURGER ══ --}}
                        <button class="card-more-btn" onclick="toggleDd({{ $item->id }}, event)" title="Opsi lainnya">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="5" r="1.5" fill="currentColor" stroke="none" />
                                <circle cx="12" cy="12" r="1.5" fill="currentColor" stroke="none" />
                                <circle cx="12" cy="19" r="1.5" fill="currentColor" stroke="none" />
                            </svg>
                        </button>

                        {{-- ══ DROPDOWN ══ --}}
                        <div class="card-dd" id="dd-{{ $item->id }}">

                            <a href="{{ route('lomba.detail', $item->id) }}" class="dd-link view">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                Lihat Detail
                            </a>

                            <div class="dd-sep"></div>

                            <a href="{{ route('admin.lomba.edit', $item->id) }}" class="dd-link edit">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                Edit Lomba
                            </a>

                            <div class="dd-sep"></div>

                            <form action="{{ route('admin.lomba.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus lomba \'{{ addslashes($item->judul) }}\'?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="dd-btn danger">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                        <path d="M10 11v6M14 11v6M9 6V4h6v2" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>

                        </div>

                        {{-- More Detail --}}
                        <div style="display:flex;justify-content:center;">
                            <a href="{{ route('lomba.detail', $item->id) }}" class="card-detail-btn">
                                More Detail
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 8h8M9 5l3 3-3 3" />
                                </svg>
                            </a>
                        </div>

                        {{-- Card Body --}}
                        <div class="card-body">
                            <div class="card-name" title="{{ $item->judul }}">{{ $item->judul }}</div>
                            <div class="card-meta">
                                <div class="card-meta-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                                    </svg>
                                    {{ $item->kategori }}
                                </div>
                                <div class="card-meta-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                        <circle cx="12" cy="9" r="2.5" />
                                    </svg>
                                    {{ $item->lokasi }}
                                </div>
                                <div class="card-meta-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <path d="M16 2v4M8 2v4M3 10h18" />
                                    </svg>
                                    {{ $item->tanggal }}
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="empty-state" id="empty-search" style="display:none;">
                <div class="empty-state-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="7" />
                        <path d="M21 21l-4-4" />
                    </svg>
                </div>
                <h3>Tidak Ditemukan</h3>
                <p>Coba gunakan kata kunci lain untuk pencarian.</p>
            </div>
        @endif

    </div>

    <div class="toast" id="toast"></div>

@endsection

@push('scripts')
    <script>
        // ── SEARCH ──
        function filterCards() {
            const q = document.getElementById('search-input').value.toLowerCase();
            let visible = 0;
            document.querySelectorAll('.lomba-card').forEach(card => {
                const match = !q ||
                    (card.dataset.judul || '').includes(q) ||
                    (card.dataset.cabor || '').includes(q) ||
                    (card.dataset.lokasi || '').includes(q) ||
                    (card.dataset.kategori || '').includes(q);
                card.style.display = match ? 'block' : 'none';
                if (match) visible++;
            });
            const el = document.getElementById('empty-search');
            if (el) el.style.display = visible === 0 ? 'block' : 'none';
        }

        // ── DROPDOWN ──
        function toggleDd(id, e) {
            e.stopPropagation();
            const dd = document.getElementById('dd-' + id);
            const isOpen = dd.classList.contains('open');
            closeAllDd();
            if (!isOpen) dd.classList.add('open');
        }
        function closeAllDd() {
            document.querySelectorAll('.card-dd').forEach(d => d.classList.remove('open'));
        }
        document.addEventListener('click', closeAllDd);
        document.querySelectorAll('.card-dd').forEach(dd => {
            dd.addEventListener('click', e => e.stopPropagation());
        });

        // ── TOAST ──
        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3500);
        }
        window.addEventListener('DOMContentLoaded', () => {
            const el = document.getElementById('session-toast');
            if (el) showToast('✓ ' + el.textContent.trim());
        });
    </script>
@endpush