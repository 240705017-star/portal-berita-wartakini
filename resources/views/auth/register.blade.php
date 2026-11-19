<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — WartaKini</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-surface: #ffffff;
            --bg-subtle: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger-bg: #fef2f2;
            --danger-border: #fecaca;
            --danger-text: #b91c1c;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-main);
            background-color: var(--bg-surface);
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            -webkit-font-smoothing: antialiased;
        }

        .brand-panel {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 55%, #172554 100%);
            color: #ffffff;
            padding: 3rem 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .brand-panel::after {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, transparent 70%);
            bottom: -100px;
            right: -100px;
            pointer-events: none;
        }
        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 1.35rem;
            font-weight: 800;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: -0.02em;
        }
        .brand-badge {
            width: 34px;
            height: 34px;
            background: var(--primary);
            border-radius: 8px;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: 1.1rem;
        }
        .brand-copy h1 {
            font-size: 2.15rem;
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -0.03em;
            margin: 0 0 1rem 0;
        }
        .brand-copy p {
            color: #cbd5e1;
            font-size: 1rem;
            line-height: 1.65;
            max-width: 420px;
            margin: 0;
        }
        .brand-footer {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2.5rem 2rem;
            position: relative;
        }
        .back-home {
            position: absolute;
            top: 1.75rem;
            right: 2rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.15s;
        }
        .back-home:hover { color: var(--primary); }

        .form-container {
            width: 100%;
            max-width: 390px;
            margin: 0 auto;
        }
        .form-header { margin-bottom: 1.75rem; }
        .form-header h2 {
            font-size: 1.65rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0 0 0.4rem 0;
        }
        .form-header p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.925rem;
        }

        .alert-error {
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }
        .alert-error ul { margin: 0; padding-left: 1.15rem; }

        .form-group { margin-bottom: 1.1rem; }
        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.4rem;
        }
        .input-wrapper { position: relative; }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.68rem 0.9rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: inherit;
            color: var(--text-main);
            background: var(--bg-subtle);
            transition: all 0.15s ease;
        }
        input:focus {
            outline: none;
            background: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.14);
        }
        .toggle-pass {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            padding: 0.25rem 0.4rem;
        }
        .toggle-pass:hover { color: var(--text-main); }

        .btn-primary {
            width: 100%;
            padding: 0.78rem 1rem;
            margin-top: 0.5rem;
            background: var(--primary);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
            transition: background 0.15s, transform 0.1s;
        }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-primary:active { transform: scale(0.99); }

        .auth-switch {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        .auth-switch a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }
        .auth-switch a:hover { text-decoration: underline; }

        @media (max-width: 860px) {
            body { grid-template-columns: 1fr; }
            .brand-panel { display: none; }
        }
    </style>
</head>
<body>

    <aside class="brand-panel">
        <a href="{{ route('home') }}" class="brand-logo">
            <span class="brand-badge">W</span>
            <span>WartaKini</span>
        </a>

        <div class="brand-copy">
            <h1>Bergabung Menjadi Kontributor Berita.</h1>
            <p>Buat akun penulis Anda dalam hitungan detik dan mulai bagikan informasi terpercaya kepada pembaca.</p>
        </div>

        <div class="brand-footer">
            &copy; {{ date('Y') }} WartaKini Media Portal. Semua hak dilindungi.
        </div>
    </aside>

    <main class="form-panel">
        <a href="{{ route('home') }}" class="back-home">&larr; Kembali ke Beranda</a>

        <div class="form-container">
            <div class="form-header">
                <h2>Buat akun baru</h2>
                <p>Lengkapi data diri di bawah untuk mulai menulis artikel.</p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password (minimal 8 karakter)</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="••••••••" required style="padding-right: 4.2rem;">
                        <button type="button" class="toggle-pass" onclick="togglePassword('password', this)">Lihat</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required style="padding-right: 4.2rem;">
                        <button type="button" class="toggle-pass" onclick="togglePassword('password_confirmation', this)">Lihat</button>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Daftar Sekarang</button>
            </form>

            <p class="auth-switch">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </p>
        </div>
    </main>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = 'Tutup';
            } else {
                input.type = 'password';
                btn.textContent = 'Lihat';
            }
        }
    </script>
</body>
</html>