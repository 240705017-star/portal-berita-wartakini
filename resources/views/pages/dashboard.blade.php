@extends('layouts.app')

@section('title', 'Dasbor Redaksi')

@push('styles')
<style>
    /* Metric Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 1.75rem;
    }
    .stat-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }
    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        display: grid;
        place-items: center;
    }
    .stat-icon.blue { background: #eff6ff; color: #2563eb; }
    .stat-icon.indigo { background: #eef2ff; color: #4f46e5; }
    .stat-icon.emerald { background: #ecfdf5; color: #059669; }
    .stat-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .stat-value {
        font-size: 2.15rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1.1;
        margin-bottom: 0.5rem;
        letter-spacing: -0.03em;
    }
    .progress-track {
        width: 100%;
        height: 6px;
        background: #f1f5f9;
        border-radius: 999px;
        overflow: hidden;
        margin: 0.65rem 0 0.45rem 0;
    }
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #2563eb, #3b82f6);
        border-radius: 999px;
    }

    /* Main 2-Column Workspace */
    .dash-workspace {
        display: grid;
        grid-template-columns: 1.65fr 1fr;
        gap: 1.5rem;
        align-items: start;
    }
    .section-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .card-head h2 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 800;
        letter-spacing: -0.015em;
        display: flex;
        align-items: center;
        gap: 0.55rem;
    }
    .card-head h2::before {
        content: '';
        width: 4px;
        height: 18px;
        background: var(--primary);
        border-radius: 4px;
    }

    /* Feed List */
    .feed-list {
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }
    .feed-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.85rem;
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #ffffff;
        transition: all 0.15s ease;
    }
    .feed-item:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }
    .feed-thumb {
        width: 104px;
        height: 68px;
        object-fit: cover;
        border-radius: 9px;
        flex-shrink: 0;
    }
    .feed-cat {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--primary);
        display: block;
        margin-bottom: 0.15rem;
    }
    .feed-title {
        margin: 0 0 0.25rem 0;
        font-size: 0.975rem;
        font-weight: 700;
        line-height: 1.35;
    }
    .feed-title a {
        color: var(--text-main);
        text-decoration: none;
    }
    .feed-title a:hover { color: var(--primary); }

    /* Sidebar Press Card & Quick Links */
    .press-card {
        background: linear-gradient(160deg, #f8fafc 0%, #eff6ff 100%);
        border: 1px solid #dbeafe;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
    }
    .press-header {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        margin-bottom: 1.1rem;
    }
    .press-avatar {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: var(--dark);
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 800;
        display: grid;
        place-items: center;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(15, 23, 42, 0.15);
    }
    .press-meta-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        padding: 0.55rem 0;
        border-top: 1px dashed #cbd5e1;
    }
    .quick-action-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.8rem 1rem;
        border: 1px solid var(--border);
        border-radius: 11px;
        text-decoration: none;
        color: var(--text-main);
        font-weight: 600;
        font-size: 0.9rem;
        background: #ffffff;
        margin-bottom: 0.6rem;
        transition: all 0.15s;
    }
    .quick-action-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-soft);
    }

    @media (max-width: 900px) {
        .stats-grid { grid-template-columns: 1fr; }
        .dash-workspace { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    @php
        $categories = ['Nasional', 'Ekonomi & Bisnis', 'Teknologi', 'Inovasi', 'Sorotan', 'Editorial'];
        $contributionPercent = $totalArticles > 0 ? round(($myArticles / $totalArticles) * 100) : 0;
    @endphp

    {{-- Executive Welcome Banner --}}
    <section class="page-hero">
        <div>
            <div class="page-hero-badge">
                <span>Ruang Redaksi Digital &bull; {{ now()->translatedFormat('d F Y') }}</span>
            </div>
            <h1>Selamat datang, {{ $user->name }}!</h1>
            <p>
                Pantau performa publikasi berita, kelola arsip liputan, dan terbitkan informasi terkini langsung ke halaman utama WartaKini.
            </p>
        </div>

        <div class="page-hero-actions">
            <a href="{{ route('articles.index') }}" class="btn btn-glass">Kelola Arsip</a>
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Berita Baru</a>
        </div>
    </section>

    {{-- 3 Kartu Statistik Utama --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Total Berita Portal</span>
                <span class="stat-icon blue">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </span>
            </div>
            <div class="stat-value">{{ $totalArticles }}</div>
            <div class="muted" style="font-size: 0.84rem;">Artikel aktif yang tayang di beranda</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Kontribusi Anda</span>
                <span class="stat-icon indigo">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </span>
            </div>
            <div class="stat-value" style="color: var(--primary);">{{ $myArticles }}</div>
            <div class="progress-track">
                <div class="progress-fill" style="width: {{ max(6, $contributionPercent) }}%;"></div>
            </div>
            <div class="muted" style="font-size: 0.82rem;">
                Mencakup <strong>{{ $contributionPercent }}%</strong> dari total berita portal
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Status Keanggotaan</span>
                <span class="stat-icon emerald">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
            <div class="stat-value" style="font-size: 1.45rem; padding: 0.35rem 0; color: #059669;">
                Kontributor Aktif
            </div>
            <div class="muted" style="font-size: 0.84rem;">Terverifikasi &bull; Akses penuh publikasi</div>
        </div>
    </div>

    {{-- Workspace 2 Kolom --}}
    <div class="dash-workspace">
        {{-- Kolom Kiri: Feed Berita Terbaru --}}
        <section class="section-card">
            <div class="card-head">
                <h2>5 Berita Terbaru di Portal</h2>
                <a href="{{ route('home') }}" style="font-size: 0.85rem; font-weight: 600; color: var(--primary); text-decoration: none;">
                    Lihat Beranda &rarr;
                </a>
            </div>

            @if ($latestArticles->isNotEmpty())
                <div class="feed-list">
                    @foreach ($latestArticles as $article)
                        <div class="feed-item">
                            <img src="{{ $article->image_url }}"
                                 onerror="this.onerror=null;this.src='{{ $article->fallback_image }}';"
                                 alt="{{ $article->title }}"
                                 class="feed-thumb">
                            <div style="flex: 1; min-width: 0;">
                                <span class="feed-cat">{{ $categories[$article->id % count($categories)] }}</span>
                                <h3 class="feed-title">
                                    <a href="{{ route('articles.show', $article) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <div class="muted" style="font-size: 0.8rem;">
                                    Oleh <strong>{{ $article->user->name }}</strong>
                                    &bull; {{ $article->created_at->translatedFormat('d M Y') }}
                                    &bull; {{ max(1, ceil(str_word_count($article->body) / 200)) }} mnt baca
                                </div>
                            </div>
                            <div style="display: flex; gap: 0.4rem; flex-shrink: 0;">
                                @if ($article->user_id === $user->id)
                                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline" style="padding: 0.4rem 0.75rem; font-size: 0.8rem;">
                                        Edit
                                    </a>
                                @endif
                                <a href="{{ route('articles.show', $article) }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">
                                    Baca
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 2rem 1rem;">
                    <p class="muted" style="margin-bottom: 1rem;">Belum ada artikel yang diterbitkan di portal.</p>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Berita Pertama</a>
                </div>
            @endif
        </section>

        {{-- Kolom Kanan: Kartu Pers Penulis & Akses Cepat --}}
        <aside>
            <div class="press-card">
                <div class="press-header">
                    <div class="press-avatar">{{ substr($user->name, 0, 1) }}</div>
                    <div>
                        <div style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--primary);">
                            Kartu Pers Redaksi
                        </div>
                        <div style="font-size: 1.1rem; font-weight: 800; color: var(--text-main);">
                            {{ $user->name }}
                        </div>
                        <div class="muted" style="font-size: 0.82rem;">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="press-meta-row">
                    <span class="muted">Peran Redaksi</span>
                    <strong style="color: var(--text-main);">Penulis & Editor</strong>
                </div>
                <div class="press-meta-row">
                    <span class="muted">Bergabung Sejak</span>
                    <strong style="color: var(--text-main);">{{ $user->created_at->translatedFormat('d M Y') }}</strong>
                </div>
                <div class="press-meta-row" style="padding-bottom: 0;">
                    <span class="muted">Artikel Diterbitkan</span>
                    <strong style="color: var(--primary);">{{ $myArticles }} Berita</strong>
                </div>
            </div>

            <div class="section-card">
                <div class="card-head">
                    <h2>Akses Cepat Redaksi</h2>
                </div>

                <a href="{{ route('articles.create') }}" class="quick-action-btn">
                    <span>+ Tulis Berita Baru</span>
                    <span>&rarr;</span>
                </a>
                <a href="{{ route('articles.index') }}" class="quick-action-btn">
                    <span>Kelola Semua Artikel</span>
                    <span>&rarr;</span>
                </a>
                <a href="{{ route('home') }}" class="quick-action-btn" style="margin-bottom: 0;">
                    <span>Pratinjau Halaman Utama</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </aside>
    </div>
@endsection