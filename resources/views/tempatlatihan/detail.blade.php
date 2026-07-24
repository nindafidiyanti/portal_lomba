<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tempat Latihan – {{ $latihan->nama_tempat }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --black: #0f0f0f;
            --dark: #1a1a1a;
            --accent: #2979ff;
            --accent2: #e8b800;
            --bg: #f0f0f0;
            --card-bg: #ffffff;
            --text-muted: #888;
            --radius: 14px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            padding-bottom: 70px;
        }

        @media (min-width: 769px) {
            body {
                padding-bottom: 0;
            }
        }

        /* ── NAVBAR ── */
        .navbar {
            background: var(--black);
            padding: 0 40px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid var(--accent);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 0 16px;
                height: 56px;
            }
        }

        .navbar-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 2px;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand span {
            color: var(--accent);
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            border: 1.5px solid #333;
            border-radius: 8px;
            padding: 6px 16px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            color: #aaa;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-back:hover {
            color: #fff;
            border-color: #fff;
        }

        @media (max-width: 600px) {
            .btn-back {
                padding: 5px 12px;
                font-size: 12px;
            }
        }

        /* ── BREADCRUMB ── */
        .breadcrumb-bar {
            background: #fff;
            border-bottom: 1px solid #e8e8e8;
            padding: 10px 40px;
            overflow: hidden;
        }

        .breadcrumb-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-muted);
            overflow: hidden;
        }

        .breadcrumb-inner a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color .15s;
            white-space: nowrap;
        }

        .breadcrumb-inner a:hover {
            color: var(--accent);
        }

        .breadcrumb-inner i {
            font-size: 10px;
            flex-shrink: 0;
        }

        .breadcrumb-inner .current {
            color: var(--black);
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (max-width: 600px) {
            .breadcrumb-bar {
                padding: 8px 16px;
            }

            .breadcrumb-inner {
                font-size: 11px;
                gap: 5px;
            }

            .breadcrumb-inner .current {
                max-width: 120px;
            }
        }

        /* ── MAIN WRAPPER ── */
        .page-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 40px 64px;
        }

        @media (max-width: 760px) {
            .page-wrapper {
                padding: 20px 16px 100px;
            }
        }

        /* ── DETAIL CARD ── */
        .detail-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .09);
            display: grid;
            grid-template-columns: 280px 1fr;
        }

        @media(max-width: 760px) {
            .detail-card {
                grid-template-columns: 1fr;
            }

            .poster-col {
                min-height: 260px;
            }

            .info-col {
                padding: 20px 16px;
            }

            .info-title {
                font-size: 26px;
            }

            .meta-grid {
                gap: 12px 16px;
            }

            .organizer-box {
                flex-direction: column;
                text-align: center;
            }

            .back-section {
                margin-top: 24px;
            }

            .btn-back-main {
                width: 100%;
                justify-content: center;
            }
        }

        /* ── POSTER COLUMN ── */
        .poster-col {
            position: relative;
            background: linear-gradient(155deg, #a8c4f5 0%, #d4e8ff 45%, #f0d080 100%);
            min-height: 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 24px 16px 20px;
            overflow: hidden;
        }

        @media (max-width: 760px) {
            .poster-col {
                min-height: 280px;
                padding: 20px 16px 16px;
            }
        }

        .poster-col img.poster-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .poster-col .poster-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, .18) 0%, rgba(0, 0, 0, .55) 100%);
        }

        /* illustrated fallback */
        .poster-fallback {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            text-align: center;
        }

        .poster-logos {
            display: flex;
            gap: 8px;
            margin-bottom: 10px;
        }

        .logo-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .7);
            border: 1.5px solid rgba(0, 0, 0, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }

        .poster-trophy {
            font-size: 52px;
            margin: 8px 0 10px;
        }

        .poster-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            color: #0a1a4a;
            letter-spacing: 1.5px;
            line-height: 1.1;
        }

        .poster-subtitle {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #333;
            margin-top: 4px;
        }

        .poster-stamp {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: rgba(200, 60, 30, .12);
            letter-spacing: 3px;
            transform: rotate(-10deg);
            margin-top: 16px;
            white-space: nowrap;
        }

        @media (max-width: 600px) {
            .poster-logos {
                gap: 6px;
            }

            .logo-circle {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .poster-trophy {
                font-size: 40px;
                margin: 6px 0 8px;
            }

            .poster-title {
                font-size: 18px;
            }

            .poster-subtitle {
                font-size: 10px;
            }

            .poster-stamp {
                font-size: 18px;
            }
        }

        /* accent bar at bottom of poster */
        .poster-accent-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent);
            z-index: 3;
        }

        /* new event tag overlaid on poster */
        .poster-tag {
            position: absolute;
            top: 14px;
            left: 14px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 4px 10px;
            border-radius: 5px;
            z-index: 4;
            text-transform: uppercase;
        }
        .poster-tag.aktif    { background: #22c55e; color: #fff; }
        .poster-tag.nonaktif { background: #888;    color: #fff; }

        @media (max-width: 600px) {
            .poster-tag {
                font-size: 9px;
                padding: 3px 8px;
                top: 10px;
                left: 10px;
            }
        }

        /* ── INFO COLUMN ── */
        .info-col {
            padding: 40px 44px;
            display: flex;
            flex-direction: column;
            gap: 0;
            min-width: 0;
            overflow: hidden;
        }

        @media (max-width: 760px) {
            .info-col {
                padding: 24px 20px;
            }
        }

        .info-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(41, 121, 255, .08);
            border: 1px solid rgba(41, 121, 255, .2);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 700;
            color: var(--accent);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 14px;
            width: fit-content;
        }

        .info-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(28px, 4vw, 42px);
            letter-spacing: 1.5px;
            color: var(--black);
            line-height: 1;
            margin-bottom: 6px;
        }

        .info-cabang {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .divider {
            height: 1px;
            background: #f0f0f0;
            margin: 24px 0;
        }

        /* meta rows */
        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 24px;
            margin-bottom: 4px;
        }

        @media(max-width: 600px) {
            .meta-grid {
                grid-template-columns: 1fr;
            }
        }

        .meta-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .meta-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
            color: var(--accent);
        }

        .meta-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: #bbb;
            margin-bottom: 2px;
        }

        .meta-value {
            font-size: 13px;
            font-weight: 600;
            color: var(--black);
            line-height: 1.3;
        }

        /* link pendaftaran */
        .link-box {
            background: #f8f8f8;
            border: 1.5px solid #ececec;
            border-radius: 10px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 4px;
            overflow: hidden;
        }

        .link-box i {
            font-size: 18px;
            color: var(--accent);
            flex-shrink: 0;
        }

        .link-box-inner {
            flex: 1;
            min-width: 0;
        }

        .link-box-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: #bbb;
            margin-bottom: 2px;
        }

        .link-box-url {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            max-width: 100%;
        }

        .link-box-url:hover {
            text-decoration: underline;
        }

        .btn-daftar {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            white-space: nowrap;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: opacity .18s, transform .18s;
            flex-shrink: 0;
        }

        .btn-daftar:hover {
            opacity: .88;
            transform: translateY(-1px);
            color: #fff;
        }

        @media (max-width: 600px) {
            .link-box {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                padding: 12px 14px;
            }

            .btn-daftar {
                width: 100%;
                justify-content: center;
            }
        }

        /* penyelenggara */
        .organizer-box {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--black);
            border-radius: 10px;
            padding: 16px 20px;
        }

        .org-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #2a2a2a;
            border: 2px solid var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--accent);
            flex-shrink: 0;
        }

        .org-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 2px;
        }

        .org-name {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
        }

        @media (max-width: 600px) {
            .organizer-box {
                padding: 14px 16px;
                gap: 12px;
            }

            .org-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .org-name {
                font-size: 13px;
            }
        }

        /* ── BACK CTA ── */
        .back-section {
            margin-top: 32px;
        }

        .btn-back-main {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--black);
            color: #fff;
            text-decoration: none;
            padding: 10px 22px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            font-family: inherit;
            letter-spacing: .3px;
            transition: background .18s, transform .18s;
        }

        .btn-back-main:hover {
            background: var(--accent);
            color: #fff;
            transform: translateY(-1px);
        }

        @media (max-width: 600px) {
            .back-section {
                margin-top: 24px;
            }

            .btn-back-main {
                width: 100%;
                justify-content: center;
                padding: 12px 20px;
                font-size: 13px;
            }
        }

        /* ── FOOTER ── */
        .footer {
            background: var(--black);
            border-top: 3px solid var(--accent);
            padding: 28px 40px;
            text-align: center;
            margin-top: 40px;
        }

        .footer-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            letter-spacing: 2px;
            color: #fff;
            margin-bottom: 4px;
        }

        .footer-brand span {
            color: var(--accent);
        }

        .footer-copy {
            font-size: 12px;
            color: #444;
        }

        @media (max-width: 600px) {
            .footer {
                padding: 20px 16px;
                margin-top: 24px;
            }

            .footer-brand {
                font-size: 16px;
            }

            .footer-copy {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>

    {{-- ══ NAVBAR ══ --}}
    <nav class="navbar">
        <a href="{{ route('landing') }}" class="navbar-brand">
            <i class="bi bi-trophy-fill" style="color:var(--accent);font-size:18px;"></i>
            LOMBA<span>KU</span>
        </a>
        <a href="{{ route('landing') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </nav>

    {{-- ══ BREADCRUMB ══ --}}
    <div class="breadcrumb-bar">
        <div class="breadcrumb-inner">
            <a href="{{ route('landing') }}"><i class="bi bi-house-fill"></i> Beranda</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('landing') }}#tempat-latihan">Tempat Latihan</a>
            <i class="bi bi-chevron-right"></i>
            <span class="current">{{ $latihan->nama_tempat }}</span>
        </div>
    </div>

    {{-- ══ CONTENT ══ --}}
    <div class="page-wrapper">
        <div class="detail-card">

            {{-- ── FOTO / POSTER ── --}}
            <div class="poster-col">
                @if($latihan->foto_tempat)
                    <img class="poster-img" src="{{ Storage::url($latihan->foto_tempat) }}" alt="{{ $latihan->nama_tempat }}">
                    <div class="poster-overlay"></div>
                @else
                    <div class="poster-fallback">
                        <div class="poster-logos">
                            <div class="logo-circle">🥋</div>
                            <div class="logo-circle">K</div>
                        </div>
                        <div class="poster-trophy">🥋</div>
                        <div class="poster-title">{{ strtoupper($latihan->nama_tempat) }}</div>
                        <div class="poster-subtitle">DOJO {{ strtoupper($latihan->cabor) }}</div>
                        <div class="poster-stamp">{{ strtoupper($latihan->cabor) }}</div>
                    </div>
                @endif

                {{-- Badge status aktif / nonaktif --}}
                <div class="poster-tag {{ $latihan->status }}">{{ ucfirst($latihan->status) }}</div>
                <div class="poster-accent-bar"></div>
            </div>

            {{-- ── INFO ── --}}
            <div class="info-col">

                <div class="info-eyebrow">
                    <i class="bi bi-lightning-fill"></i>
                    {{ $latihan->cabor }}
                </div>

                <h1 class="info-title">{{ $latihan->nama_tempat }}</h1>
                <div class="info-cabang">Tempat Latihan {{ $latihan->cabor }}</div>

                {{-- Meta grid: Cabor, Alamat, Pelatih, No. Telepon --}}
                <div class="meta-grid">
                    <div class="meta-item">
                        <div class="meta-icon"><i class="bi bi-person-badge-fill"></i></div>
                        <div>
                            <div class="meta-label">Cabang Olahraga</div>
                            <div class="meta-value">{{ $latihan->cabor }}</div>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <div class="meta-label">Alamat</div>
                            <div class="meta-value">{{ $latihan->alamat }}</div>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon"><i class="bi bi-people-fill"></i></div>
                        <div>
                            <div class="meta-label">Nama Pelatih</div>
                            <div class="meta-value">{{ $latihan->nama_pelatih }}</div>
                        </div>
                    </div>
                    @if($latihan->no_telepon)
                    <div class="meta-item">
                        <div class="meta-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="meta-label">No. Telepon / WhatsApp</div>
                            <div class="meta-value">{{ $latihan->no_telepon }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="divider"></div>

                {{-- Deskripsi --}}
                @if($latihan->deskripsi)
                <div class="link-box">
                    <i class="bi bi-file-text-fill"></i>
                    <div class="link-box-inner">
                        <div class="link-box-label">Deskripsi</div>
                        <div class="meta-value" style="font-weight:400; line-height:1.6; color:#333;">
                            {{ $latihan->deskripsi }}
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                @endif

                {{-- Link Google Maps --}}
                @if($latihan->link_maps)
                <div class="link-box">
                    <i class="bi bi-map-fill"></i>
                    <div class="link-box-inner">
                        <div class="link-box-label">Lokasi di Google Maps</div>
                        <a class="link-box-url" href="{{ $latihan->link_maps }}" target="_blank" rel="noopener">
                            {{ $latihan->link_maps }}
                        </a>
                    </div>
                    <a href="{{ $latihan->link_maps }}" target="_blank" rel="noopener" class="btn-daftar">
                        Buka Maps <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
                <div class="divider"></div>
                @endif

                {{-- Contact Person / Pelatih --}}
                <div class="organizer-box">
                    <div class="org-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div>
                        <div class="org-label">Contact Person Pelatih</div>
                        <div class="org-name">{{ $latihan->nama_pelatih }}</div>
                        @if($latihan->no_telepon)
                        <div style="margin-top:4px;">
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $latihan->no_telepon) }}"
                               target="_blank"
                               style="color:var(--accent);font-size:12px;font-weight:600;text-decoration:none;">
                                <i class="bi bi-whatsapp"></i> {{ $latihan->no_telepon }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        {{-- Back button --}}
        <div class="back-section">
            <a href="{{ route('landing') }}" class="btn-back-main">
                <i class="bi bi-arrow-left"></i> Lihat Tempat Latihan Lainnya
            </a>
        </div>
    </div>

    {{-- ══ FOOTER ══ --}}
    <footer class="footer">
        <div class="footer-brand">LOMBA<span>KU</span></div>
        <div class="footer-copy">&copy; {{ date('Y') }} Platform Lomba Olahraga. All rights reserved.</div>
    </footer>

</body>

</html>
