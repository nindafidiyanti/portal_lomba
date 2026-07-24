@extends('layouts.app')

@section('title', 'Tempat Latihan')
@section('page_label', 'TEMPAT LATIHAN')

@push('styles')
    <style>
        .tl-hero {
            background: var(--black);
            position: relative;
            overflow: hidden;
            padding: 48px 40px 56px;
        }

        .tl-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(232, 184, 0, .12) 0%, transparent 70%);
            pointer-events: none;
        }

        .tl-hero-content {
            position: relative;
            z-index: 1;
        }

        .tl-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(232, 184, 0, .15);
            border: 1px solid rgba(232, 184, 0, .3);
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 11px;
            font-weight: 700;
            color: var(--accent2);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .tl-hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(36px, 6vw, 64px);
            line-height: .95;
            color: #fff;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .tl-hero-title .accent2 {
            color: var(--accent2);
        }

        .tl-hero-sub {
            color: #888;
            font-size: 14px;
            max-width: 480px;
            line-height: 1.6;
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

        .section-title span {
            color: var(--accent2);
        }

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

        .pill:hover { border-color: var(--accent2); color: #8a6a00; }

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
            background: linear-gradient(155deg, #f0d080 0%, #ffe9b3 45%, #a8c4f5 100%);
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
            color: #3a2a00;
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
            color: rgba(60, 40, 0, .15);
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
            .tl-hero { padding: 64px 60px 72px; }
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

    <section class="tl-hero">
        <div class="tl-hero-content">
            <div class="tl-hero-eyebrow">
                <i class="bi bi-building"></i> TEMPAT LATIHAN
            </div>
            <h1 class="tl-hero-title">
                TEMUKAN <span class="accent2">ARENA</span><br>
                UNTUK BERLATIH
            </h1>
            <p class="tl-hero-sub">
                Cari lokasi latihan terbaik sesuai cabang olahraga favoritmu, lengkap dengan jam operasional dan alamatnya.
            </p>
        </div>
    </section>

    <div class="section">
        <div class="section-header">
            <div class="section-title">Daftar <span>Tempat Latihan</span></div>
            <span class="section-count" id="count-label">Menampilkan {{ count($tempatLatihan) }} tempat</span>
        </div>

        <div class="filter-pills">
            <button class="pill active" data-filter="semua">Semua</button>
            @foreach($cabors as $cabor)
                <button class="pill" data-filter="{{ strtolower($cabor) }}">{{ $cabor }}</button>
            @endforeach
        </div>

        <div class="cards-grid" id="cards-grid">
            @forelse($tempatLatihan as $item)
                <a href="{{ route('tempatlatihan.show', $item->id) }}" class="lomba-card"
                    data-cabang="{{ strtolower($item->cabor ?? '') }}">

                    <div class="card-poster">
                        @if($item->foto_tempat)
                            <img class="poster-img" src="{{ Storage::url($item->foto_tempat) }}" alt="{{ $item->nama_tempat }}">
                            <div class="card-poster-overlay"></div>
                        @else
                            <div class="card-poster-logos">
                                <div class="logo-circle">🏅</div>
                                <div class="logo-circle">{{ strtoupper(substr($item->nama_tempat, 0, 1)) }}</div>
                            </div>
                            <div class="card-poster-trophy">🏋️</div>
                            <div class="card-poster-title">
                                {{ strtoupper($item->nama_tempat) }}<br>
                                <span style="font-size:9px;font-family:'DM Sans',sans-serif;font-weight:600;letter-spacing:2px;">
                                    PUSAT LATIHAN {{ strtoupper($item->cabor ?? '') }}
                                </span>
                            </div>
                            <div class="card-poster-sub">{{ $item->kategori ?? 'Semua Usia' }}</div>
                            <div class="card-poster-stamp">{{ strtoupper($item->cabor ?? 'OLAHRAGA') }}</div>
                        @endif
                        <div class="new-badge" style="background:{{ $item->status === 'aktif' ? '#22c55e' : '#e53535' }}">
                            {{ $item->status === 'aktif' ? 'Buka' : 'Tutup' }}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card-name">{{ $item->nama_tempat }}</div>
                        <div class="card-meta">
                            @if(!empty($item->cabor))
                                <div class="card-meta-item">
                                    <i class="bi bi-person-arms-up"></i> {{ $item->cabor }}
                                </div>
                            @endif
                            <div class="card-meta-item">
                                <i class="bi bi-geo-alt-fill"></i> {{ $item->alamat }}
                            </div>
                            @if(!empty($item->jam_operasional))
                                <div class="card-meta-item">
                                    <i class="bi bi-clock-fill"></i> {{ $item->jam_operasional }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer-btn">
                        <span class="btn-detail">Lihat Detail <i class="bi bi-arrow-right"></i></span>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <i class="bi bi-building"></i>
                    <p>Belum ada tempat latihan tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.pill').forEach(function (pill) {
                pill.addEventListener('click', function () {
                    document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    var filter = this.getAttribute('data-filter');
                    var visible = 0;
                    document.querySelectorAll('#cards-grid .lomba-card').forEach(function (card) {
                        var cabang = card.getAttribute('data-cabang') || '';
                        var match = (filter === 'semua') || cabang.includes(filter);
                        card.style.display = match ? 'flex' : 'none';
                        if (match) visible++;
                    });
                    document.getElementById('count-label').textContent = 'Menampilkan ' + visible + ' tempat';
                });
            });
        });
    </script>
@endpush