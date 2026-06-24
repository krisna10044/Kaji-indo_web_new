<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;


class Program extends Model
{
    use SoftDeletes;
    protected $table = 'programs';

    protected $fillable = [
        'trainer_id',
        'judul',
        'slug',
        'tipe',              // kurikulum / materi
        'deskripsi',         // ringkasan singkat (tampil di card listing)
        'deskripsi_panjang', // detail lengkap (tampil di halaman detail)
        'konten_kurikulum',  // isi rich text kurikulum (Quill → HTML)
        'konten_materi',     // isi rich text materi (Quill → HTML)
        'target',            // target peserta
        'metode',            // online / offline / hybrid
        'tingkat',           // pemula / menengah / lanjut
        'bahasa',
        'tanggal',
        'gambar',
        'status',            // pending / approved / rejected
        'catatan_admin',
        'approved_at',
        'approved_by',
        'rejected_at',
        'rejected_by',
        'jumlah_materi', 'total_jam', 'jumlah_sesi', 'sertifikat', 'urutan', 'kurikulum_id', 'phone',
        'absensi_aktif',
        'absensi_mulai',
        'absensi_selesai',
        'absensi_url',
        'alamat',
        'biaya',
         'nominal_biaya',
        'materi_type',
    'materi_youtube',
    'materi_pdf',
    'akses_mulai',
    'akses_selesai',
    'program_mulai',
'program_selesai',
    ];

    protected $casts = [
        'tanggal'     => 'date',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'absensi_aktif'   => 'boolean',
        'absensi_mulai'   => 'datetime',
        'absensi_selesai' => 'datetime',
        'program_mulai'    => 'date',   // ← tambah
        'program_selesai'  => 'date',   // ← tambah
        'trainer_id'  => 'integer',
    ];

    // ── Auto-generate slug dari judul ─────────────────────────────────────
    protected static function booted(): void
    {
        static::creating(function ($program) {
            $program->slug = self::generateUniqueSlug($program->judul);
        });

        static::updating(function ($program) {
            if ($program->isDirty('judul')) {
                $program->slug = self::generateUniqueSlug($program->judul, $program->id);
            }
        });
    }

    private static function generateUniqueSlug(string $judul, ?int $exceptId = null): string
    {
        $slug  = Str::slug($judul);
        $base  = $slug;
        $count = 1;

        while (
            static::where('slug', $slug)
                  ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
                  ->exists()
        ) {
            $slug = "{$base}-{$count}";
            $count++;
        }

        return $slug;
    }

    // ── Relasi ────────────────────────────────────────────────────────────
    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
    

    public function trainerDetail()
{
    return $this->hasOneThrough(
        Trainer::class,  // pastikan: use App\Models\Trainer; di atas
        User::class,
        'id',        // FK di users → dari programs.trainer_id
        'user_id',   // FK di trainer → mengarah ke users.id
        'trainer_id', // local key di programs
        'id'          // local key di users
    );
}

    // ── Scopes (untuk query yang sering dipakai) ──────────────────────────
    // Contoh: Program::published()->get()
    public function scopePublished($query)
    {
        return $query->where('status', 'approved');
    }

    // Contoh: Program::kurikulum()->get()
    public function scopeKurikulum($query)
    {
        return $query->where('tipe', 'kurikulum');
    }

    // Contoh: Program::materi()->get()
    public function scopeMateri($query)
    {
        return $query->where('tipe', 'materi');
    }

    // ── Helper ────────────────────────────────────────────────────────────
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'approved' => '<span class="badge bg-success">Disetujui</span>',
            'rejected' => '<span class="badge bg-danger">Ditolak</span>',
            default    => '<span class="badge bg-warning text-dark">Menunggu</span>',
        };
    }

    public function getTipeLabelAttribute(): string
    {
        return match ($this->tipe) {
            'kurikulum' => 'Kurikulum',
            'materi'    => 'Materi',
            default     => ucfirst($this->tipe),
        };
    }

    public function getGambarUrlAttribute(): string
    {
        return $this->gambar
            ? asset('storage/' . $this->gambar)
            : asset('images/default-program.jpg');
    }

    // Relasi ke modul-modul milik kurikulum ini
public function moduls()
{
    return $this->hasMany(Program::class, 'kurikulum_id')->where('tipe', 'modul')->orderBy('urutan');
}

}