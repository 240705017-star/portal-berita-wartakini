<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') — WartaKini</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-soft: #eff6ff;
            --dark: #0f172a;
            --dark-soft: #1e293b;
            --bg-body: #f8fafc;
            --bg-surface: #ffffff;
            --text-main: #0f172a;
            --text-secondary: #334155;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --success: #16a34a;
            --success-soft: #f0fdf4;
            --radius: 14px;
            --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.05);
            --shadow-md: 0 10px 25px -5px rgba(15, 23, 42, 0.07), 0 4px 10px -6px rgba(15, 23, 42, 0.05);
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 1.25rem;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px;
            gap: 1.5rem;
        }
        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-main);
            text-decoration: none;
            letter-spacing: -0.025em;
        }
        .brand-badge {
            width: 34px;
            height: 34px;
            background: var(--primary);
            color: #ffffff;
            border-radius: 9px;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: 1.05rem;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }
        .nav-link {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.925rem;
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            transition: all 0.15s;
        }
        .nav-link:hover {
            color: var(--text-main);
            background: #f1f5f9;
        }
        .nav-link.active {
            color: var(--primary);
            background: var(--primary-soft);
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: #f1f5f9;
            padding: 0.35rem 0.75rem 0.35rem 0.4rem;
            border-radius: 999px;
        }
        .avatar-circle {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--dark);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            display: grid;
            place-items: center;
            text-transform: uppercase;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            border-radius: 9px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.15s;
        }
        .btn-primary {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 2px 5px rgba(37, 99, 235, 0.22);
        }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-outline {
            background: #ffffff;
            border-color: var(--border);
            color: var(--text-secondary);
        }
        .btn-outline:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: var(--text-main);
        }
        .btn-danger-ghost {
            background: transparent;
            color: var(--danger);
            padding: 0.45rem 0.75rem;
        }
        .btn-danger-ghost:hover { background: var(--danger-soft); }

        /* Shared Card & Form Elements (for Dashboard & CRUD) */
        main.page-content {
            flex: 1;
            padding: 2rem 0 3.5rem 0;
        }
        .card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
        }
        .row {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }
        .muted { color: var(--text-muted); }
        .inline { display: inline; }
        .flash {
            background: var(--success-soft);
            border: 1px solid #bbf7d0;
            color: #15803d;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin: 1rem 0;
            font-weight: 500;
        }
        .error {
            background: var(--danger-soft);
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin: 1rem 0;
        }
        form label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.4rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }
        input[type=text], input[type=url], input[type=email], input[type=password], textarea {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.95rem;
            background: #f8fafc;
            margin-bottom: 0.5rem;
        }
        input:focus, textarea:focus {
            outline: none;
            background: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.12);
        }

        /* Footer */
        .site-footer {
            background: var(--dark);
            color: #94a3b8;
            padding: 2.5rem 0;
            margin-top: auto;
            font-size: 0.875rem;
        }
        .footer-inner {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
        .footer-brand {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 720px) {
            .nav-inner { height: auto; padding: 0.85rem 0; flex-wrap: wrap; }
        }
    </style>
    @stack('styles')
</head>
<body>

    @include('partials.nav')

    <main class="page-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <div class="footer-brand">
                <span class="brand-badge" style="width: 26px; height: 26px; font-size: 0.85rem;">W</span>
                <span>WartaKini</span>
            </div>
            <div>Portal Berita Digital &bull; Dikelola dengan Sistem Redaksi Modern.</div>
            <div>&copy; {{ date('Y') }} WartaKini Media.</div>
        </div>
    </footer>

</body>
</html>