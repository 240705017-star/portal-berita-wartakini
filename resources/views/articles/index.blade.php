@extends('layouts.app')

@section('title', 'Kelola Artikel')

@push('styles')
<style>
    /* Filter & Search Control Bar */
    .control-bar {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .filter-tabs {
        display: inline-flex;
        background: #f1f5f9;
        padding: 0.3rem;
        border-radius: 11px;
        gap: 0.25rem;
    }
    .filter-tab {
        border: none;
        background: transparent;
        padding: 0.48rem 1rem;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.15s;
    }
    .filter-tab.active {
        background: #ffffff;
        color: var(--text-main);
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);
    }
    .search-box {
        position: relative;
        min-width: 280px;
        flex: 1;
        max-width: 360px;
    }
    .search-box svg {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        pointer-events: none;
    }
    .search-box input {
        margin: 0 !important;
        padding-left: 2.5rem !important;
        background: #f8fafc !important;
        border-radius: 10px !important;
        font-size: 0.88rem !important;
    }

    /* Editorial Article Cards (Menggantikan Tabel Kaku) */
    .article-stream {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .editorial-item {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.15rem;
        display: grid;
        grid-template-columns: 190px 1fr auto;
        gap: 1.35rem;
        align-items: center;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s ease;
    }
    .editorial-item:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
        box-shadow: var(--shadow-md);
    }
    .editorial-cover {
        width: 190px;
        height: 122px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        background: var(--dark);
        flex-shrink: 0;
    }
    .editorial-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }
    .editorial-item:hover .editorial-cover img {
        transform: scale(1.04);
    }
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 0.22rem 0.6rem;
        border-radius: 999px;
    }
    .status-live {
        background: #ecfdf5;
        color: #059669;
    }
    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #10b981;
    }
    .cat-tag {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--primary);
    }
    .mine-tag {
        font-size: 0.7rem;
        font-weight: 700;
        background: var(--primary-soft);
        color: var(--primary);
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
    }
    .editorial-title {
        margin: 0.35rem 0 0.4rem 0;
        font-size: 1.12rem;
        font-weight: 800;
        line-height: 1.35;
        letter-spacing: -0.015em;
    }
    .editorial-title a {
        color: var(--text-main);
        text-decoration: none;
        transition: color 0.15s;
    }
    .editorial-title a:hover { color: var(--primary); }
    .editorial-desc {
        margin: 0 0 0.75rem 0;
        font-size: 0.88rem;
        color: var(--text-muted);
        line-height: 1.55;
    }
    .editorial-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    .editorial-actions {
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
        min-width: 118px;
        padding-left: 1.1rem;
        border-left: 1px solid #f1f5f9;
    }
    .editorial-actions .btn {
        width: 100%;
        justify-content: center;
        padding: 0.45rem 0.85rem;
        font-size: 0.82rem;
    }

    /* Pagination */
    .pagination-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1.75rem;
        padding: 1rem 1.35rem;
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 14px;
    }
    .pagination {
        display: flex;
        gap: 0.35rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .pagination li a, .pagination li span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 0.7rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: #ffffff;
        text-decoration: none;
        color: var(--text-secondary);
        font-size: 0.85rem;
        font-weight: 600;
    }
    .pagination li.active span {
        background: var(--primary);
        color: #ffffff;
        border-color: var(--primary);
    }

    @media (max-width: 820px) {
        .editorial-item {
            grid-template-columns: 1fr;
        }
        .editorial-cover {
            width: 100%;
            height: 190px;
        }
        .editorial-actions {
            flex-direction: row;
            border-left: none;
            border-top: 1px solid #f1f5f9;
            padding-left: 0;
            padding-top: 0.85rem;
        }
    }
</style>
@endpush

@section('content')
    @php
        $categories = ['Nasional', 'Ekonomi & Bisnis', 'Teknologi', 'Inovasi', 'Sorotan', 'Editorial'];
        $myCount = $articles->where('user_id', auth()->id())->count();
    @endphp

    {{-- Executive Studio Header --}}
    <section class="page-hero">
        <div>
            <div class="page-hero-badge">
                <span>Editorial Studio &bull; {{ $articles->total() }} Publikasi Aktif</span>
            </div>
            <h1>Manajemen Publikasi Berita</h1>
            <p>
                Pusat kendali seluruh liputan redaksi. Sunting naskah, pantau status tayang, dan terbitkan berita terbaru ke portal.
            </p>
        </div>

        <div class="page-hero-actions">
            <a href="{{ route('dashboard') }}" class="btn btn-glass">&larr; Dasbor</a>
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Berita Baru</a>
        </div>
    </section>

    @if (session('success'))
        <div class="flash" style="margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Bar Filter & Pencarian Instan --}}
    <div class="control-bar">
        <div class="filter-tabs" role="tablist">
            <button type="button" class="filter-tab active" onclick="filterArticles('all', this)">
                Semua Berita ({{ $articles->count() }})
            </button>
            <button type="button" class="filter-tab" onclick="filterArticles('mine', this)">
                Artikel Saya ({{ $myCount }})
            </button>
        </div>

        <div class="search-box">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
            </svg>
            <input type="text" id="articleSearch" placeholder="Cari judul atau isi berita..." oninput="searchArticles(this.value)">
        </div>
    </div>

    {{-- Daftar Kartu Editorial --}}
    @if ($articles->isNotEmpty())
        <div class="article-stream" id="articleStream">
            @foreach ($articles as $article)
                @php
                    $isMine = $article->user_id === auth()->id();
                @endphp
                <article class="editorial-item"
                         data-owner="{{ $isMine ? 'mine' : 'other' }}"
                         data-search="{{ strtolower($article->title . ' ' . $article->user->name) }}">
                    <a href="{{ route('articles.show', $article) }}" class="editorial-cover">
                        <img src="{{ $article->image_url }}"
                             onerror="this.onerror=null;this.src='{{ $article->fallback_image }}';"
                             alt="{{ $article->title }}">
                    </a>

                    <div style="min-width: 0;">
                        <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 0.55rem;">
                            <span class="cat-tag">{{ $categories[$article->id % count($categories)] }}</span>
                            <span class="status-pill status-live">
                                <span class="status-dot"></span> Tayang
                            </span>
                            @if ($isMine)
                                <span class="mine-tag">Karya Anda</span>
                            @endif
                        </div>

                        <h2 class="editorial-title">
                            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        </h2>

                        <p class="editorial-desc">
                            {{ \Illuminate\Support\Str::limit($article->body, 130) }}
                        </p>

                        <div class="editorial-meta">
                            <span style="display: inline-flex; align-items: center; gap: 0.4rem;">
                                <span class="avatar-circle" style="width: 22px; height: 22px; font-size: 0.68rem;">
                                    {{ substr($article->user->name, 0, 1) }}
                                </span>
                                <strong style="color: var(--text-secondary);">{{ $article->user->name }}</strong>
                            </span>
                            <span>&bull;</span>
                            <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                            <span>&bull;</span>
                            <span>{{ max(1, ceil(str_word_count($article->body) / 200)) }} menit baca</span>
                        </div>
                    </div>

                    <div class="editorial-actions">
                        <a href="{{ route('articles.show', $article) }}" class="btn btn-outline">
                            Baca Liputan
                        </a>
                        @if ($isMine)
                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline" style="border-color: #bfdbfe; color: var(--primary); background: var(--primary-soft);">
                                Sunting
                            </a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus berita ini secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-ghost" style="width: 100%;">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        <div id="emptyFilterState" class="card" style="display: none; text-align: center; padding: 3rem 1.5rem;">
            <h3 style="margin: 0 0 0.4rem 0;">Tidak Ada Artikel yang Cocok</h3>
            <p class="muted" style="margin: 0 0 1.25rem 0;">Coba ubah kata kunci pencarian atau pilih tab "Semua Berita".</p>
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Berita Baru</a>
        </div>

        @if ($articles->hasPages())
            <div class="pagination-bar">
                <div class="muted" style="font-size: 0.84rem;">
                    Menampilkan {{ $articles->firstItem() }}–{{ $articles->lastItem() }} dari {{ $articles->total() }} publikasi
                </div>
                {{ $articles->links('pagination::default') }}
            </div>
        @endif
    @else
        <div class="card" style="text-align: center; padding: 3.5rem 1.5rem;">
            <h3 style="margin: 0 0 0.4rem 0;">Ruang Arsip Masih Kosong</h3>
            <p class="muted" style="margin: 0 0 1.25rem 0;">Mulai terbitkan liputan pertama Anda ke portal berita WartaKini.</p>
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Berita Pertama</a>
        </div>
    @endif

    <script>
        let currentTab = 'all';

        function applyFilters() {
            const query = document.getElementById('articleSearch').value.toLowerCase().trim();
            const items = document.querySelectorAll('.editorial-item');
            let visibleCount = 0;

            items.forEach(item => {
                const matchTab = currentTab === 'all' || item.dataset.owner === 'mine';
                const matchSearch = query === '' || item.dataset.search.includes(query);

                if (matchTab && matchSearch) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('emptyFilterState');
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        function filterArticles(tab, btn) {
            currentTab = tab;
            document.querySelectorAll('.filter-tab').forEach(el => el.classList.remove('active'));
            btn.classList.add('active');
            applyFilters();
        }

        function searchArticles() {
            applyFilters();
        }
    </script>
@endsection