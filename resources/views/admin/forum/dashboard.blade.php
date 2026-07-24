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

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
        }

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

        /* ══ FORUM CARDS GRID ══ */
        .forum-cards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* ══ FORUM CARD ══ */
        .forum-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: visible;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
            border: 1px solid #f0f0f0;
            transition: transform .25s, box-shadow .25s;
            position: relative;
            max-width: 480px;
            margin: 0 auto;
            width: 100%;
        }

        .forum-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, .12);
            border-color: #e8e8e8;
        }

        /* ══ CARD HEADER ══ */
        .card-header {
            padding: 16px 18px 14px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-bottom: 1px solid #f5f5f5;
        }

        .card-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .card-author-info {
            flex: 1;
            min-width: 0;
        }

        .card-author-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 2px;
        }

        .card-meta-row {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .card-time {
            font-size: 11px;
            color: var(--text-muted);
        }

        .card-badge {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .8px;
            padding: 3px 8px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        /* ══ CARD BODY ══ */
        .card-content {
            padding: 16px 18px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 10px;
            line-height: 1.35;
        }

        .card-excerpt {
            font-size: 13px;
            color: #666;
            line-height: 1.55;
            margin: 0;
        }

        /* ══ CARD FOOTER ══ */
        .card-footer {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 18px;
            border-top: 1px solid #f5f5f5;
        }

        .card-stat {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .card-stat svg {
            width: 14px;
            height: 14px;
        }

        /* ══ HAMBURGER ══ */
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

        /* ══ DROPDOWN ══ */
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

        /* ══ RESPONSIVE ══ */
        @media (max-width: 1024px) {
            .forum-cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                max-width: 900px;
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

            .forum-cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
                max-width: 100%;
            }

            .forum-card {
                max-width: 100%;
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

            .forum-cards-grid {
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

            .card-header {
                padding: 14px 14px 12px;
            }

            .card-content {
                padding: 14px;
            }

            .card-footer {
                padding: 10px 14px;
            }
        }
    </style>
@endpush

@section('content')

    <!-- ═══════════ TOPBAR ═══════════ -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="topbar-title">DAFTAR POSTINGAN FORUM</div>
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
                <span>Forum</span>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-actions">
                <div class="search-wrapper">
                    <input class="search-input" id="search-input" type="text" placeholder="Cari judul, author..."
                        oninput="filterCards()" />
                    <button class="btn-search" onclick="filterCards()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M21 21l-4-4" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="page-content">

        @if(($forums ?? collect())->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                    </svg>
                </div>
                <h3>Belum Ada Postingan Forum</h3>
                <p>Postingan forum akan muncul di sini setelah pengguna memposting.</p>
            </div>
        @else
            <div class="section-header">
                <div class="section-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                    </svg>
                    Semua Postingan Forum
                </div>
                <div class="section-count">
                    Total: <strong>{{ $forums->count() }}</strong> postingan
                </div>
            </div>

            <div class="forum-cards-grid" id="cards-container">
                @foreach($forums as $forum)
                    @php
                        $colors = ['#2979ff', '#e8b800', '#22c55e', '#e53535', '#9333ea', '#06b6d4', '#ec4899'];
                        $color = $colors[$forum->user_id % count($colors)];
                        $badgeColors = [
                            'karate' => ['bg' => '#e8f0ff', 'color' => '#2979ff'],
                            'badminton' => ['bg' => '#fff7e0', 'color' => '#b38900'],
                            'futsal' => ['bg' => '#e6f9ef', 'color' => '#15803d'],
                            'renang' => ['bg' => '#fce8e8', 'color' => '#b91c1c'],
                            'pencak silat' => ['bg' => '#f3e8ff', 'color' => '#7c3aed'],
                        ];
                        $badge = $badgeColors[$forum->cabor ?? ''] ?? ['bg' => '#f0f0f0', 'color' => '#555'];
                    @endphp

                    <div class="forum-card" data-title="{{ strtolower($forum->title) }}"
                        data-author="{{ strtolower($forum->user->name ?? '') }}" data-cabor="{{ strtolower($forum->cabor ?? '') }}">

                        {{-- CARD HEADER --}}
                        <div class="card-header">
                            <div class="card-avatar" style="background: {{ $color }}">
                                {{ strtoupper(substr($forum->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="card-author-info">
                                <div class="card-author-name">{{ $forum->user->name ?? 'Unknown' }}</div>
                                <div class="card-meta-row">
                                    <span class="card-time">{{ $forum->created_at->diffForHumans() }}</span>
                                    @if(!empty($forum->cabor))
                                        <span class="card-badge" style="background:{{ $badge['bg'] }};color:{{ $badge['color'] }}">
                                            {{ ucfirst($forum->cabor) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- HAMBURGER --}}
                        <button class="card-more-btn" onclick="toggleDd({{ $forum->id }}, event)" title="Opsi lainnya">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="5" r="1.5" fill="currentColor" stroke="none" />
                                <circle cx="12" cy="12" r="1.5" fill="currentColor" stroke="none" />
                                <circle cx="12" cy="19" r="1.5" fill="currentColor" stroke="none" />
                            </svg>
                        </button>

                        {{-- DROPDOWN --}}
                        <div class="card-dd" id="dd-{{ $forum->id }}">
                            <a href="{{ route('forum.show', $forum->id) }}" class="dd-link view">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                Lihat Postingan
                            </a>

                            {{-- ── Tombol Pin ── --}}
                            <div class="dd-sep"></div>
                            
                            <form action="{{ route('admin.forum.pin', $forum->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="dd-link edit"
                                    style="color: {{ $forum->is_pinned ? '#e53535' : 'var(--accent)' }};">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        style="width:16px;height:16px;">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                        <path d="M2 17l10 5 10-5" />
                                        <path d="M2 12l10 5 10-5" />
                                    </svg>
                                    {{ $forum->is_pinned ? 'Lepas Pin' : 'Pin Postingan' }}
                                </button>
                            </form>

                            <div class="dd-sep"></div>

                            <form action="{{ route('forum.destroy', $forum->id) }}" method="POST"
                                onsubmit="return confirm('Hapus postingan \'{{ addslashes($forum->title) }}\'? Semua komentar juga akan dihapus.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="dd-btn danger">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                        <path d="M10 11v6M14 11v6M9 6V4h6v2" />
                                    </svg>
                                    Hapus Postingan
                                </button>
                            </form>
                        </div>

                        {{-- CARD CONTENT --}}
                        <div class="card-content">
                            <h3 class="card-title">{{ $forum->title }}</h3>
                            <p class="card-excerpt">{{ Str::limit($forum->content, 150) }}</p>
                        </div>

                        {{-- CARD FOOTER --}}
                        <div class="card-footer">
                            <span class="card-stat">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                                </svg>
                                {{ $forum->comments->count() }} komentar
                            </span>
                            <span class="card-stat">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                {{ $forum->created_at->format('d M Y') }}
                            </span>
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

@endsection

@push('scripts')
    <script>
        function filterCards() {
            const q = document.getElementById('search-input').value.toLowerCase();
            let visible = 0;
            document.querySelectorAll('.forum-card').forEach(card => {
                const match = !q ||
                    (card.dataset.title || '').includes(q) ||
                    (card.dataset.author || '').includes(q) ||
                    (card.dataset.cabor || '').includes(q);
                card.style.display = match ? 'block' : 'none';
                if (match) visible++;
            });
            const el = document.getElementById('empty-search');
            if (el) el.style.display = visible === 0 ? 'block' : 'none';
        }

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
    </script>
@endpush