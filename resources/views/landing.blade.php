@extends('layouts.app')

@section('title', 'Daftar Lomba')
@section('page_label', 'HOME')

@push('styles')
    <style>
        .lb-hero {
            background: var(--black);
            position: relative;
            overflow: hidden;
            padding: 48px 40px 56px;
        }

        .lb-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(41, 121, 255, .12) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 10% 80%, rgba(232, 184, 0, .07) 0%, transparent 70%);
            pointer-events: none;
        }

        .lb-hero-grid-lines {
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(90deg, rgba(255, 255, 255, .03) 0px, rgba(255, 255, 255, .03) 1px, transparent 1px, transparent 60px),
                repeating-linear-gradient(0deg, rgba(255, 255, 255, .03) 0px, rgba(255, 255, 255, .03) 1px, transparent 1px, transparent 60px);
            pointer-events: none;
        }

        .lb-hero-content {
            position: relative;
            z-index: 1;
        }

        .lb-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(41, 121, 255, .15);
            border: 1px solid rgba(41, 121, 255, .3);
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 11px;
            font-weight: 700;
            color: var(--accent);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .lb-hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(36px, 6vw, 64px);
            line-height: .95;
            color: #fff;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .lb-hero-title .accent { color: var(--accent); }
        .lb-hero-title .accent2 { color: var(--accent2); }

        .lb-hero-sub {
            color: #888;
            font-size: 14px;
            max-width: 480px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .lb-hero-stats {
            display: flex;
            gap: 32px;
        }

        .stat-item .num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            color: #fff;
            letter-spacing: 1px;
            line-height: 1;
        }

        .stat-item .num span { color: var(--accent); }

        .stat-item .label {
            font-size: 10px;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }

        .section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 40px 56px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            letter-spacing: 1.5px;
            color: var(--black);
        }

        .section-title span { color: var(--accent); }

        .section-count {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .filter-pills {
            display: flex;
            gap: 6px;
            margin-bottom: 24px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .filter-pills::-webkit-scrollbar { display: none; }

        .pill {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            border: 1.5px solid #ddd;
            background: #fff;
            color: #555;
            white-space: nowrap;
            transition: all .15s;
            flex-shrink: 0;
        }

        .pill:hover { border-color: var(--accent); color: var(--accent); }

        .pill.active {
            background: var(--black);
            border-color: var(--black);
            color: #fff;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .lomba-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
            transition: transform .22s ease, box-shadow .22s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }

        .lomba-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 32px rgba(0, 0, 0, .14);
        }

        .card-poster {
            height: 150px;
            background: linear-gradient(155deg, #a8c4f5 0%, #d4e8ff 45%, #f0d080 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 12px 10px 8px;
        }

        .card-poster img.poster-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-poster-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 40%, rgba(0, 0, 0, .5) 100%);
        }

        .card-poster-logos {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 6px;
            margin-bottom: 4px;
        }

        .logo-circle {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: #333;
        }

        .card-poster-trophy {
            position: relative;
            z-index: 2;
            font-size: 22px;
            margin: 4px 0 2px;
        }

        .card-poster-title {
            position: relative;
            z-index: 2;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 14px;
            color: #0a1a4a;
            letter-spacing: 1px;
            text-align: center;
            line-height: 1.15;
        }

        .card-poster-sub {
            position: relative;
            z-index: 2;
            font-size: 9px;
            color: #333;
            text-align: center;
            margin-top: 2px;
        }

        .card-poster-stamp {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            color: rgba(200, 60, 30, .15);
            position: absolute;
            bottom: 14px;
            letter-spacing: 2px;
            transform: rotate(-8deg);
            white-space: nowrap;
            z-index: 1;
        }

        .new-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 3px 8px;
            border-radius: 4px;
            z-index: 3;
            text-transform: uppercase;
        }

        .card-body { padding: 12px 14px; flex: 1; }

        .card-name {
            font-weight: 700;
            font-size: 13px;
            color: var(--black);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .card-meta { display: flex; flex-direction: column; gap: 4px; }

        .card-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: #666;
        }

        .card-meta-item i { font-size: 11px; color: #aaa; flex-shrink: 0; }

        .card-footer-btn { padding: 0 14px 12px; }

        .btn-detail {
            width: 100%;
            background: #f5f5f5;
            border: 1.5px solid #e8e8e8;
            border-radius: 8px;
            padding: 7px 0;
            font-size: 12px;
            font-weight: 700;
            color: #333;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all .18s;
        }

        .btn-detail:hover {
            background: var(--black);
            border-color: var(--black);
            color: #fff;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 64px 20px;
            color: var(--text-muted);
        }

        .empty-state i { font-size: 48px; opacity: .25; display: block; margin-bottom: 12px; }

        @media (min-width: 769px) {
            .lb-hero { padding: 64px 60px 72px; }
            .section { max-width: 100%; padding: 56px 60px; }
            .section-title { font-size: 36px; }
            .cards-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 26px; }
        }

        @media (max-width: 480px) {
            .card-poster { height: 130px; }
        }
    </style>
@endpush

@section('content')

    <section class="lb-hero">
        <div class="lb-hero-grid-lines"></div>
        <div class="lb-hero-content">
            <div class="lb-hero-eyebrow">
                <i class="bi bi-trophy-fill"></i> LOMBA OLAHRAGA
            </div>
            <h1 class="lb-hero-title">
                JUNJUNG <span class="accent">SPORTIVITAS</span><br>
                <span class="accent2">RAIH PRESTASI</span>
            </h1>
            <p class="lb-hero-sub">
                Temukan berbagai lomba olahraga terbaik di daerahmu. Daftar, bersaing, dan buktikan kemampuanmu.
            </p>
        </div>
    </section>

    <div class="section" id="hasil-section">
        <div class="section-header">
            <div class="section-title">Daftar <span>Lomba</span></div>
            <span class="section-count" id="count-label">Menampilkan {{ count($lomba) }} lomba</span>
        </div>

        <div class="filter-pills">
            <button class="pill active" data-filter="semua">Semua</button>
            @foreach($cabors as $cabor)
                <button class="pill" data-filter="{{ strtolower($cabor) }}">{{ $cabor }}</button>
            @endforeach
        </div>

        <div class="cards-grid" id="cards-grid">
            @forelse($lomba as $item)
                <a href="{{ route('lomba.detail', $item->id) }}" class="lomba-card"
                    data-nama="{{ strtolower($item->judul) }}"
                    data-cabang="{{ strtolower($item->cabor ?? '') }}"
                    data-lokasi="{{ strtolower($item->lokasi) }}">

                    <div class="card-poster">
                        @if(!empty($item->poster))
                            <img class="poster-img" src="{{ asset('storage/' . $item->poster) }}" alt="{{ $item->judul }}">
                            <div class="card-poster-overlay"></div>
                        @else
                            <div class="card-poster-logos">
                                <div class="logo-circle">K</div>
                                <div class="logo-circle">🏆</div>
                            </div>
                            <div class="card-poster-trophy">🏆</div>
                            <div class="card-poster-title">
                                {{ strtoupper($item->judul) }}<br>
                                <span style="font-size:9px;font-family:'DM Sans',sans-serif;font-weight:600;letter-spacing:2px;">
                                    KEJUARAAN {{ strtoupper($item->cabor ?? '') }}
                                </span>
                            </div>
                            <div class="card-poster-sub">{{ $item->kategori ?? '' }}</div>
                            <div class="card-poster-stamp">KEJUARAAN {{ strtoupper($item->cabor ?? '') }}</div>
                        @endif

                        @php $status = $item->status_otomatis; @endphp
                        <div class="new-badge"
                            style="background:{{ $status === 'new' ? '#2979ff' : ($status === 'open' ? '#22c55e' : '#e53535') }}">
                            {{ $status === 'new' ? 'New Event' : ($status === 'open' ? 'Open' : 'Closed') }}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card-name">{{ $item->judul }}</div>
                        <div class="card-meta">
                            @if(!empty($item->kategori))
                                <div class="card-meta-item">
                                    <i class="bi bi-people-fill"></i> {{ $item->kategori }}
                                </div>
                            @endif
                            <div class="card-meta-item">
                                <i class="bi bi-geo-alt-fill"></i> {{ $item->lokasi }}
                            </div>
                            <div class="card-meta-item">
                                <i class="bi bi-calendar-event-fill"></i> {{ $item->tanggal }}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer-btn">
                        <span class="btn-detail">Lihat Detail <i class="bi bi-arrow-right"></i></span>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <i class="bi bi-search"></i>
                    <p>Belum ada lomba yang tersedia.</p>
                </div>
            @endforelse

            <div class="empty-state" id="empty-state" style="display:none;">
                <i class="bi bi-search"></i>
                <p>Tidak ada lomba yang cocok dengan pencarianmu.</p>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Data untuk dropdown search global (dipakai layout navbar)
        window.searchData = window.searchData || {};
        const dataLomba = {!! json_encode($lombaJson) !!};
        const dataTempat = {!! json_encode($tempatJson) !!};

        let activeFilter = 'semua';

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.pill').forEach(function (pill) {
                pill.addEventListener('click', function () {
                    activeFilter = this.getAttribute('data-filter');

                    document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    filterCards();
                });
            });
        });

        function filterCards() {
            var cards = document.querySelectorAll('#cards-grid .lomba-card');
            var visibleCount = 0;

            cards.forEach(function (card) {
                var cabang = card.getAttribute('data-cabang') || '';
                var match = (activeFilter === 'semua') || cabang.includes(activeFilter);
                card.style.display = match ? 'flex' : 'none';
                if (match) visibleCount++;
            });

            document.getElementById('empty-state').style.display = visibleCount === 0 ? 'block' : 'none';
            document.getElementById('count-label').textContent = 'Menampilkan ' + visibleCount + ' lomba';
        }
    </script>
@endpush