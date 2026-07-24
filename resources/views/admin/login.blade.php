<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Portal Lomba</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--black);
            position: relative;
            overflow: hidden;
        }

        /* ── BACKGROUND EFFECTS ── */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image:
                repeating-linear-gradient(90deg, rgba(255, 255, 255, .02) 0px, rgba(255, 255, 255, .02) 1px, transparent 1px, transparent 60px),
                repeating-linear-gradient(0deg, rgba(255, 255, 255, .02) 0px, rgba(255, 255, 255, .02) 1px, transparent 1px, transparent 60px);
            pointer-events: none;
            z-index: 0;
        }

        .bg-glow {
            position: fixed;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: .15;
            pointer-events: none;
            z-index: 0;
        }

        .bg-glow.blue {
            background: var(--accent);
            top: -200px;
            right: -100px;
        }

        .bg-glow.yellow {
            background: var(--accent2);
            bottom: -200px;
            left: -100px;
            opacity: .08;
        }

        /* ── DECORATIVE FLOATING ELEMENTS ── */
        .float-badge {
            position: fixed;
            width: 140px;
            height: 140px;
            border: 2px dashed rgba(41, 121, 255, .2);
            border-radius: 50%;
            z-index: 0;
            animation: spin 25s linear infinite;
        }

        .float-badge.top-right {
            top: 60px;
            right: 80px;
        }

        .float-badge.bottom-left {
            bottom: 80px;
            left: 60px;
            width: 100px;
            height: 100px;
            animation-direction: reverse;
            animation-duration: 18s;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── LOGIN CARD ── */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            padding: 0 20px;
        }

        .login-card {
            background: rgba(26, 26, 26, .85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 20px;
            padding: 44px 40px;
            box-shadow:
                0 25px 60px rgba(0, 0, 0, .5),
                0 0 0 1px rgba(41, 121, 255, .1) inset;
        }

        /* ── LOGO / HEADER ── */
        .login-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .login-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--accent) 0%, #1a5cd6 100%);
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px rgba(41, 121, 255, .35);
        }

        .login-logo i {
            font-size: 28px;
            color: #fff;
        }

        .login-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 2px;
            color: #fff;
            line-height: 1;
            margin-bottom: 6px;
        }

        .login-title span {
            color: var(--accent);
        }

        .login-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            letter-spacing: .5px;
        }

        /* ── ALERT ── */
        .alert {
            background: rgba(229, 53, 53, .15);
            border: 1px solid rgba(229, 53, 53, .3);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: #ff6b6b;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert i {
            font-size: 16px;
            flex-shrink: 0;
        }

        /* ── FORM ── */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #aaa;
            letter-spacing: .8px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
            font-size: 16px;
            pointer-events: none;
            transition: color .2s;
        }

        .form-input {
            width: 100%;
            background: rgba(255, 255, 255, .05);
            border: 1.5px solid rgba(255, 255, 255, .1);
            border-radius: 10px;
            padding: 13px 14px 13px 44px;
            font-size: 14px;
            font-family: inherit;
            color: #fff;
            outline: none;
            transition: all .2s;
        }

        .form-input::placeholder {
            color: #555;
        }

        .form-input:focus {
            border-color: var(--accent);
            background: rgba(41, 121, 255, .05);
            box-shadow: 0 0 0 3px rgba(41, 121, 255, .12);
        }

        .form-input:focus + .input-icon,
        .input-wrap:has(.form-input:focus) .input-icon {
            color: var(--accent);
        }

        /* ── REMEMBER ME ── */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            font-size: 13px;
        }

        .checkbox-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: #888;
        }

        .checkbox-wrap input {
            display: none;
        }

        .checkmark {
            width: 18px;
            height: 18px;
            border: 1.5px solid #444;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
        }

        .checkbox-wrap input:checked + .checkmark {
            background: var(--accent);
            border-color: var(--accent);
        }

        .checkmark i {
            font-size: 11px;
            color: #fff;
            opacity: 0;
            transition: opacity .15s;
        }

        .checkbox-wrap input:checked + .checkmark i {
            opacity: 1;
        }

        .forgot-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: opacity .2s;
        }

        .forgot-link:hover {
            opacity: .8;
        }

        /* ── BUTTON ── */
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--accent) 0%, #1a5cd6 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            font-size: 14px;
            font-family: inherit;
            font-weight: 700;
            letter-spacing: .5px;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 6px 20px rgba(41, 121, 255, .35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(41, 121, 255, .45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            font-size: 16px;
        }

        /* ── FOOTER ── */
        .login-footer {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, .06);
        }

        .login-footer a {
            color: #888;
            text-decoration: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color .2s;
        }

        .login-footer a:hover {
            color: #fff;
        }

        .login-footer a i {
            font-size: 14px;
        }

        /* ── DECORATIVE ACCENT LINE ── */
        .accent-line {
            width: 50px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            border-radius: 2px;
            margin: 0 auto 20px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
            }

            .login-title {
                font-size: 26px;
            }

            .float-badge {
                display: none;
            }
        }
    </style>
</head>

<body>

    {{-- Background Effects --}}
    <div class="bg-grid"></div>
    <div class="bg-glow blue"></div>
    <div class="bg-glow yellow"></div>

    {{-- Floating Badges --}}
    <div class="float-badge top-right"></div>
    <div class="float-badge bottom-left"></div>

    {{-- Login Card --}}
    <div class="login-wrapper">

        <div class="login-card">

            {{-- Header --}}
            <div class="login-header">
                <div class="accent-line"></div>
                <div class="login-logo">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h1 class="login-title">ADMIN <span>PORTAL</span></h1>
                <p class="login-subtitle">Masuk untuk mengelola lomba & tempat latihan</p>
            </div>

            {{-- Error Alert --}}
            @if(session('error'))
                <div class="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                {{-- Username --}}
                <div class="form-group">
                    <label class="form-label">Username / Email</label>
                    <div class="input-wrap">
                        <input type="text" name="username" class="form-input" placeholder="Masukkan username atau email"
                            required autocomplete="username">
                        <span class="input-icon">
                            <i class="bi bi-person-fill"></i>
                        </span>
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="password" class="form-input"
                            placeholder="Masukkan password" required autocomplete="current-password">
                        <span class="input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                    </div>
                </div>

                {{-- Options --}}
                <div class="form-options">
                    <label class="checkbox-wrap">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="checkmark">
                            <i class="bi bi-check"></i>
                        </span>
                        <span>Ingat saya</span>
                    </label>
                </div>

                {{-- Button --}}
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    MASUK
                </button>
            </form>

            {{-- Footer --}}
            <div class="login-footer">
                <a href="{{ url('/') }}">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>

    {{-- Bootstrap JS for Alerts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
