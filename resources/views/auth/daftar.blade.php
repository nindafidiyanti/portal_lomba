<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — LombaKU</title>

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
            align-items: flex-start;
            justify-content: center;
            background: var(--black);
            position: relative;
            overflow-y: auto;
            padding: 40px 20px 60px;
        }

        /* Scrollbar styling */
        body::-webkit-scrollbar {
            width: 8px;
        }

        body::-webkit-scrollbar-track {
            background: var(--black);
        }

        body::-webkit-scrollbar-thumb {
            background: rgba(41, 121, 255, 0.3);
            border-radius: 4px;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: rgba(41, 121, 255, 0.5);
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

        /* ── REGISTER CARD ── */
        .register-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            padding: 0 20px;
        }

        .register-card {
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
        .register-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .register-logo {
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

        .register-logo i {
            font-size: 28px;
            color: #fff;
        }

        .register-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 2px;
            color: #fff;
            line-height: 1;
            margin-bottom: 6px;
        }

        .register-title span {
            color: var(--accent);
        }

        .register-subtitle {
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

        /* ── BUTTON ── */
        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(41, 121, 255, .45);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register i {
            font-size: 16px;
        }

        /* ── FOOTER ── */
        .register-footer {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, .06);
        }

        .register-footer a {
            color: #888;
            text-decoration: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color .2s;
        }

        .register-footer a:hover {
            color: #fff;
        }

        .register-footer a i {
            font-size: 14px;
        }

        /* ── LOGIN LINK ── */
        .login-link {
            text-align: center;
            margin-top: 16px;
            font-size: 13px;
            color: #888;
        }

        .login-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            transition: opacity .2s;
        }

        .login-link a:hover {
            opacity: .8;
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

        /* Mobile - layar kecil */
        @media (max-width: 480px) {
            body {
                padding: 20px 16px 40px;
                align-items: center;
            }

            .register-wrapper {
                max-width: 100%;
            }

            .register-card {
                padding: 32px 24px;
            }

            .register-title {
                font-size: 26px;
            }

            .float-badge {
                display: none;
            }
        }

        /* Tablet */
        @media (min-width: 481px) and (max-width: 768px) {
            body {
                padding: 40px 20px 60px;
            }

            .register-wrapper {
                max-width: 460px;
            }

            .register-card {
                padding: 36px 32px;
            }

            .float-badge {
                display: none;
            }
        }

        /* Laptop / Desktop */
        @media (min-width: 769px) {
            body {
                padding: 30px 20px 50px;
                align-items: flex-start;
            }

            .register-wrapper {
                max-width: 420px;
            }

            .register-card {
                padding: 36px 40px;
                border-radius: 20px;
            }

            .register-header {
                margin-bottom: 28px;
            }

            .register-title {
                font-size: 28px;
            }

            .register-logo {
                width: 56px;
                height: 56px;
                margin-bottom: 16px;
            }

            .register-logo i {
                font-size: 26px;
            }

            .register-subtitle {
                font-size: 12px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-input {
                padding: 12px 14px 12px 42px;
                font-size: 13px;
            }

            .input-icon {
                left: 14px;
                font-size: 16px;
            }

            .btn-register {
                padding: 12px 24px;
                font-size: 13px;
            }

            .login-link {
                margin-top: 14px;
                font-size: 12px;
            }

            .register-footer {
                margin-top: 20px;
                padding-top: 20px;
            }

            .register-footer a {
                font-size: 12px;
            }

            /* Background effects lebih besar untuk desktop */
            .bg-glow.blue {
                width: 500px;
                height: 500px;
                top: -150px;
                right: -50px;
            }

            .bg-glow.yellow {
                width: 400px;
                height: 400px;
                bottom: -100px;
                left: -50px;
            }

            .float-badge {
                width: 100px;
                height: 100px;
            }

            .float-badge.top-right {
                top: 40px;
                right: 40px;
            }

            .float-badge.bottom-left {
                bottom: 40px;
                left: 40px;
            }
        }

        /* Desktop besar */
        @media (min-width: 1200px) {
            body {
                align-items: center;
                padding: 20px;
            }

            .register-wrapper {
                max-width: 440px;
            }

            .register-card {
                padding: 40px 44px;
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

    {{-- Register Card --}}
    <div class="register-wrapper">

        <div class="register-card">

            {{-- Header --}}
            <div class="register-header">
                <div class="accent-line"></div>
                <div class="register-logo">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h1 class="register-title">DAFTAR <span>AKUN</span></h1>
                <p class="register-subtitle">Buat akun untuk bergabung di forum</p>
            </div>

            {{-- Error Alert --}}
            @if(session('error'))
                <div class="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('daftar') }}">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-wrap">
                        <input type="text" name="name" class="form-input" placeholder="Masukkan nama lengkap"
                            required autocomplete="name" value="{{ old('name') }}">
                        <span class="input-icon">
                            <i class="bi bi-person-fill"></i>
                        </span>
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrap">
                        <input type="email" name="email" class="form-input" placeholder="Masukkan email"
                            required autocomplete="email" value="{{ old('email') }}">
                        <span class="input-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                    </div>
                </div>


                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="password" class="form-input"
                            placeholder="Masukkan password" required autocomplete="new-password">
                        <span class="input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input"
                            placeholder="Ulangi password" required autocomplete="new-password">
                        <span class="input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                    </div>
                </div>

                {{-- Button --}}
                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus-fill"></i>
                    DAFTAR
                </button>

                {{-- Login Link --}}
                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login.user') }}">Masuk di sini</a>
                </div>
            </form>

            {{-- Footer --}}
            <div class="register-footer">
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
