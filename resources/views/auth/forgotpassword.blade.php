<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — LombaKU</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Salin style dari login.blade.php kamu */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --black: #0f0f0f; --accent: #2979ff; --accent2: #e8b800; --text-muted: #888; }
        body { font-family: 'DM Sans', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--black); padding: 40px 20px; }
        .bg-grid { position: fixed; inset: 0; background-image: repeating-linear-gradient(90deg, rgba(255,255,255,.02) 0px, rgba(255,255,255,.02) 1px, transparent 1px, transparent 60px), repeating-linear-gradient(0deg, rgba(255,255,255,.02) 0px, rgba(255,255,255,.02) 1px, transparent 1px, transparent 60px); pointer-events: none; }
        .login-wrapper { position: relative; z-index: 10; width: 100%; max-width: 420px; }
        .login-card { background: rgba(26,26,26,.85); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,.08); border-radius: 20px; padding: 44px 40px; box-shadow: 0 25px 60px rgba(0,0,0,.5); }
        .login-header { text-align: center; margin-bottom: 32px; }
        .login-logo { display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: linear-gradient(135deg, var(--accent), #1a5cd6); border-radius: 16px; margin-bottom: 20px; box-shadow: 0 8px 24px rgba(41,121,255,.35); }
        .login-logo i { font-size: 28px; color: #fff; }
        .login-title { font-family: 'Bebas Neue', sans-serif; font-size: 28px; letter-spacing: 2px; color: #fff; margin-bottom: 6px; }
        .login-title span { color: var(--accent); }
        .login-subtitle { font-size: 13px; color: var(--text-muted); }
        .accent-line { width: 50px; height: 4px; background: linear-gradient(90deg, var(--accent), var(--accent2)); border-radius: 2px; margin: 0 auto 20px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 12px; font-weight: 600; color: #aaa; letter-spacing: .8px; text-transform: uppercase; margin-bottom: 8px; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #555; font-size: 16px; pointer-events: none; }
        .form-input { width: 100%; background: rgba(255,255,255,.05); border: 1.5px solid rgba(255,255,255,.1); border-radius: 10px; padding: 13px 14px 13px 44px; font-size: 14px; font-family: inherit; color: #fff; outline: none; transition: all .2s; }
        .form-input::placeholder { color: #555; }
        .form-input:focus { border-color: var(--accent); background: rgba(41,121,255,.05); box-shadow: 0 0 0 3px rgba(41,121,255,.12); }
        .btn-login { width: 100%; background: linear-gradient(135deg, var(--accent), #1a5cd6); color: #fff; border: none; border-radius: 10px; padding: 14px 24px; font-size: 14px; font-family: inherit; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 6px 20px rgba(41,121,255,.35); transition: all .2s; }
        .btn-login:hover { transform: translateY(-2px); }
        .login-footer { text-align: center; margin-top: 24px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,.06); }
        .login-footer a { color: #888; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 6px; transition: color .2s; }
        .login-footer a:hover { color: #fff; }
        .info-box { background: rgba(41,121,255,.1); border: 1px solid rgba(41,121,255,.25); border-radius: 10px; padding: 12px 16px; font-size: 13px; color: #7eb3ff; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 10px; }
        .info-box i { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
    </style>
</head>
<body>
    <div class="bg-grid"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="accent-line"></div>
                <div class="login-logo">
                    <i class="bi bi-key-fill"></i>
                </div>
                <h1 class="login-title">LUPA <span>PASSWORD</span></h1>
                <p class="login-subtitle">Masukkan email untuk menerima link reset</p>
            </div>

            <div class="info-box">
                <i class="bi bi-info-circle-fill"></i>
                <span>Kami akan mengirimkan link reset password ke email kamu. Link berlaku selama 60 menit.</span>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrap">
                        <input type="email" name="email" class="form-input"
                               placeholder="Masukkan email terdaftar"
                               value="{{ old('email') }}" required>
                        <span class="input-icon"><i class="bi bi-envelope-fill"></i></span>
                    </div>
                    @error('email')
                        <p style="color:#ff6b6b;font-size:12px;margin-top:6px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-send-fill"></i>
                    KIRIM LINK RESET
                </button>
            </form>

            <div class="login-footer">
                <a href="{{ route('login.user') }}">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>