<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Admin' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ══ SIDEBAR ══ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--black);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            border-right: 3px solid var(--accent);
            z-index: 100;
        }

        .sidebar-profile {
            padding: 28px 20px 24px;
            border-bottom: 1px solid #2a2a2a;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #2a2a2a;
            border: 2px solid var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            flex-shrink: 0;
        }

        .avatar svg {
            width: 24px;
            height: 24px;
        }

        .profile-info .name {
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            line-height: 1.2;
        }

        .profile-info .role {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 22px;
            color: #888;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all .18s ease;
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .nav-item:hover {
            color: #fff;
            background: #1e1e1e;
        }

        .nav-item.active {
            color: #fff;
            background: #1e1e1e;
            border-left-color: var(--accent);
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid #2a2a2a;
            flex-shrink: 0;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 8px;
            transition: all .18s;
        }

        .btn-logout svg {
            width: 16px;
            height: 16px;
        }

        .btn-logout:hover {
            color: #ff4d4d;
            background: rgba(255, 77, 77, .08);
        }

        /* ══ MAIN — kunci agar topbar full width ══ */
        .main {
            margin-left: var(--sidebar-w);
            /* dorong konten ke kanan sejauh sidebar */
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width: 0;
            /* cegah overflow */
        }

        /* ══ HAMBURGER TOGGLE ══ */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 14px;
            left: 14px;
            z-index: 200;
            background: var(--black);
            border: none;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle svg {
            width: 20px;
            height: 20px;
            color: #fff;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 99;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
                height: 100vh;
                overflow: hidden;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-nav {
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .sidebar-toggle {
                display: flex;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                width: 100%;
                padding: 12px 16px 12px 60px;
            }
        }

        /* ══════════════════════════════
           TOAST NOTIFICATION (Top)
        ══════════════════════════════ */
        .toast-container {
            position: fixed;
            top: 20px;
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

        .toast.toast-success .toast-progress { background: #22c55e; }
        .toast.toast-error .toast-progress { background: #ef4444; }
        .toast.toast-warning .toast-progress { background: #f59e0b; }
        .toast.toast-info .toast-progress { background: var(--accent); }

        /* Mobile */
        @media (max-width: 480px) {
            .toast-container {
                top: 20px;
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
    </style>

    @stack('styles')
</head>

<body>
    {{-- Hamburger button --}}
    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M3 12h18M3 18h18" />
        </svg>
    </button>

    {{-- Overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- ═══════════ SIDEBAR ═══════════ -->
    <aside class="sidebar">
        <div class="sidebar-profile">
            <div class="avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
            </div>
            <div class="profile-info">
                <div class="name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="role">Admin</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="7" rx="1.5" />
                    <rect x="14" y="3" width="7" height="7" rx="1.5" />
                    <rect x="3" y="14" width="7" height="7" rx="1.5" />
                    <rect x="14" y="14" width="7" height="7" rx="1.5" />
                </svg>
                Daftar Lomba
            </a>

            <a href="{{ route('admin.lomba.create') }}"
                class="nav-item {{ request()->routeIs('admin.lomba.create', 'admin.lomba.edit') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Input Lomba
            </a>

            <a href="{{ route('admin.tempatlatihan.index') }}"
                class="nav-item {{ request()->routeIs('admin.tempatlatihan.index') ? 'active' : '' }}">
                <i class="bi bi-geo-alt-fill"></i>
                Daftar Tempat Latihan
            </a>

            <a href="{{ route('admin.tempatlatihan.create') }}"
                class="nav-item {{ request()->routeIs('admin.tempatlatihan.create', 'admin.lomba.edit') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Input Tempat Latihan
            </a>

            <a href="{{ route('admin.forum.index') }}"
                class="nav-item {{ request()->routeIs('admin.forum.index') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                </svg>
                Kelola Forum
            </a>

            <a href="{{ route('admin.forum.create') }}"
                class="nav-item {{ request()->routeIs('admin.forum.create') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Input Forum
            </a>

            <a href="{{ route('admin.settings.index') }}"
                class="nav-item {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/>
                </svg>
                Settings
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('logout') }}" class="btn-logout">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M15 3H19a2 2 0 012 2v14a2 2 0 01-2 2H15" />
                    <path d="M10 17l5-5-5-5M15 12H3" />
                </svg>
                Logout
            </a>
        </div>
    </aside>

    <!-- ═══════════ MAIN ═══════════ -->
    <div class="main">
        {{-- ══ TOAST CONTAINER ══ --}}
        <div class="toast-container" id="toastContainer"></div>

        @yield('content')
    </div>

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
    </script>
</body>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
    function closeSidebar() {
        document.querySelector('.sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('show');
    }
</script>

</html>