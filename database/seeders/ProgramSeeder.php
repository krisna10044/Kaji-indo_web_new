<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya insert jika tabel masih kosong
        if (DB::table('programs')->count() > 0) {
            $this->command->info('Tabel programs sudah ada datanya, skip.');
            return;
        }

        DB::table('programs')->insert([
            [
                'title'             => 'Pelatihan Manajemen UMKM Berbasis Halal',
                'slug'              => 'manajemen-umkm-halal',
                'short_description' => 'Tingkatkan kompetensi pengelolaan usaha kecil menengah dengan prinsip halal dan syariah.',
                'full_description'  => 'Program ini dirancang untuk pemilik UMKM yang ingin mengembangkan bisnis secara profesional sekaligus memastikan seluruh proses usaha sesuai standar halal dan nilai-nilai Islam.',
                'durasi'            => '3 Hari',
                'target'            => 'UMKM',
                'curriculum'        => json_encode([
                    ['session' => 'Hari 1', 'topic' => 'Pengenalan Konsep Halal dalam Bisnis dan Manfaatnya'],
                    ['session' => 'Hari 1', 'topic' => 'Manajemen Operasional & Supply Chain Halal'],
                    ['session' => 'Hari 2', 'topic' => 'Manajemen Keuangan Syariah untuk UMKM'],
                    ['session' => 'Hari 3', 'topic' => 'Pemasaran Syariah dan Branding Halal'],
                ]),
                'materials'         => json_encode([
                    ['type' => 'PDF', 'title' => 'Modul Lengkap Halal Awareness', 'description' => 'Panduan konsep halal lengkap'],
                    ['type' => 'Dokumen', 'title' => 'Template SOP Produksi Halal', 'description' => 'Standar Operasional Prosedur'],
                    ['type' => 'PDF', 'title' => 'Contoh Sertifikasi Halal UMKM', 'description' => 'Dokumen resmi BPJPH'],
                ]),
                'status'     => 'approved',
                'approved_at'=> now(),
                'created_at' => '2026-04-10 01:06:02',
                'updated_at' => '2026-04-10 01:06:02',
            ],
            [
                'title'             => 'Pelatihan Kewirausahaan Syariah',
                'slug'              => 'kewirausahaan-syariah',
                'short_description' => 'Bangun mindset wirausaha berbasis Al-Quran dan Sunnah.',
                'full_description'  => 'Pelatihan ini mengajarkan cara memulai dan mengembangkan bisnis dengan prinsip syariah, etika Islam, dan keberkahan usaha.',
                'durasi'            => '2 Hari',
                'target'            => 'Individu & UMKM',
                'curriculum'        => json_encode([
                    ['session' => 'Hari 1', 'topic' => 'Mindset Kewirausahaan Islami'],
                    ['session' => 'Hari 1', 'topic' => 'Akad-akad Syariah dalam Bisnis'],
                    ['session' => 'Hari 2', 'topic' => 'Business Plan Syariah'],
                    ['session' => 'Hari 2', 'topic' => 'Studi Kasus Bisnis Rasulullah SAW'],
                ]),
                'materials'         => json_encode([
                    ['type' => 'PDF', 'title' => 'Buku Panduan Kewirausahaan Syariah', 'description' => 'Materi utama'],
                    ['type' => 'Excel', 'title' => 'Contoh Business Plan Syariah', 'description' => 'Template siap pakai'],
                ]),
                'status'     => 'approved',
                'approved_at'=> now(),
                'created_at' => '2026-04-10 01:06:02',
                'updated_at' => '2026-04-10 01:06:02',
            ],
            [
                'title'             => 'Pelatihan Sertifikasi Halal untuk Produk UMKM',
                'slug'              => 'sertifikasi-halal-umkm',
                'short_description' => 'Persiapkan produk Anda untuk mendapatkan sertifikasi halal resmi BPJPH/MUI.',
                'full_description'  => 'Pelatihan praktis dan aplikatif untuk proses pengajuan serta pemenuhan persyaratan sertifikasi halal.',
                'durasi'            => '1 Hari',
                'target'            => 'UMKM',
                'curriculum'        => json_encode([
                    ['session' => 'Sesi 1', 'topic' => 'Prosedur Sertifikasi Halal BPJPH'],
                    ['session' => 'Sesi 2', 'topic' => 'Persyaratan Dokumen dan Proses Audit'],
                    ['session' => 'Sesi 3', 'topic' => 'Tips Lolos Sertifikasi Pertama Kali'],
                ]),
                'materials'         => json_encode([
                    ['type' => 'PDF', 'title' => 'Checklist Dokumen Sertifikasi Halal', 'description' => 'Checklist lengkap'],
                    ['type' => 'PDF', 'title' => 'Panduan Pengisian SIHALAL', 'description' => 'Tutorial sistem online'],
                ]),
                'status'     => 'approved',
                'approved_at'=> now(),
                'created_at' => '2026-04-10 01:06:02',
                'updated_at' => '2026-04-10 01:06:02',
            ],
            [
                'title'             => 'Pelatihan Digital Marketing Berbasis Islami',
                'slug'              => 'digital-marketing-islami',
                'short_description' => 'Strategi pemasaran digital yang etis dan sesuai syariat.',
                'full_description'  => 'Kuasai teknik pemasaran di era digital tanpa melanggar nilai-nilai Islam.',
                'durasi'            => '2 Hari',
                'target'            => 'UMKM & Korporat',
                'curriculum'        => json_encode([
                    ['session' => 'Hari 1', 'topic' => 'Etika Digital Marketing Islami'],
                    ['session' => 'Hari 1', 'topic' => 'Content Marketing yang Bernilai'],
                    ['session' => 'Hari 2', 'topic' => 'Iklan Berbayar & SEO Syariah'],
                ]),
                'materials'         => json_encode([
                    ['type' => 'PDF', 'title' => 'Template Konten Islami', 'description' => '50+ contoh caption'],
                    ['type' => 'PDF', 'title' => 'Panduan Meta Ads Halal', 'description' => 'Strategi iklan'],
                ]),
                'status'     => 'approved',
                'approved_at'=> now(),
                'created_at' => '2026-04-10 01:06:02',
                'updated_at' => '2026-04-10 01:06:02',
            ],
            [
                'title'             => 'Pelatihan Kepemimpinan Islami untuk Profesional',
                'slug'              => 'kepemimpinan-islami',
                'short_description' => 'Tingkatkan kemampuan leadership dengan nilai-nilai Al-Quran dan Sunnah.',
                'full_description'  => 'Program unggulan bagi profesional dan pemimpin perusahaan yang ingin memimpin dengan akhlak mulia.',
                'durasi'            => '3 Hari',
                'target'            => 'Profesional & Korporat',
                'curriculum'        => json_encode([
                    ['session' => 'Hari 1', 'topic' => 'Kepemimpinan Rasulullah SAW'],
                    ['session' => 'Hari 2', 'topic' => 'Manajemen Emosi & Akhlak'],
                    ['session' => 'Hari 3', 'topic' => 'Visionary Leadership Islami'],
                ]),
                'materials'         => json_encode([
                    ['type' => 'PDF', 'title' => 'Buku Kepemimpinan Islami', 'description' => 'Referensi utama'],
                    ['type' => 'PDF', 'title' => 'Worksheet Self-Assessment', 'description' => 'Evaluasi kepemimpinan'],
                ]),
                'status'     => 'approved',
                'approved_at'=> now(),
                'created_at' => '2026-04-10 01:06:02',
                'updated_at' => '2026-04-10 01:06:02',
            ],
        ]);
    }
}