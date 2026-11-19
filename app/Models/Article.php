<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'body', 'image'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            if ($this->image) {
                return $this->image;
            }

            $newsPhotos = [
                'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1000&q=80', // Media & Koran
                'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1000&q=80', // Ekonomi & Gedung Bisnis
                'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1000&q=80', // Teknologi & Digital
                'https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&w=1000&q=80', // Liputan & Jurnalistik
                'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=1000&q=80', // Keuangan & Pasar
                'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?auto=format&fit=crop&w=1000&q=80', // Ruang Redaksi
            ];

            return $newsPhotos[$this->id % count($newsPhotos)];
        });
    }

    protected function fallbackImage(): Attribute
    {
        return Attribute::get(function () {
            $shortTitle = htmlspecialchars(mb_strimwidth($this->title, 0, 32, '...'), ENT_XML1, 'UTF-8');
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="800" height="450">'
                 . '<defs><linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%">'
                 . '<stop offset="0%" stop-color="#0f172a"/><stop offset="100%" stop-color="#2563eb"/>'
                 . '</linearGradient></defs>'
                 . '<rect width="100%" height="100%" fill="url(#g)"/>'
                 . '<text x="48" y="80" fill="#93c5fd" font-family="sans-serif" font-size="16" font-weight="bold">WARTAKINI NEWS</text>'
                 . '<text x="48" y="245" fill="#ffffff" font-family="sans-serif" font-size="30" font-weight="bold">' . $shortTitle . '</text>'
                 . '</svg>';

            return 'data:image/svg+xml;base64,' . base64_encode($svg);
        });
    }
}