<header class="navbar">
    <div class="container nav-inner">
        <div style="display: flex; align-items: center; gap: 2rem;">
            <a href="{{ route('home') }}" class="brand-logo">
                <span class="brand-badge">W</span>
                <span>WartaKini</span>
            </a>

            <nav class="nav-links" aria-label="Navigasi Utama">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dasbor</a>
                    <a href="{{ route('articles.index') }}" class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}">Kelola Artikel</a>
                @endauth
            </nav>
        </div>

        <div class="nav-actions">
            @auth
                <a href="{{ route('articles.create') }}" class="btn btn-primary" style="padding: 0.45rem 0.9rem; font-size: 0.85rem;">
                    + Tulis Berita
                </a>
                <div class="user-pill">
                    <span class="avatar-circle">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    <span>{{ auth()->user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-danger-ghost" style="font-size: 0.85rem;">Keluar</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar Penulis</a>
            @endguest
        </div>
    </div>
</header>