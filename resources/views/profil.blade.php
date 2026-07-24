@extends('layouts.app')

@section('title', 'Profil - LombaKU')
@section('page_label', 'PROFIL')

@push('styles')
    <style>
        .profil-wrap {
            padding: 20px 16px 32px;
        }

        /* ── Hero Card ── */
        .profil-hero {
            background: var(--black);
            border-radius: var(--radius);
            padding: 28px 20px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .profil-hero::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            background: var(--accent);
            opacity: .08;
            border-radius: 50%;
        }

        .profil-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            border: 3px solid rgba(255, 255, 255, .15);
        }

        .profil-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 1.5px;
            color: #fff;
            margin-bottom: 4px;
        }

        .profil-email {
            font-size: 12px;
            color: #888;
            margin-bottom: 12px;
        }

        .profil-badge {
            display: inline-block;
            background: rgba(41, 121, 255, .2);
            color: var(--accent);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid rgba(41, 121, 255, .3);
        }

        /* ── Section Card ── */
        .profil-section {
            background: var(--card-bg);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        }

        .profil-section-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 14px 16px 8px;
            border-bottom: 1px solid #f0f0f0;
        }

        .profil-menu-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            text-decoration: none;
            color: var(--black);
            font-size: 14px;
            font-weight: 500;
            border-bottom: 1px solid #f5f5f5;
            transition: background .15s;
        }

        .profil-menu-item:last-child {
            border-bottom: none;
        }

        .profil-menu-item:hover {
            background: #fafafa;
        }

        .profil-menu-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .icon-blue {
            background: rgba(41, 121, 255, .1);
            color: var(--accent);
        }

        .icon-yellow {
            background: rgba(232, 184, 0, .12);
            color: var(--accent2);
        }

        .icon-green {
            background: rgba(16, 185, 129, .1);
            color: #10b981;
        }

        .icon-red {
            background: rgba(229, 53, 53, .1);
            color: #e53535;
        }

        .profil-menu-arrow {
            margin-left: auto;
            color: #ccc;
            font-size: 14px;
        }

        .profil-menu-value {
            margin-left: auto;
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ── Stat row ── */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 14px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 14px 10px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        }

        .stat-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            color: var(--black);
            line-height: 1.2;
            min-height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-number .small-text {
            font-size: 13px;
        }

        .stat-label {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 3px;
            font-weight: 600;
            letter-spacing: .5px;
        }

        /* ── Logout button ── */
        .btn-logout {
            display: block;
            width: 100%;
            padding: 13px;
            background: transparent;
            border: 1.5px solid #e53535;
            border-radius: 10px;
            color: #e53535;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background .2s, color .2s;
            margin-top: 4px;
        }

        .btn-logout:hover {
            background: #e53535;
            color: #fff;
        }

        .join-date {
            font-size: 11px;
            color: #aaa;
            text-align: center;
            margin-top: 10px;
            padding-bottom: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="profil-wrap">

        {{-- ── Hero ── --}}
        <div class="profil-hero">
            <div class="profil-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="profil-name">{{ Auth::user()->name }}</div>
            <div class="profil-email">{{ Auth::user()->email }}</div>
            <span class="profil-badge">
                <i class="bi bi-person-check-fill"></i> USER AKTIF
            </span>
        </div>

        {{-- ── Statistik Singkat ── --}}
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-number">{{ Auth::user()->forums()->count() }}</div>
                <div class="stat-label">Postingan</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ Auth::user()->forumComments()->count() }}</div>
                <div class="stat-label">Komentar</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    {{-- BARU --}}
                    @php
                        $days = (int) Auth::user()->created_at->diffInDays(now());
                    @endphp
                    {{ $days }} <span class="small-text" style="margin-left:4px;">hari</span>
                </div>
                <div class="stat-label">Bergabung</div>
            </div>
        </div>

        <!-- {{-- ── Menu Akun ── --}}
        <div class="profil-section">
            <div class="profil-section-title">Akun Saya</div>

            <a href="{{ route('forum.myposts') }}" class="profil-menu-item">
                <div class="profil-menu-icon icon-blue">
                    <i class="bi bi-chat-dots-fill"></i>
                </div>
                Postingan Forum Saya
                <span class="profil-menu-arrow"><i class="bi bi-chevron-right"></i></span>
            </a>
        </div> -->

        {{-- ── Info Akun ── --}}
        <div class="profil-section">
            <div class="profil-section-title">
                Informasi Akun
                <a href="{{ route('profile.edit') }}"
                    style="float:right; font-size:12px; color:var(--accent); text-decoration:none; font-weight:600;">
                    <i class="bi bi-gear-fill"></i> setting
                </a>
            </div>

            <div class="profil-menu-item" style="cursor:default;">
                <div class="profil-menu-icon icon-blue">
                    <i class="bi bi-person-fill"></i>
                </div>
                Nama
                <span class="profil-menu-value">{{ Auth::user()->name }}</span>
            </div>

            <div class="profil-menu-item" style="cursor:default;">
                <div class="profil-menu-icon icon-blue">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                Email
                <span class="profil-menu-value">{{ Auth::user()->email }}</span>
            </div>

            <div class="profil-menu-item" style="cursor:default;">
                <div class="profil-menu-icon icon-green">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
                Bergabung
                <span class="profil-menu-value">{{ Auth::user()->created_at->format('d M Y') }}</span>
            </div>
        </div>

        {{-- ── Logout ── --}}
        <div class="profil-section" style="padding:16px;">
            <a href="{{ route('logout') }}" class="btn-logout" onclick="return confirm('Yakin ingin keluar dari akun?')">
                <i class="bi bi-box-arrow-right"></i> Keluar dari Akun
            </a>
        </div>

        <p class="join-date">
            <i class="bi bi-clock"></i>
            Member sejak {{ Auth::user()->created_at->format('d F Y') }}
        </p>

    </div>
@endsection