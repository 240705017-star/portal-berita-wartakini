@extends('layouts.app')

@section('title', 'Edit Berita')

@push('styles')
<style>
    .editor-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 58%, #172554 100%);
        color: #ffffff;
        border-radius: 18px;
        padding: 1.85rem 2.25rem;
        margin-bottom: 1.75rem;
        box-shadow: var(--shadow-md);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .editor-hero h1 {
        margin: 0.35rem 0 0.25rem 0;
        font-size: 1.65rem;
        font-weight: 800;
        letter-spacing: -0.025em;
    }
    .editor-grid {
        display: grid;
        grid-template-columns: 1.65fr 1fr;
        gap: 1.5rem;
        align-items: start;
    }
    .preview-box {
        width: 100%;
        aspect-ratio: 16 / 9;
        border-radius: 12px;
        border: 1px solid var(--border);
        background: #f8fafc;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }
    .preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    @media (max-width: 860px) {
        .editor-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <section class="editor-hero">
        <div>
            <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #93c5fd;">
                Meja Redaksi &bull; Penyuntingan
            </span>
            <h1>Edit Berita</h1>
            <p style="margin: 0; color: #cbd5e1; font-size: 0.92rem;">
                Perbarui isi liputan atau ganti gambar sampul berita yang sudah diterbitkan.
            </p>
        </div>
        <div style="display: flex; gap: 0.65rem;">
            <a href="{{ route('articles.show', $article) }}" class="btn" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                Lihat Hasil
            </a>
            <a href="{{ route('articles.index') }}" class="btn" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                &larr; Arsip
            </a>
        </div>
    </section>

    @if ($errors->any())
        <div class="error" style="margin-bottom: 1.5rem;">
            <strong>Periksa kembali isian formulir:</strong>
            <ul style="margin: 0.4rem 0 0 0; padding-left: 1.2rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="POST" class="editor-grid">
        @csrf
        @method('PUT')

        {{-- Kolom Kiri: Form Utama --}}
        <section class="card" style="padding: 1.85rem;">
            <label for="title" style="margin-top: 0;">Judul Berita</label>
            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required>

            <label for="body">Isi Liputan Berita</label>
            <textarea id="body" name="body" rows="13" required>{{ old('body', $article->body) }}</textarea>

            <div style="display: flex; gap: 0.75rem; margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid var(--border);">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('articles.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </section>

        {{-- Kolom Kanan: Sampul & Info Terbit --}}
        <aside>
            <section class="card" style="padding: 1.5rem; margin-bottom: 1.25rem;">
                <h3 style="margin: 0 0 0.85rem 0; font-size: 1rem; font-weight: 800;">Foto Sampul Berita</h3>

                <div class="preview-box">
                    <img id="coverPreview"
                         src="{{ old('image', $article->image_url) }}"
                         onerror="this.onerror=null;this.src='{{ $article->fallback_image }}';"
                         alt="Pratinjau Sampul">
                </div>

                <label for="image" style="margin-top: 0.5rem;">Tautan URL Gambar (Opsional)</label>
                <input type="url" id="image" name="image" value="{{ old('image', $article->image) }}" placeholder="https://images.unsplash.com/..." oninput="updatePreview(this.value)">
            </section>

            <section class="card" style="padding: 1.35rem; background: #f8fafc;">
                <h4 style="margin: 0 0 0.65rem 0; font-size: 0.9rem; font-weight: 700;">Informasi Publikasi</h4>
                <div style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.7;">
                    <div><strong>Penulis:</strong> {{ $article->user->name }}</div>
                    <div><strong>Terbit Pertama:</strong> {{ $article->created_at->translatedFormat('d M Y, H:i') }}</div>
                    <div><strong>Pembaruan Terakhir:</strong> {{ $article->updated_at->translatedFormat('d M Y, H:i') }}</div>
                </div>
            </section>
        </aside>
    </form>

    <script>
        function updatePreview(url) {
            const img = document.getElementById('coverPreview');
            const fallback = @json($article->fallback_image);
            img.src = url.trim() !== '' ? url : fallback;
        }
    </script>
@endsection