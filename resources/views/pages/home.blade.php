@extends('layouts.app')

@section('title', 'Berita Terkini & Terpercaya')

@push('styles')
<style>
    /* Top Editorial Bar */
    .editorial-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
        padding-bottom: 1.25rem;
        margin-bottom: 1.75rem;
        border-bottom: 1px solid var(--border);
    }
    .live-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: var(--primary-soft);
        color: var(--primary);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        padding: 0.35rem 0.75rem;
        border-radius: 999px;
    }
    .live-dot {
        width: 7px;
        height: 7px;
        background: var(--primary);
        border-radius: 50%;
    }
    .editorial-date {
        font-size: 0.875rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    /* Featured Hero Story (Artikel Paling Baru) */
    .hero-story {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        margin-bottom: 2.75rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .hero-story:hover {
        box-shadow: 0 18px 35px -10px rgba(15, 23, 42, 0.12);
    }
    .hero-image-wrap {
        position: relative;
        min-height: 340px;
        background: var(--dark);
        overflow: hidden;
    }
    .hero-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.45s ease;
    }
    .hero-story:hover .hero-image-wrap img {
        transform: scale(1.03);
    }
    .hero-body {
        padding: 2.25rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .category-tag {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--primary);
        margin-bottom: 0.65rem;
    }
    .hero-title {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.28;
        letter-spacing: -0.025em;
        margin: 0 0 0.85rem 0;
    }
    .hero-title a {
        color: var(--text-main);
        text-decoration: none;
        transition: color 0.15s;
    }
    .hero-title a:hover { color: var(--primary); }
    .hero-excerpt {
        color: var(--text-secondary);
        font-size: 0.975rem;
        line-height: 1.65;
        margin: 0 0 1.5rem 0;
    }
    .meta-author {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid #f1f5f9;
    }

    /* Section Header */
    .section-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 1.35rem;
        gap: 1rem;
    }
    .section-title {
        font-size: 1.35rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .section-title::before {
        content: '';
        width: 5px;
        height: 22px;
        background: var(--primary);
        border-radius: 4px;
    }

    /* News Grid Cards */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    .news-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .news-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: #cbd5e1;
    }
    .news-thumb {
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        background: var(--dark-soft);
        position: relative;
    }
    .news-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .news-card:hover .news-thumb img {
        transform: scale(1.04);
    }
    .news-content {
        padding: 1.25rem 1.35rem 1.35rem 1.35rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .news-title {
        font-size: 1.1rem;
        font-weight: 700;
        line-height: 1.4;
        letter-spacing: -0.015em;
        margin: 0 0 0.55rem 0;
    }
    .news-title a {
        color: var(--text-main);
        text-decoration: none;
        transition: color 0.15s;
    }
    .news-title a:hover { color: var(--primary); }
    .news-excerpt {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0 0 1.25rem 0;
        flex: 1;
    }
    .read-more {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
    }
    .read-more:hover { text-decoration: underline; }

    /* CTA Banner untuk Penulis */
    .writer-cta {
        margin-top: 3rem;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 65%, #172554 100%);
        color: #ffffff;
        border-radius: 16px;
        padding: 2rem 2.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    @media (max-width: 920px) {
        .hero-story { grid-template-columns: 1fr; }
        .hero-image-wrap { min-height: 240px; }
        .news-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 620px) {
        .news-grid { grid-template-columns: 1fr; }
        .hero-body { padding: 1.5rem; }
        .hero-title { font-size: 1.4rem; }
    }
</style>
@endpush

@section('content')
    @php
        $categories = ['Nasional', 'Ekonomi & Bisnis', 'Teknologi', 'Inovasi', 'Sorotan', 'Editorial'];
        $featured = $articles->first();
        $otherArticles = $articles->skip(1);
    @endphp

    <div class="editorial-bar">
        <div class="live-badge">
            <span class="live-dot"></span>
            <span>Edisi Hari Ini</span>
        </div>
        <div class="editorial-date">
            {{ now()->translatedFormat('l, d F Y') }} &bull; Portal Berita WartaKini
        </div>
    </div>

    @if ($featured)
        {{-- Sorotan Berita Utama (#1 Terbaru) --}}
        <article class="hero-story">
            <a href="{{ route('articles.show', $featured) }}" class="hero-image-wrap">
                <img src="{{ $featured->image_url }}"
                     onerror="this.onerror=null;this.src='{{ $featured->fallback_image }}';"
                     alt="{{ $featured->title }}">
            </a>
            <div class="hero-body">
                <span class="category-tag">Sorotan Utama &bull; {{ $categories[$featured->id % count($categories)] }}</span>
                <h1 class="hero-title">
                    <a href="{{ route('articles.show', $featured) }}">{{ $featured->title }}</a>
                </h1>
                <p class="hero-excerpt">
                    {{ \Illuminate\Support\Str::limit($featured->body, 190) }}
                </p>
                <div style="margin-bottom: 1.25rem;">
                    <a href="{{ route('articles.show', $featured) }}" class="btn btn-primary">
                        Baca Liputan Lengkap &rarr;
                    </a>
                </div>
                <div class="meta-author">
                    <span class="avatar-circle">{{ substr($featured->user->name, 0, 1) }}</span>
                    <div>
                        <strong style="color: var(--text-main);">{{ $featured->user->name }}</strong>
                        &bull; {{ $featured->created_at->format('d M Y') }}
                        &bull; {{ max(1, ceil(str_word_count($featured->body) / 200)) }} mnt baca
                    </div>
                </div>
            </div>
        </article>

        {{-- Daftar Berita Terbaru Lainnya --}}
        @if ($otherArticles->isNotEmpty())
            <div class="section-head">
                <h2 class="section-title">Berita Terbaru</h2>
                @auth
                    <a href="{{ route('articles.index') }}" class="read-more">Lihat semua arsip &rarr;</a>
                @endauth
            </div>

            <div class="news-grid">
                @foreach ($otherArticles as $article)
                    <article class="news-card">
                        <a href="{{ route('articles.show', $article) }}" class="news-thumb">
                            <img src="{{ $article->image_url }}"
                                 onerror="this.onerror=null;this.src='{{ $article->fallback_image }}';"
                                 alt="{{ $article->title }}">
                        </a>
                        <div class="news-content">
                            <span class="category-tag">{{ $categories[$article->id % count($categories)] }}</span>
                            <h3 class="news-title">
                                <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                            </h3>
                            <p class="news-excerpt">
                                {{ \Illuminate\Support\Str::limit($article->body, 115) }}
                            </p>
                            <div class="meta-author" style="padding-top: 0.85rem;">
                                <span class="avatar-circle" style="width: 24px; height: 24px; font-size: 0.7rem;">
                                    {{ substr($article->user->name, 0, 1) }}
                                </span>
                                <div style="flex: 1; font-size: 0.8rem;">
                                    <strong style="color: var(--text-secondary);">{{ $article->user->name }}</strong>
                                    <span style="display: block;">{{ $article->created_at->format('d M Y') }}</span>
                                </div>
                                <a href="{{ route('articles.show', $article) }}" class="read-more">Baca &rarr;</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    @else
        <div class="card" style="text-align: center; padding: 3.5rem 1.5rem;">
            <h2 style="margin-top: 0;">Belum Ada Berita Diterbitkan</h2>
            <p class="muted" style="max-width: 460px; margin: 0 auto 1.5rem auto;">
                Ruang redaksi masih kosong. Jadilah penulis pertama yang mempublikasikan berita hari ini.
            </p>
            @auth
                <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Berita Pertama</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk untuk Menulis</a>
            @endauth
        </div>
    @endif

    {{-- Banner Ajakan Kontributor --}}
    <section class="writer-cta">
        <div>
            <h3 style="margin: 0 0 0.35rem 0; font-size: 1.25rem; font-weight: 800;">
                @auth
                    Halo, {{ auth()->user()->name }}! Punya informasi menarik hari ini?
                @else
                    Punya Liputan atau Opini Menarik untuk Dibagikan?
                @endauth
            </h3>
            <p style="margin: 0; color: #cbd5e1; font-size: 0.925rem;">
                @auth
                    Publikasikan tulisan terbaru Anda langsung ke halaman utama WartaKini.
                @else
                    Bergabung bersama tim kontributor WartaKini dan kelola artikel Anda sendiri.
                @endauth
            </p>
        </div>
        <div>
            @auth
                <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Buat Artikel Baru</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar Sekarang &rarr;</a>
            @endauth
        </div>
    </section>
@endsection