<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LombaKU')</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
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
            /* Beri ruang di bawah agar konten tidak tertutup navbar */
            padding-bottom: 70px;
        }

        /* ══════════════════════════════
           TOP NAVBAR
        ══════════════════════════════ */
        .navbar {
            background: var(--black);
            padding: 0 16px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid var(--accent);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 2px;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand span {
            color: var(--accent);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Page label badge di topbar */
        .page-label {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 11px;
            letter-spacing: 1.5px;
            color: var(--black);
            background: var(--accent2);
            padding: 3px 10px;
            border-radius: 4px;
        }

        /* Avatar user kecil di topbar */
        .topbar-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        /* Search bar styles */
        .search-wrap {
            position: relative;
            flex: 1;
            max-width: 300px;
            margin: 0 16px;
        }

        .search-input {
            width: 100%;
            background: #1a1a1a;
            border: 1.5px solid #333;
            border-radius: 8px;
            padding: 7px 14px;
            color: #fff;
            font-size: 13px;
            font-family: inherit;
            outline: none;
            transition: border .2s;
        }

        .search-input::placeholder {
            color: #555;
        }

        .search-input:focus {
            border-color: var(--accent);
        }

        .search-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: #1a1a1a;
            border: 1.5px solid #333;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 12px 32px rgba(0, 0, 0, .4);
            z-index: 999;
            display: none;
            max-height: 360px;
            overflow-y: auto;
            min-width: 280px;
        }

        .search-dropdown.show {
            display: block;
        }

        /* Media query khusus untuk HP */
        @media (max-width: 768px) {

            /* Biarkan search-wrap tetap relative */
            .search-wrap {
                position: relative !important;
                width: 100%;
            }

            /* Dropdown tetap absolute, ikut lebar search-wrap */
            .search-dropdown {
                position: absolute;
                top: calc(100% + 8px);
                left: 0;
                right: 0;
                width: 100%;
                /* ikuti lebar parent */
                min-width: auto;
                max-width: none;
            }

            .search-dropdown.show {
                display: block;
            }
        }

        .dropdown-section-label {
            padding: 8px 14px 4px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #555;
            text-transform: uppercase;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            text-decoration: none;
            color: #ddd;
            font-size: 13px;
            transition: background .15s;
            border-top: 1px solid #222;
        }

        .dropdown-item:hover {
            background: #252525;
            color: #fff;
        }

        .dropdown-item-icon {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .icon-lomba {
            background: rgba(41, 121, 255, .15);
            color: var(--accent);
        }

        .icon-tempat {
            background: rgba(232, 184, 0, .15);
            color: var(--accent2);
        }

        .dropdown-item-info small {
            display: block;
            font-size: 10px;
            color: #555;
            margin-top: 1px;
        }

        .dropdown-empty {
            padding: 20px 14px;
            font-size: 13px;
            color: #555;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-wrap: wrap;
                height: auto;
                padding: 8px 12px;
                gap: 8px;
            }

            .search-wrap {
                order: 3;
                width: 100%;
                max-width: none;
                margin: 4px 0;
            }

            .navbar-right {
                flex: 1;
                justify-content: flex-end;
            }
        }

        /* ══════════════════════════════
           MAIN CONTENT
        ══════════════════════════════ */
        .main-content {
            max-width: 480px;
            /* batasi lebar di layar besar agar tetap mobile feel */
            margin: 0 auto;
        }

        /* Fullscreen di laptop/desktop (lebar > 768px) */
        @media (min-width: 769px) {
            .main-content {
                max-width: 100%;
                padding: 0;
            }
        }

        /* ══════════════════════════════
           TOAST NOTIFICATION (Top)
        ══════════════════════════════ */
        .toast-container {
            position: fixed;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: calc(100% - 32px);
            width: 400px;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 12px;
            background: #1a1a1a;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.05);
            pointer-events: auto;
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
            position: relative;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .toast.hide {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }

        /* Gradient bar kiri */
        .toast::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
        }

        .toast-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .toast-icon i {
            font-size: 18px;
            color: #fff;
        }

        .toast-content {
            flex: 1;
            min-width: 0;
        }

        .toast-title {
            font-weight: 700;
            font-size: 14px;
            color: #fff;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 12px;
            color: #999;
            line-height: 1.4;
        }

        .toast-close {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            border: none;
            color: #666;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .toast-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* Toast Types */
        .toast.toast-success::before {
            background: linear-gradient(180deg, #22c55e, #16a34a);
        }

        .toast.toast-success .toast-icon {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .toast.toast-error::before {
            background: linear-gradient(180deg, #ef4444, #dc2626);
        }

        .toast.toast-error .toast-icon {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .toast.toast-warning::before {
            background: linear-gradient(180deg, #f59e0b, #d97706);
        }

        .toast.toast-warning .toast-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .toast.toast-info::before {
            background: linear-gradient(180deg, var(--accent), #1a6ce8);
        }

        .toast.toast-info .toast-icon {
            background: linear-gradient(135deg, var(--accent), #1a6ce8);
        }

        /* Progress bar di bawah toast */
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            border-radius: 0 0 12px 12px;
            transition: width linear;
        }

        .toast.toast-success .toast-progress {
            background: #22c55e;
        }

        .toast.toast-error .toast-progress {
            background: #ef4444;
        }

        .toast.toast-warning .toast-progress {
            background: #f59e0b;
        }

        .toast.toast-info .toast-progress {
            background: var(--accent);
        }

        /* Mobile */
        @media (max-width: 480px) {
            .toast-container {
                top: 60px;
                width: calc(100% - 24px);
            }

            .toast {
                padding: 12px 14px;
            }

            .toast-icon {
                width: 32px;
                height: 32px;
            }

            .toast-icon i {
                font-size: 16px;
            }
        }

        /* ══════════════════════════════
           POPUP NOTIFICATION (Modal)
        ══════════════════════════════ */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 62px;
            background: var(--black);
            border-top: 3px solid var(--accent);
            display: flex;
            align-items: stretch;
            z-index: 200;
            max-width: 480px;
            /* sesuaikan dengan main-content */
            margin: 0 auto;
        }

        /* Desktop: full width, simetris */
        @media (min-width: 769px) {
            .bottom-nav {
                max-width: 100%;
                left: 0;
                right: 0;
                height: 70px;
                justify-content: space-evenly;
            }

            .nav-item {
                flex: 0 0 auto;
                min-width: 100px;
            }

            .nav-item i {
                font-size: 26px;
            }

            .nav-item span {
                font-size: 10px;
            }
        }

        .nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            text-decoration: none;
            color: #555;
            transition: color .15s;
            position: relative;
        }

        .nav-item i {
            font-size: 22px;
            transition: color .15s;
        }

        .nav-item span {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .nav-item.active,
        .nav-item.active i {
            color: var(--accent);
        }

        /* Notif badge (opsional) */
        .nav-badge {
            position: absolute;
            top: 8px;
            right: 14px;
            width: 8px;
            height: 8px;
            background: #e53535;
            border-radius: 50%;
            border: 1.5px solid var(--black);
        }

        /* ══════════════════════════════
           FLASH MESSAGE (global)
        ══════════════════════════════ */
        .flash-success,
        .flash-error {
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            margin: 12px 16px 0;
        }

        .flash-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .flash-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* ══════════════════════════════
           YIELD STYLES (dari child view)
        ══════════════════════════════ */
        @yield('styles')
    </style>

    {{-- Style tambahan dari halaman child --}}
    @stack('styles')
</head>

<body>

    {{-- ══ TOP NAVBAR ══ --}}
    <nav class="navbar">
        {{-- Kiri: Logo + Search --}}
        <div style="display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0;">
            <a href="{{ route('landing') }}" class="navbar-brand" style="flex-shrink: 0;">
                <i class="bi bi-trophy-fill" style="color:var(--accent);font-size:18px;"></i>
                LOMBA<span>KU</span>
            </a>

            {{-- Search Wrap --}}
            @php
                $hideSearch = request()->routeIs('notifications.*') || request()->routeIs('profil') || request()->routeIs('profile.*');
            @endphp

            @if(!$hideSearch)
                <div class="search-wrap" id="globalSearchWrap"
                    style="flex: 1; max-width: 300px; min-width: 120px; margin: 0;">
                    <input type="text" id="globalSearchInput" class="search-input"
                        placeholder="Cari lomba, tempat, forum..." autocomplete="off">
                    <div id="globalSearchDropdown" class="search-dropdown"></div>
                </div>
            @endif
        </div>

        {{-- Kanan: Label + Avatar --}}
        <div class="navbar-right" style="flex-shrink: 0;">
            <span class="page-label">@yield('page_label', 'HOME')</span>
            @auth
                <a href="{{ route('profil') }}" class="topbar-avatar" title="{{ Auth::user()->name }}">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </a>
            @else
                <a href="{{ route('login.user') }}" class="topbar-avatar" title="Login">
                    <i class="bi bi-person" style="font-size:15px;"></i>
                </a>
            @endauth
        </div>
    </nav>

    {{-- ══ TOAST CONTAINER ══ --}}
    <div class="toast-container" id="toastContainer"></div>

    {{-- ══ KONTEN UTAMA ══ --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- ══ BOTTOM NAVIGATION ══ --}}
    <nav class="bottom-nav">

        {{-- Lomba --}}
        <a href="{{ route('landing') }}"
            class="nav-item {{ request()->is('/') || request()->is('lomba*') ? 'active' : '' }}">
            <i class="bi bi-trophy{{ request()->is('/') || request()->is('lomba*') ? '-fill' : '' }}"></i>
            <span>Lomba</span>
        </a>

        <a href="{{ route('tempatlatihan.index') }}"
            class="nav-item {{ request()->is('tempatlatihan*') ? 'active' : '' }}">
            <i class="bi bi-map{{ request()->is('tempatlatihan*') ? '-fill' : '' }}"></i>
            <span>Tempat Latihan</span>
        </a>

        {{-- Forum --}}
        <a href="{{ route('forum.index') }}" class="nav-item {{ request()->is('forum*') ? 'active' : '' }}">
            <i class="bi bi-chat-dots{{ request()->is('forum*') ? '-fill' : '' }}"></i>
            <span>Forum</span>
        </a>

        {{-- Notifikasi --}}
        @auth
            <a href="{{ route('notifications.index') }}"
                class="nav-item {{ request()->is('notifications*') ? 'active' : '' }}">
                <i class="bi bi-bell{{ request()->is('notifications*') ? '-fill' : '' }}"></i>
                <span>Notif</span>
                @if(isset($unreadNotificationCount) && $unreadNotificationCount > 0)
                    <span class="nav-badge"
                        id="navNotifBadge">{{ $unreadNotificationCount > 9 ? '9+' : $unreadNotificationCount }}</span>
                @else
                    <span class="nav-badge" id="navNotifBadge" style="display:none;"></span>
                @endif
            </a>
        @else
            <a href="{{ route('login.user') }}" class="nav-item">
                <i class="bi bi-bell"></i>
                <span>Notif</span>
            </a>
        @endauth

        {{-- Profil --}}
        @auth
            <a href="{{ route('profil') }}" class="nav-item {{ request()->is('profil*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i>
                <span>Profil</span>
            </a>
        @else
            <a href="{{ route('login.user') }}" class="nav-item">
                <i class="bi bi-person"></i>
                <span>Masuk</span>
            </a>
        @endauth

    </nav>

    {{-- ══ SCRIPTS ══ --}}
    @stack('scripts')
    <script>
        // ══════════════════════════════
        // TOAST NOTIFICATION SYSTEM
        // ══════════════════════════════
        function showToast(type, title, message, duration = 4000) {
            const container = document.getElementById('toastContainer');
            if (!container) return;

            const icons = {
                success: 'bi-check-circle-fill',
                error: 'bi-x-circle-fill',
                warning: 'bi-exclamation-circle-fill',
                info: 'bi-info-circle-fill'
            };

            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="bi ${icons[type] || icons.info}"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">
                    <i class="bi bi-x"></i>
                </button>
                <div class="toast-progress" style="width: 100%"></div>
            `;

            container.appendChild(toast);

            // Trigger animation
            requestAnimationFrame(() => {
                toast.classList.add('show');
            });

            // Progress bar animation
            const progress = toast.querySelector('.toast-progress');
            progress.style.transition = `width ${duration}ms linear`;
            requestAnimationFrame(() => {
                progress.style.width = '0%';
            });

            // Auto remove
            const removeToast = () => {
                toast.classList.remove('show');
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 400);
            };

            const timeoutId = setTimeout(removeToast, duration);

            // Pause on hover
            toast.addEventListener('mouseenter', () => {
                clearTimeout(timeoutId);
                progress.style.transition = 'none';
                progress.style.width = progress.offsetWidth + 'px';
            });

            toast.addEventListener('mouseleave', () => {
                const remaining = (parseFloat(progress.style.width) / 100) * duration;
                progress.style.transition = `width ${remaining}ms linear`;
                progress.style.width = '0%';
                setTimeout(removeToast, remaining);
            });
        }

        // Show toasts from session on page load
        document.addEventListener('DOMContentLoaded', () => {
            // Success toast
            @if (session('toast_success'))
                showToast('success', 'Berhasil', '{{ session('toast_success') }}', 4000);
            @endif

            // Error toast
            @if (session('toast_error'))
                showToast('error', 'Gagal', '{{ session('toast_error') }}', 5000);
            @endif

            // Warning toast
            @if (session('toast_warning'))
                showToast('warning', 'Perhatian', '{{ session('toast_warning') }}', 4000);
            @endif

            // Info toast
            @if (session('toast_info'))
                showToast('info', 'Info', '{{ session('toast_info') }}', 4000);
            @endif
        });

        // Data search
        window.searchData = @json($searchData ?? []);

        function updateGlobalDropdown() {
            const q = document.getElementById('globalSearchInput')?.value.toLowerCase().trim();
            const dropdown = document.getElementById('globalSearchDropdown');
            if (!q) { dropdown?.classList.remove('show'); return; }

            // Filter semua data
            const results = (window.searchData || []).filter(d =>
                d.nama.toLowerCase().includes(q) ||
                d.cabang.toLowerCase().includes(q) ||
                d.lokasi.toLowerCase().includes(q)
            ).slice(0, 10); // batasi maksimal 10 hasil

            let html = '';
            if (results.length) {
                results.forEach(d => {
                    let iconClass = 'bi-file-text';
                    let iconBg = 'icon-info';
                    if (d.type === 'lomba') {
                        iconClass = 'bi-trophy-fill';
                        iconBg = 'icon-lomba';
                    } else if (d.type === 'tempat') {
                        iconClass = 'bi-building';
                        iconBg = 'icon-tempat';
                    } else if (d.type === 'forum') {
                        iconClass = 'bi-chat-dots-fill';
                        iconBg = 'icon-forum';
                    }
                    html += `<a href="${d.url}" class="dropdown-item">
                <div class="dropdown-item-icon ${iconBg}"><i class="bi ${iconClass}"></i></div>
                <div class="dropdown-item-info">${d.nama}<small>${d.cabang ? d.cabang + ' · ' : ''}${d.lokasi}</small></div>
            </a>`;
                });
            } else {
                html = `<div class="dropdown-empty">Tidak ada hasil untuk "<strong>${q}</strong>"</div>`;
            }
            dropdown.innerHTML = html;
            dropdown.classList.add('show');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('globalSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', updateGlobalDropdown);
                searchInput.addEventListener('focus', updateGlobalDropdown);
            }
            document.addEventListener('click', e => {
                if (!e.target.closest('.search-wrap')) {
                    document.getElementById('globalSearchDropdown')?.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>