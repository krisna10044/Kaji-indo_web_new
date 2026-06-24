<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasi';

    protected $fillable = [
      'judul', 'deskripsi', 'tanggal_kegiatan',
      'kategori', 'thumbnail', 'cover_video', 'foto', 'youtube_url', 'is_published', 'video_file',
  ];

    protected $casts = [
        'foto'             => 'array',
        'tanggal_kegiatan' => 'date',
        'is_published'     => 'boolean',
    ];

    // Ambil YouTube embed ID dari URL
    public function getYoutubeIdAttribute(): ?string
    {
        if (!$this->youtube_url) return null;
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([^\s&?\/]+)/', $this->youtube_url, $m);
        return $m[1] ?? null;
    }

    public function getThumbnailUrlAttribute(): string
{
    if ($this->thumbnail)    return asset('storage/' . $this->thumbnail);
    if ($this->cover_video)  return asset('storage/' . $this->cover_video);
    if ($this->youtube_id)   return "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg";
    return asset('images/placeholder.png');
}
}