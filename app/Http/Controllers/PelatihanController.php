<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Trainer;
use App\Models\UlasanPembimbing;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use App\Models\Mentor;
use App\Models\Program;

class PelatihanController extends Controller
{
    // =========================================================
    // DATA STATIS KURIKULUM
    // =========================================================
    private function kurikulumData(): array
    {
        return [
            [
                'id'          => 1,
                'judul'       => 'Memulai & Mengelola Usaha',
                'deskripsi'   => 'Pelajari cara mendirikan usaha dari nol, menentukan model bisnis yang tepat, dan mengelola operasional UMKM secara efektif dan efisien.',
                'ikon'        => '🏪',
                'warna'       => 'linear-gradient(135deg, #c8e6b0, #7dcf8a)',
                'metode'      => 'Online & Offline',
                'tingkat'     => 'Pemula — Menengah',
                'durasi'      => '12 Jam (6 Sesi)',
                'bahasa'      => 'Bahasa Indonesia',
                'kuota'       => '30 Orang/Batch',
                'total_modul' => 6,
                'modul'       => [
                    ['judul' => 'Pengenalan Dunia UMKM',        'isi' => 'Memahami ekosistem UMKM di Indonesia, peluang, dan tantangan yang dihadapi pelaku usaha kecil.'],
                    ['judul' => 'Menentukan Model Bisnis',       'isi' => 'Cara memilih model bisnis yang tepat sesuai potensi daerah, target pasar, dan sumber daya yang dimiliki.'],
                    ['judul' => 'Legalitas & Perizinan Usaha',   'isi' => 'Panduan mengurus NIB, sertifikat halal, dan izin usaha lainnya dengan mudah dan terjangkau.'],
                    ['judul' => 'Manajemen Operasional Harian',  'isi' => 'Teknik mengelola stok, produksi, dan distribusi agar operasional usaha berjalan efisien setiap hari.'],
                    ['judul' => 'Membangun Tim Usaha',           'isi' => 'Cara merekrut, melatih, dan memotivasi karyawan pertama untuk membantu mengembangkan usaha Anda.'],
                    ['judul' => 'Evaluasi & Rencana Berkembang', 'isi' => 'Mengukur kinerja usaha dan menyusun rencana pengembangan jangka pendek dan jangka panjang.'],
                ],
                'benefit'     => [
                    'Pemahaman mendalam tentang ekosistem UMKM',
                    'Template rencana bisnis siap pakai',
                    'Panduan legalitas & perizinan usaha',
                    'Akses grup komunitas UMKM KAJI',
                    'Sertifikat kompetensi resmi',
                    'Rekaman materi untuk diakses ulang',
                ],
            ],
            [
                'id'          => 2,
                'judul'       => 'Keuangan & Pembukuan Usaha',
                'deskripsi'   => 'Kuasai dasar-dasar pencatatan keuangan, manajemen arus kas, dan perencanaan anggaran agar usaha Anda tetap sehat secara finansial.',
                'ikon'        => '💰',
                'warna'       => 'linear-gradient(135deg, #b0d9f5, #6bb8e8)',
                'metode'      => 'Online & Offline',
                'tingkat'     => 'Pemula — Menengah',
                'durasi'      => '10 Jam (5 Sesi)',
                'bahasa'      => 'Bahasa Indonesia',
                'kuota'       => '30 Orang/Batch',
                'total_modul' => 5,
                'modul'       => [
                    ['judul' => 'Dasar Pencatatan Keuangan',  'isi' => 'Memahami konsep dasar laporan keuangan sederhana yang wajib dimiliki setiap pelaku UMKM.'],
                    ['judul' => 'Manajemen Arus Kas',         'isi' => 'Cara mencatat pemasukan dan pengeluaran harian agar keuangan usaha tidak tercampur dengan keuangan pribadi.'],
                    ['judul' => 'Perencanaan Anggaran Usaha', 'isi' => 'Teknik menyusun anggaran bulanan dan tahunan untuk menjaga stabilitas keuangan usaha.'],
                    ['judul' => 'Analisis Laba & Rugi',       'isi' => 'Cara menghitung HPP, menentukan harga jual yang tepat, dan menganalisis profitabilitas produk.'],
                    ['judul' => 'Persiapan Laporan Keuangan', 'isi' => 'Menyusun laporan keuangan sederhana sebagai syarat pengajuan modal ke bank atau lembaga keuangan.'],
                ],
                'benefit'     => [
                    'Kemampuan membuat laporan keuangan sendiri',
                    'Template pembukuan usaha Excel/Google Sheets',
                    'Cara menghitung HPP dan harga jual',
                    'Akses grup komunitas UMKM KAJI',
                    'Sertifikat kompetensi resmi',
                    'Rekaman materi untuk diakses ulang',
                ],
            ],
            [
                'id'          => 3,
                'judul'       => 'Pemasaran Digital & Branding',
                'deskripsi'   => 'Bangun identitas merek yang kuat dan pelajari strategi pemasaran digital melalui media sosial, marketplace, dan platform online lainnya.',
                'ikon'        => '📱',
                'warna'       => 'linear-gradient(135deg, #fde8b0, #f7c36a)',
                'metode'      => 'Online & Offline',
                'tingkat'     => 'Pemula — Menengah',
                'durasi'      => '14 Jam (7 Sesi)',
                'bahasa'      => 'Bahasa Indonesia',
                'kuota'       => '30 Orang/Batch',
                'total_modul' => 7,
                'modul'       => [
                    ['judul' => 'Dasar Branding UMKM',         'isi' => 'Membangun identitas merek yang konsisten mulai dari nama, logo, warna, hingga tone komunikasi usaha.'],
                    ['judul' => 'Strategi Konten Media Sosial', 'isi' => 'Cara membuat konten menarik di Instagram, TikTok, dan Facebook yang relevan untuk target pasar UMKM.'],
                    ['judul' => 'Foto & Video Produk Sendiri',  'isi' => 'Teknik membuat foto dan video produk berkualitas hanya menggunakan smartphone tanpa alat mahal.'],
                    ['judul' => 'Berjualan di Marketplace',     'isi' => 'Panduan membuka toko, mengelola produk, dan mengoptimalkan penjualan di Tokopedia, Shopee, dan TikTok Shop.'],
                    ['judul' => 'Iklan Digital Berbayar',       'isi' => 'Cara memasang dan mengoptimalkan iklan di Meta Ads dan TikTok Ads dengan anggaran minimal.'],
                    ['judul' => 'Mengelola Ulasan & Reputasi',  'isi' => 'Strategi merespons ulasan pelanggan dan membangun reputasi positif usaha secara online.'],
                    ['judul' => 'Mengukur Performa Pemasaran',  'isi' => 'Cara membaca data analitik media sosial dan marketplace untuk mengambil keputusan pemasaran yang tepat.'],
                ],
                'benefit'     => [
                    'Kemampuan membuat konten produk sendiri',
                    'Template kalender konten bulanan',
                    'Panduan setup toko di marketplace',
                    'Akses grup komunitas UMKM KAJI',
                    'Sertifikat kompetensi resmi',
                    'Rekaman materi untuk diakses ulang',
                ],
            ],
            [
                'id'          => 4,
                'judul'       => 'Pengembangan & Scaling Usaha',
                'deskripsi'   => 'Pelajari strategi memperluas jangkauan pasar, mengembangkan produk, serta mengakses pembiayaan untuk membawa usaha ke level berikutnya.',
                'ikon'        => '🚀',
                'warna'       => 'linear-gradient(135deg, #f5c0d0, #e87fa0)',
                'metode'      => 'Online & Offline',
                'tingkat'     => 'Menengah — Lanjutan',
                'durasi'      => '16 Jam (8 Sesi)',
                'bahasa'      => 'Bahasa Indonesia',
                'kuota'       => '25 Orang/Batch',
                'total_modul' => 8,
                'modul'       => [
                    ['judul' => 'Evaluasi Kesiapan Scaling',    'isi' => 'Menilai kondisi usaha saat ini dan menentukan kapan waktu yang tepat untuk mulai mengembangkan skala bisnis.'],
                    ['judul' => 'Inovasi & Pengembangan Produk', 'isi' => 'Cara mengembangkan lini produk baru berdasarkan riset pasar dan kebutuhan pelanggan yang terus berubah.'],
                    ['judul' => 'Ekspansi Pasar Baru',           'isi' => 'Strategi menjangkau pasar baru di luar daerah, baik melalui jalur online maupun distribusi offline.'],
                    ['judul' => 'Akses Permodalan & KUR',        'isi' => 'Panduan lengkap mengajukan KUR, pinjaman modal usaha, dan program hibah pemerintah untuk UMKM.'],
                    ['judul' => 'Membangun Sistem Bisnis',       'isi' => 'Cara mendokumentasikan SOP usaha agar bisnis bisa berjalan tanpa harus selalu diawasi pemilik.'],
                    ['judul' => 'Kemitraan & Kolaborasi',        'isi' => 'Membangun jaringan mitra, reseller, dan agen yang memperkuat distribusi dan penjualan produk Anda.'],
                    ['judul' => 'Digitalisasi Proses Bisnis',    'isi' => 'Memanfaatkan teknologi dan aplikasi digital untuk mengotomasi proses bisnis dan meningkatkan efisiensi.'],
                    ['judul' => 'Rencana Bisnis Jangka Panjang', 'isi' => 'Menyusun business plan profesional untuk keperluan presentasi ke investor atau lembaga pembiayaan.'],
                ],
                'benefit'     => [
                    'Peta jalan pengembangan usaha yang terstruktur',
                    'Template business plan profesional',
                    'Panduan pengajuan KUR & permodalan',
                    'Akses grup komunitas UMKM KAJI',
                    'Sertifikat kompetensi resmi',
                    'Rekaman materi untuk diakses ulang',
                ],
            ],
        ];
    }

    // =========================================================
    // DATA STATIS MATERI
    // =========================================================
    private function materiData(): array
    {
        return [
            ['id' => 1, 'judul' => 'Video Belajar Wirausaha',     'deskripsi' => 'Akses puluhan video pembelajaran praktis dari mentor berpengalaman di bidang UMKM, bisnis lokal, dan kewirausahaan Indonesia.', 'ikon' => '🎬', 'warna' => 'linear-gradient(135deg, #d0eac0, #85c96a)', 'modul' => [], 'benefit' => [], 'metode' => '-', 'tingkat' => '-', 'durasi' => '-', 'bahasa' => 'Bahasa Indonesia', 'kuota' => '-', 'total_modul' => 0],
            ['id' => 2, 'judul' => 'Panduan & Template Bisnis',   'deskripsi' => 'Unduh template rencana usaha, laporan keuangan sederhana, dan panduan digital siap pakai khusus untuk pelaku UMKM.',           'ikon' => '📄', 'warna' => 'linear-gradient(135deg, #c0d5f5, #7aaee0)', 'modul' => [], 'benefit' => [], 'metode' => '-', 'tingkat' => '-', 'durasi' => '-', 'bahasa' => 'Bahasa Indonesia', 'kuota' => '-', 'total_modul' => 0],
            ['id' => 3, 'judul' => 'Studi Kasus UMKM Sukses',     'deskripsi' => 'Belajar dari kisah nyata pelaku UMKM Indonesia yang berhasil berkembang, dengan analisis strategi yang bisa langsung diterapkan.', 'ikon' => '📊', 'warna' => 'linear-gradient(135deg, #fce0b0, #f5b04a)', 'modul' => [], 'benefit' => [], 'metode' => '-', 'tingkat' => '-', 'durasi' => '-', 'bahasa' => 'Bahasa Indonesia', 'kuota' => '-', 'total_modul' => 0],
            ['id' => 4, 'judul' => 'Kuis & Sertifikat Kompetensi', 'deskripsi' => 'Uji pemahaman Anda di setiap tahap pelatihan dan raih sertifikat kompetensi resmi dari KAJI INDONESIA sebagai bukti keahlian Anda.', 'ikon' => '🏅', 'warna' => 'linear-gradient(135deg, #e0c8f5, #b07fdc)', 'modul' => [], 'benefit' => [], 'metode' => '-', 'tingkat' => '-', 'durasi' => '-', 'bahasa' => 'Bahasa Indonesia', 'kuota' => '-', 'total_modul' => 0],
        ];
    }

    // =========================================================
    // DATA STATIS EVENT
    // =========================================================
    private function eventData(): array
    {
        return [
            [
                'id'                => 1,
                'tipe'              => 'Workshop',
                'tipe_ikon'         => '🛠️',
                'judul'             => 'Workshop Pembuatan Produk UMKM',
                'tanggal'           => 'Sabtu, 26 April 2025',
                'jam'               => '08.00 – 15.00 WIB',
                'lokasi'            => 'Gedung KAJI INDONESIA, Surabaya',
                'kapasitas'         => '30 Peserta',
                'durasi'            => '7 Jam',
                'jumlah_mentor'     => '2 Mentor',
                'deskripsi_singkat' => 'Pelatihan langsung cara membuat, mengemas, dan mempresentasikan produk UMKM yang menarik dan layak jual di pasar modern.',
                'deskripsi_panjang' => 'Workshop ini dirancang khusus untuk pelaku UMKM yang ingin meningkatkan kualitas produk mereka agar lebih siap bersaing di pasar modern.',
                'ikon'              => '🛍️',
                'warna'             => 'linear-gradient(135deg, #c8e6b0, #7dcf8a)',
                'rundown'           => [
                    ['waktu' => '08.00 – 08.30', 'judul' => 'Registrasi & Pembukaan',           'keterangan' => 'Pendaftaran ulang peserta, sambutan dari panitia KAJI INDONESIA.',                            'tag' => 'Pembukaan', 'tag_warna' => 'hijau'],
                    ['waktu' => '08.30 – 10.00', 'judul' => 'Sesi 1 — Dasar Pembuatan Produk',  'keterangan' => 'Materi pemilihan bahan baku, standar kualitas, dan teknik produksi yang efisien untuk UMKM.', 'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '10.00 – 10.15', 'judul' => 'Istirahat',                        'keterangan' => 'Coffee break & sesi networking antar peserta.',                                                'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '10.15 – 12.00', 'judul' => 'Sesi 2 — Teknik Pengemasan',       'keterangan' => 'Praktik langsung membuat kemasan produk yang menarik dan sesuai standar marketplace.',         'tag' => 'Praktik',   'tag_warna' => 'hijau'],
                    ['waktu' => '12.00 – 13.00', 'judul' => 'Ishoma',                           'keterangan' => 'Istirahat, sholat, dan makan siang bersama.',                                                  'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '13.00 – 14.30', 'judul' => 'Sesi 3 — Presentasi & Penilaian', 'keterangan' => 'Peserta mempresentasikan produk hasil workshop untuk mendapat masukan dari mentor.',            'tag' => 'Praktik',   'tag_warna' => 'hijau'],
                    ['waktu' => '14.30 – 15.00', 'judul' => 'Penutupan & Sertifikat',          'keterangan' => 'Sesi tanya jawab, foto bersama, dan pembagian sertifikat resmi KAJI INDONESIA.',               'tag' => 'Penutupan', 'tag_warna' => 'hijau'],
                ],
                'pembicara'         => [
                    ['inisial' => 'BW', 'nama' => 'Budi Wicaksono', 'peran' => 'Praktisi UMKM & Founder Produk Lokal'],
                    ['inisial' => 'SR', 'nama' => 'Sari Rahayu',    'peran' => 'Konsultan Kemasan & Branding UMKM'],
                ],
                'benefit'           => [
                    'Pengetahuan teknik produksi yang efisien',
                    'Praktik langsung membuat kemasan produk',
                    'Feedback langsung dari mentor berpengalaman',
                    'Modul & panduan produk dalam bentuk digital',
                    'Sertifikat keikutsertaan resmi KAJI INDONESIA',
                    'Akses grup komunitas UMKM KAJI',
                ],
            ],
            [
                'id'                => 2,
                'tipe'              => 'Workshop',
                'tipe_ikon'         => '🛠️',
                'judul'             => 'Workshop Foto Produk dengan HP',
                'tanggal'           => 'Sabtu, 10 Mei 2025',
                'jam'               => '08.00 – 14.00 WIB',
                'lokasi'            => 'Gedung KAJI INDONESIA, Surabaya',
                'kapasitas'         => '30 Peserta',
                'durasi'            => '6 Jam',
                'jumlah_mentor'     => '2 Mentor',
                'deskripsi_singkat' => 'Belajar teknik fotografi produk menggunakan smartphone untuk keperluan jualan di marketplace dan media sosial.',
                'deskripsi_panjang' => 'Workshop ini mengajarkan peserta cara menghasilkan foto produk yang menarik dan profesional hanya menggunakan smartphone.',
                'ikon'              => '📸',
                'warna'             => 'linear-gradient(135deg, #fde8b0, #f7c36a)',
                'rundown'           => [
                    ['waktu' => '08.00 – 08.30', 'judul' => 'Registrasi & Pembukaan',           'keterangan' => 'Pendaftaran ulang peserta dan sambutan dari panitia KAJI INDONESIA.',                          'tag' => 'Pembukaan', 'tag_warna' => 'hijau'],
                    ['waktu' => '08.30 – 10.00', 'judul' => 'Sesi 1 — Dasar Fotografi HP',      'keterangan' => 'Teknik dasar pengaturan kamera smartphone, pencahayaan, dan komposisi foto produk.',            'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '10.00 – 10.15', 'judul' => 'Istirahat',                        'keterangan' => 'Coffee break & networking antar peserta.',                                                       'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '10.15 – 12.00', 'judul' => 'Sesi 2 — Praktik Foto Produk',     'keterangan' => 'Praktik langsung memotret produk masing-masing peserta dengan bimbingan mentor.',               'tag' => 'Praktik',   'tag_warna' => 'hijau'],
                    ['waktu' => '12.00 – 13.00', 'judul' => 'Ishoma',                           'keterangan' => 'Istirahat, sholat, dan makan siang bersama.',                                                   'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '13.00 – 13.45', 'judul' => 'Sesi 3 — Editing Foto dengan App', 'keterangan' => 'Praktik editing foto menggunakan aplikasi gratis di smartphone untuk hasil yang profesional.',   'tag' => 'Praktik',   'tag_warna' => 'hijau'],
                    ['waktu' => '13.45 – 14.00', 'judul' => 'Penutupan & Sertifikat',           'keterangan' => 'Sesi tanya jawab, foto bersama, dan pembagian sertifikat resmi KAJI INDONESIA.',                'tag' => 'Penutupan', 'tag_warna' => 'hijau'],
                ],
                'pembicara'         => [
                    ['inisial' => 'RA', 'nama' => 'Rizky Aditya', 'peran' => 'Fotografer Produk & Content Creator UMKM'],
                    ['inisial' => 'DN', 'nama' => 'Dewi Nuraini', 'peran' => 'Praktisi Digital Marketing UMKM'],
                ],
                'benefit'           => [
                    'Teknik foto produk profesional dengan HP',
                    'Praktik langsung dengan produk sendiri',
                    'Panduan editing foto gratis di smartphone',
                    'Modul fotografi produk dalam bentuk digital',
                    'Sertifikat keikutsertaan resmi KAJI INDONESIA',
                    'Akses grup komunitas UMKM KAJI',
                ],
            ],
            [
                'id'                => 3,
                'tipe'              => 'Workshop',
                'tipe_ikon'         => '🛠️',
                'judul'             => 'Workshop Desain Label & Kemasan',
                'tanggal'           => 'Sabtu, 24 Mei 2025',
                'jam'               => '08.00 – 15.00 WIB',
                'lokasi'            => 'Gedung KAJI INDONESIA, Surabaya',
                'kapasitas'         => '30 Peserta',
                'durasi'            => '7 Jam',
                'jumlah_mentor'     => '2 Mentor',
                'deskripsi_singkat' => 'Praktik membuat desain label dan kemasan produk yang profesional menggunakan tools desain gratis berbasis digital.',
                'deskripsi_panjang' => 'Workshop ini membekali pelaku UMKM dengan kemampuan mendesain label dan kemasan produk sendiri menggunakan tools desain gratis seperti Canva.',
                'ikon'              => '🎨',
                'warna'             => 'linear-gradient(135deg, #f5c0d0, #e87fa0)',
                'rundown'           => [
                    ['waktu' => '08.00 – 08.30', 'judul' => 'Registrasi & Pembukaan',           'keterangan' => 'Pendaftaran ulang peserta dan sambutan dari panitia KAJI INDONESIA.',                       'tag' => 'Pembukaan', 'tag_warna' => 'hijau'],
                    ['waktu' => '08.30 – 10.00', 'judul' => 'Sesi 1 — Prinsip Desain Kemasan',  'keterangan' => 'Dasar desain kemasan, psikologi warna, tipografi, dan elemen label wajib produk UMKM.',    'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '10.00 – 10.15', 'judul' => 'Istirahat',                        'keterangan' => 'Coffee break & networking antar peserta.',                                                   'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '10.15 – 12.00', 'judul' => 'Sesi 2 — Praktik Desain di Canva', 'keterangan' => 'Praktik langsung membuat desain label produk menggunakan Canva dengan bimbingan mentor.',   'tag' => 'Praktik',   'tag_warna' => 'hijau'],
                    ['waktu' => '12.00 – 13.00', 'judul' => 'Ishoma',                           'keterangan' => 'Istirahat, sholat, dan makan siang bersama.',                                               'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '13.00 – 14.30', 'judul' => 'Sesi 3 — Finalisasi & Review',     'keterangan' => 'Peserta menyelesaikan desain kemasan dan mendapatkan review langsung dari mentor.',          'tag' => 'Praktik',   'tag_warna' => 'hijau'],
                    ['waktu' => '14.30 – 15.00', 'judul' => 'Penutupan & Sertifikat',           'keterangan' => 'Sesi tanya jawab, foto bersama, dan pembagian sertifikat resmi KAJI INDONESIA.',            'tag' => 'Penutupan', 'tag_warna' => 'hijau'],
                ],
                'pembicara'         => [
                    ['inisial' => 'AF', 'nama' => 'Ahmad Fauzi',   'peran' => 'Desainer Grafis & Konsultan Kemasan UMKM'],
                    ['inisial' => 'LM', 'nama' => 'Linda Mawarni', 'peran' => 'Praktisi Branding Produk Lokal'],
                ],
                'benefit'           => [
                    'Kemampuan desain label produk sendiri',
                    'Hasil desain kemasan siap cetak',
                    'Template desain label editable di Canva',
                    'Panduan regulasi label produk UMKM',
                    'Sertifikat keikutsertaan resmi KAJI INDONESIA',
                    'Akses grup komunitas UMKM KAJI',
                ],
            ],
            [
                'id'                => 4,
                'tipe'              => 'Workshop',
                'tipe_ikon'         => '🛠️',
                'judul'             => 'Workshop Jualan di Marketplace',
                'tanggal'           => 'Sabtu, 7 Juni 2025',
                'jam'               => '08.00 – 14.00 WIB',
                'lokasi'            => 'Gedung KAJI INDONESIA, Surabaya',
                'kapasitas'         => '30 Peserta',
                'durasi'            => '6 Jam',
                'jumlah_mentor'     => '2 Mentor',
                'deskripsi_singkat' => 'Panduan lengkap membuka toko, mengelola pesanan, dan meningkatkan penjualan di Tokopedia, Shopee, dan TikTok Shop.',
                'deskripsi_panjang' => 'Workshop ini membantu pelaku UMKM memulai dan mengoptimalkan toko online mereka di platform marketplace terbesar di Indonesia.',
                'ikon'              => '🛒',
                'warna'             => 'linear-gradient(135deg, #c0d5f5, #7aaee0)',
                'rundown'           => [
                    ['waktu' => '08.00 – 08.30', 'judul' => 'Registrasi & Pembukaan',        'keterangan' => 'Pendaftaran ulang peserta dan sambutan dari panitia KAJI INDONESIA.',                      'tag' => 'Pembukaan', 'tag_warna' => 'hijau'],
                    ['waktu' => '08.30 – 10.00', 'judul' => 'Sesi 1 — Setup Toko Online',    'keterangan' => 'Panduan membuka dan mengoptimalkan toko di Tokopedia, Shopee, dan TikTok Shop dari nol.',  'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '10.00 – 10.15', 'judul' => 'Istirahat',                     'keterangan' => 'Coffee break & networking antar peserta.',                                                   'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '10.15 – 12.00', 'judul' => 'Sesi 2 — Strategi Penjualan',   'keterangan' => 'Teknik mengoptimalkan listing produk, strategi harga, dan mendapatkan ulasan positif.',    'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '12.00 – 13.00', 'judul' => 'Ishoma',                        'keterangan' => 'Istirahat, sholat, dan makan siang bersama.',                                               'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '13.00 – 13.45', 'judul' => 'Sesi 3 — Praktik Langsung',     'keterangan' => 'Peserta mempraktikkan langsung membuka toko dan mengupload produk pertama mereka.',         'tag' => 'Praktik',   'tag_warna' => 'hijau'],
                    ['waktu' => '13.45 – 14.00', 'judul' => 'Penutupan & Sertifikat',        'keterangan' => 'Sesi tanya jawab, foto bersama, dan pembagian sertifikat resmi KAJI INDONESIA.',            'tag' => 'Penutupan', 'tag_warna' => 'hijau'],
                ],
                'pembicara'         => [
                    ['inisial' => 'HN', 'nama' => 'Hendra Nugraha', 'peran' => 'Seller Expert Tokopedia & Shopee'],
                    ['inisial' => 'YP', 'nama' => 'Yuni Pratiwi',   'peran' => 'TikTok Shop Specialist & UMKM Coach'],
                ],
                'benefit'           => [
                    'Toko online aktif di marketplace pilihan',
                    'Strategi optimasi produk agar mudah ditemukan',
                    'Panduan mengelola pesanan & ulasan pelanggan',
                    'Checklist setup toko marketplace lengkap',
                    'Sertifikat keikutsertaan resmi KAJI INDONESIA',
                    'Akses grup komunitas UMKM KAJI',
                ],
            ],
            [
                'id'                => 5,
                'tipe'              => 'Seminar',
                'tipe_ikon'         => '🎤',
                'judul'             => 'Seminar Peluang Bisnis UMKM 2025',
                'tanggal'           => 'Rabu, 30 April 2025',
                'jam'               => '09.00 – 13.00 WIB',
                'lokasi'            => 'Aula KAJI INDONESIA, Surabaya',
                'kapasitas'         => '100 Peserta',
                'durasi'            => '4 Jam',
                'jumlah_mentor'     => '3 Pembicara',
                'deskripsi_singkat' => 'Membedah tren peluang usaha terkini di Indonesia, mulai dari ekonomi kreatif hingga bisnis berbasis digital.',
                'deskripsi_panjang' => 'Seminar ini menghadirkan para pakar dan praktisi bisnis untuk berbagi wawasan tentang peluang usaha terbesar yang bisa dimanfaatkan pelaku UMKM di tahun 2025.',
                'ikon'              => '💡',
                'warna'             => 'linear-gradient(135deg, #d0eac0, #85c96a)',
                'rundown'           => [
                    ['waktu' => '09.00 – 09.30', 'judul' => 'Registrasi & Pembukaan',            'keterangan' => 'Pendaftaran ulang peserta, sambutan dari panitia dan perwakilan KAJI INDONESIA.',          'tag' => 'Pembukaan', 'tag_warna' => 'hijau'],
                    ['waktu' => '09.30 – 10.30', 'judul' => 'Sesi 1 — Tren Bisnis 2025',         'keterangan' => 'Paparan tren peluang usaha terkini di Indonesia oleh pakar ekonomi kreatif.',               'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '10.30 – 11.30', 'judul' => 'Sesi 2 — Peluang Bisnis Digital',   'keterangan' => 'Pembahasan peluang bisnis berbasis digital yang bisa langsung dijalankan pelaku UMKM.',     'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '11.30 – 11.45', 'judul' => 'Istirahat',                         'keterangan' => 'Coffee break & networking antar peserta.',                                                   'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '11.45 – 12.45', 'judul' => 'Sesi 3 — Kisah Sukses UMKM Lokal', 'keterangan' => 'Sharing dari pelaku UMKM yang berhasil memanfaatkan peluang bisnis digital.',               'tag' => 'Sharing',   'tag_warna' => 'hijau'],
                    ['waktu' => '12.45 – 13.00', 'judul' => 'Tanya Jawab & Penutupan',           'keterangan' => 'Sesi tanya jawab, foto bersama, dan pembagian sertifikat resmi KAJI INDONESIA.',            'tag' => 'Penutupan', 'tag_warna' => 'hijau'],
                ],
                'pembicara'         => [
                    ['inisial' => 'PT', 'nama' => 'Prof. Teguh Santoso', 'peran' => 'Pakar Ekonomi Kreatif Indonesia'],
                    ['inisial' => 'MB', 'nama' => 'Maya Budiman',        'peran' => 'Founder Startup UMKM Digital'],
                    ['inisial' => 'RH', 'nama' => 'Ryan Hidayat',        'peran' => 'Pelaku UMKM Sukses & Motivator Bisnis'],
                ],
                'benefit'           => [
                    'Wawasan tren peluang bisnis terkini 2025',
                    'Peta peluang usaha digital yang konkret',
                    'Inspirasi dari kisah sukses UMKM lokal',
                    'Modul ringkasan seminar dalam bentuk digital',
                    'Sertifikat keikutsertaan resmi KAJI INDONESIA',
                    'Akses grup komunitas UMKM KAJI',
                ],
            ],
            [
                'id'                => 6,
                'tipe'              => 'Seminar',
                'tipe_ikon'         => '🎤',
                'judul'             => 'Seminar Akses Permodalan UMKM',
                'tanggal'           => 'Rabu, 14 Mei 2025',
                'jam'               => '09.00 – 13.00 WIB',
                'lokasi'            => 'Aula KAJI INDONESIA, Surabaya',
                'kapasitas'         => '100 Peserta',
                'durasi'            => '4 Jam',
                'jumlah_mentor'     => '3 Pembicara',
                'deskripsi_singkat' => 'Informasi lengkap seputar KUR, hibah pemerintah, dan platform pinjaman modal yang bisa diakses oleh pelaku UMKM.',
                'deskripsi_panjang' => 'Seminar ini hadir untuk memberikan informasi lengkap dan terpercaya tentang berbagai skema pembiayaan yang tersedia bagi pelaku UMKM.',
                'ikon'              => '🏦',
                'warna'             => 'linear-gradient(135deg, #fce0b0, #f5b04a)',
                'rundown'           => [
                    ['waktu' => '09.00 – 09.30', 'judul' => 'Registrasi & Pembukaan',               'keterangan' => 'Pendaftaran ulang peserta dan sambutan dari panitia KAJI INDONESIA.',                    'tag' => 'Pembukaan', 'tag_warna' => 'hijau'],
                    ['waktu' => '09.30 – 10.30', 'judul' => 'Sesi 1 — KUR & Pembiayaan Bank',       'keterangan' => 'Penjelasan lengkap tentang KUR, syarat pengajuan, dan tips lolos seleksi dari bank.',    'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '10.30 – 11.30', 'judul' => 'Sesi 2 — Hibah & Program Pemerintah',  'keterangan' => 'Informasi program hibah UMKM dari Kemenkop, Kemendag, dan pemerintah daerah.',           'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '11.30 – 11.45', 'judul' => 'Istirahat',                            'keterangan' => 'Coffee break & networking antar peserta.',                                                'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '11.45 – 12.45', 'judul' => 'Sesi 3 — Fintech & Modal Alternatif',  'keterangan' => 'Pengenalan platform fintech yang menyediakan modal usaha untuk UMKM.',                   'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '12.45 – 13.00', 'judul' => 'Tanya Jawab & Penutupan',              'keterangan' => 'Sesi tanya jawab, foto bersama, dan pembagian sertifikat resmi KAJI INDONESIA.',         'tag' => 'Penutupan', 'tag_warna' => 'hijau'],
                ],
                'pembicara'         => [
                    ['inisial' => 'AS', 'nama' => 'Agus Setiawan',  'peran' => 'Analis Kredit Bank BRI — Divisi KUR UMKM'],
                    ['inisial' => 'NR', 'nama' => 'Nur Rahmawati',  'peran' => 'Pendamping Program Hibah Kemenkop RI'],
                    ['inisial' => 'DP', 'nama' => 'Dimas Prasetyo', 'peran' => 'CEO Platform Fintech UMKM'],
                ],
                'benefit'           => [
                    'Panduan lengkap pengajuan KUR',
                    'Daftar program hibah UMKM yang aktif',
                    'Rekomendasi platform fintech terpercaya',
                    'Template dokumen pengajuan modal usaha',
                    'Sertifikat keikutsertaan resmi KAJI INDONESIA',
                    'Akses grup komunitas UMKM KAJI',
                ],
            ],
            [
                'id'                => 7,
                'tipe'              => 'Seminar',
                'tipe_ikon'         => '🎤',
                'judul'             => 'Seminar Ekspor Produk Lokal',
                'tanggal'           => 'Rabu, 28 Mei 2025',
                'jam'               => '09.00 – 13.00 WIB',
                'lokasi'            => 'Aula KAJI INDONESIA, Surabaya',
                'kapasitas'         => '100 Peserta',
                'durasi'            => '4 Jam',
                'jumlah_mentor'     => '3 Pembicara',
                'deskripsi_singkat' => 'Wawasan dan langkah awal bagi UMKM yang ingin menjangkau pasar internasional melalui platform ekspor digital.',
                'deskripsi_panjang' => 'Seminar ini membuka wawasan pelaku UMKM tentang peluang besar pasar ekspor yang bisa dimanfaatkan produk lokal Indonesia.',
                'ikon'              => '🌏',
                'warna'             => 'linear-gradient(135deg, #e0c8f5, #b07fdc)',
                'rundown'           => [
                    ['waktu' => '09.00 – 09.30', 'judul' => 'Registrasi & Pembukaan',             'keterangan' => 'Pendaftaran ulang peserta dan sambutan dari panitia KAJI INDONESIA.',                      'tag' => 'Pembukaan', 'tag_warna' => 'hijau'],
                    ['waktu' => '09.30 – 10.30', 'judul' => 'Sesi 1 — Peluang Ekspor UMKM',       'keterangan' => 'Gambaran pasar ekspor global untuk produk lokal Indonesia.',                               'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '10.30 – 11.30', 'judul' => 'Sesi 2 — Regulasi & Prosedur Ekspor','keterangan' => 'Dokumen ekspor, izin, sertifikasi, dan prosedur pengiriman ke luar negeri.',               'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '11.30 – 11.45', 'judul' => 'Istirahat',                          'keterangan' => 'Coffee break & networking antar peserta.',                                                  'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '11.45 – 12.45', 'judul' => 'Sesi 3 — Platform Ekspor Digital',   'keterangan' => 'Panduan menggunakan Alibaba, Amazon Global, dan platform ekspor lokal lainnya.',           'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '12.45 – 13.00', 'judul' => 'Tanya Jawab & Penutupan',            'keterangan' => 'Sesi tanya jawab, foto bersama, dan pembagian sertifikat resmi KAJI INDONESIA.',          'tag' => 'Penutupan', 'tag_warna' => 'hijau'],
                ],
                'pembicara'         => [
                    ['inisial' => 'WS', 'nama' => 'Wahyu Susanto',   'peran' => 'Konsultan Ekspor & Importir Produk Lokal'],
                    ['inisial' => 'FS', 'nama' => 'Fitri Susilowati', 'peran' => 'Pelaku UMKM Ekspor — Produk Kerajinan'],
                    ['inisial' => 'IK', 'nama' => 'Irfan Kurniawan', 'peran' => 'Spesialis Platform Ekspor Digital'],
                ],
                'benefit'           => [
                    'Wawasan peluang ekspor produk lokal',
                    'Panduan regulasi & dokumen ekspor',
                    'Rekomendasi platform ekspor digital',
                    'Checklist kesiapan produk untuk ekspor',
                    'Sertifikat keikutsertaan resmi KAJI INDONESIA',
                    'Akses grup komunitas UMKM KAJI',
                ],
            ],
            [
                'id'                => 8,
                'tipe'              => 'Seminar',
                'tipe_ikon'         => '🎤',
                'judul'             => 'Seminar Digitalisasi UMKM',
                'tanggal'           => 'Rabu, 11 Juni 2025',
                'jam'               => '09.00 – 13.00 WIB',
                'lokasi'            => 'Aula KAJI INDONESIA, Surabaya',
                'kapasitas'         => '100 Peserta',
                'durasi'            => '4 Jam',
                'jumlah_mentor'     => '3 Pembicara',
                'deskripsi_singkat' => 'Memahami pentingnya transformasi digital bagi usaha kecil dan cara memulai digitalisasi bisnis secara bertahap dan terjangkau.',
                'deskripsi_panjang' => 'Seminar ini hadir untuk membantu pelaku UMKM memahami apa itu digitalisasi bisnis dan bagaimana cara memulainya secara bertahap tanpa biaya besar.',
                'ikon'              => '📲',
                'warna'             => 'linear-gradient(135deg, #b0eee0, #4dcfb0)',
                'rundown'           => [
                    ['waktu' => '09.00 – 09.30', 'judul' => 'Registrasi & Pembukaan',              'keterangan' => 'Pendaftaran ulang peserta dan sambutan dari panitia KAJI INDONESIA.',                     'tag' => 'Pembukaan', 'tag_warna' => 'hijau'],
                    ['waktu' => '09.30 – 10.30', 'judul' => 'Sesi 1 — Apa Itu Digitalisasi UMKM', 'keterangan' => 'Konsep digitalisasi, manfaat, dan contoh nyata UMKM yang berhasil bertransformasi.',      'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '10.30 – 11.30', 'judul' => 'Sesi 2 — Tools Digital untuk UMKM',  'keterangan' => 'Pengenalan aplikasi kasir, keuangan, stok, dan pemasaran digital untuk UMKM.',           'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '11.30 – 11.45', 'judul' => 'Istirahat',                          'keterangan' => 'Coffee break & networking antar peserta.',                                                 'tag' => 'Break',     'tag_warna' => 'kuning'],
                    ['waktu' => '11.45 – 12.45', 'judul' => 'Sesi 3 — AI & Otomasi untuk UMKM',  'keterangan' => 'Memanfaatkan kecerdasan buatan untuk menghemat waktu dan biaya operasional.',             'tag' => 'Materi',    'tag_warna' => 'hijau'],
                    ['waktu' => '12.45 – 13.00', 'judul' => 'Tanya Jawab & Penutupan',           'keterangan' => 'Sesi tanya jawab, foto bersama, dan pembagian sertifikat resmi KAJI INDONESIA.',          'tag' => 'Penutupan', 'tag_warna' => 'hijau'],
                ],
                'pembicara'         => [
                    ['inisial' => 'TW', 'nama' => 'Taufik Wijaya',   'peran' => 'Konsultan Transformasi Digital UMKM'],
                    ['inisial' => 'AN', 'nama' => 'Anisa Nurhayati', 'peran' => 'Praktisi Teknologi & Founder App UMKM'],
                    ['inisial' => 'GS', 'nama' => 'Galuh Saputra',   'peran' => 'Pakar AI & Otomasi Bisnis Kecil'],
                ],
                'benefit'           => [
                    'Panduan memulai digitalisasi bisnis',
                    'Rekomendasi tools digital gratis untuk UMKM',
                    'Wawasan pemanfaatan AI untuk usaha kecil',
                    'Roadmap transformasi digital UMKM',
                    'Sertifikat keikutsertaan resmi KAJI INDONESIA',
                    'Akses grup komunitas UMKM KAJI',
                ],
            ],
        ];
    }

    // =========================================================
    // HALAMAN UTAMA PROGRAM
    // =========================================================
    public function program(Request $request)
{
    $search = $request->input('search');

    $programsDB = Program::with('trainer')
        ->where('status', 'approved')
        ->where('tipe', 'kurikulum')
        ->when($search, fn($q) => $q->where('judul', 'like', '%' . $search . '%'))
        ->latest()
        ->paginate(12);

    $trainerIds = $programsDB->pluck('trainer_id')->filter()->unique();
    $trainerAcademicDegrees = \App\Models\Trainer::whereIn('user_id', $trainerIds)
        ->pluck('academic_degree', 'user_id');

    $programsDB->getCollection()->transform(function ($program) use ($trainerAcademicDegrees) {
        $program->trainer_academic_degree = $trainerAcademicDegrees->get($program->trainer_id)
            ?? $program->trainer?->name
            ?? '';
        return $program;
    });

    return view('pages.pelatihan-program', compact('programsDB'));
}

    // =========================================================
    // DETAIL PROGRAM — handle DB dan statis
    // =========================================================
    public function detailProgram($id)
    {
        // Cek dari database dulu
        $program = \App\Models\Program::with([
                        'trainer',
                        'moduls' => function($q) {
                            $q->where('status', 'approved')
                              ->orderBy('urutan', 'asc');
                        }
                    ])
                    ->where('status', 'approved')
                    ->find($id);
    
        if ($program) {
            return view('pages.pelatihan-program-detail', compact('program'));
        }
    
        // Fallback ke data statis kurikulum
        $programStatis = collect($this->kurikulumData())->firstWhere('id', (int) $id);
        if ($programStatis) {
            $program = $programStatis;
            return view('pages.pelatihan-program-detail', compact('program'));
        }
    
        abort(404);
    }

    // =========================================================
    // HALAMAN UTAMA EVENT
    // =========================================================
    public function event()
    {
        $events = \App\Models\Event::with('trainer')
    ->where('status', 'approved')
    ->orderBy('tanggal', 'asc')
    ->get();
    
        return view('pages.pelatihan-event', compact('events'));
    }
    
    
    // =========================================================
    // DETAIL EVENT — ambil dari database
    // =========================================================
    public function detailEvent($id)
    {
        $event = \App\Models\Event::with('trainer')
            ->where('status', 'approved')
            ->findOrFail($id);
    
        return view('pages.pelatihan-event-detail', compact('event'));
    }


    // =========================================================
    // HALAMAN MENTOR / PEMBIMBING
    // =========================================================
    public function pembimbing(Request $request)
    {
        $trainers = User::where('users.role', 'trainer')
            ->leftJoin('trainer', 'trainer.user_id', '=', 'users.id')  // ← trainer
            ->where('trainer.status', '=', 'approved')
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('users.name', 'like', '%' . $request->search . '%')
                       ->orWhere('trainer.academic_degree', 'like', '%' . $request->search . '%')
                       ->orWhere('trainer.keahlian', 'like', '%' . $request->search . '%')
                       ->orWhere('trainer.lokasi', 'like', '%' . $request->search . '%');
                });
            })
            ->select(
                'users.*',
                'trainer.keahlian',
                'trainer.displayed_bidang',
                'trainer.white_bg_photo',
                'trainer.foto',   
                'trainer.academic_degree',
                'trainer.gmaps_location',
                'trainer.lokasi as location',
            )
            ->paginate(12);
    
        $trainerIds = $trainers->pluck('id');
        $ulasanData = \App\Models\TrainerUlasan::selectRaw('trainer_id, AVG(rating) as avg_rating, COUNT(*) as total_ulasan')
            ->whereIn('trainer_id', $trainerIds)
            ->groupBy('trainer_id')
            ->get()
            ->keyBy('trainer_id');
    
        $trainers->getCollection()->transform(function ($trainer) use ($ulasanData) {
            $u = $ulasanData->get($trainer->id);
            $trainer->avg_rating   = $u ? round($u->avg_rating, 1) : 0;
            $trainer->total_ulasan = $u ? $u->total_ulasan : 0;
            return $trainer;
        });
    
        $bidangList = \App\Models\Trainer::whereNotNull('keahlian')
            ->pluck('keahlian')
            ->unique()
            ->sort()
            ->values();
    
        return view('pages.pelatihan-pembimbing', compact('trainers', 'bidangList'));
    }
public function detailMentor($id)
{
    $trainer = \App\Models\User::where('role', 'trainer')->findOrFail($id);

    // Ambil data trainer (sosmed, bio, keahlian, foto, dll)
    $trainerData = \App\Models\Trainer::where('user_id', $id)
        ->where('status', 'approved')
        ->first();

    // Gabungkan sosmed dan data lain ke objek $trainer
    if ($trainerData) {
        $trainer->sosmed   = $trainerData->sosmed;
        $trainer->bio      = $trainerData->bio      ?? $trainer->bio;
        $trainer->keahlian = $trainerData->keahlian ?? null;
        $trainer->foto = $trainerData->foto ?? $trainerData->white_bg_photo ?? null;
        $trainer->bidang_keahlian = $trainerData->keahlian ?? $trainer->bidang_keahlian ?? null;
        $trainer->academic_degree = $trainerData->academic_degree ?? $trainer->name;
    }

    $ulasan = \App\Models\TrainerUlasan::with('user')
        ->where('trainer_id', $id)
        ->latest()
        ->get();

    $avgRating   = $ulasan->avg('rating') ?? 0;
    $totalUlasan = $ulasan->count();

    $sudahUlasan = false;
    if (auth()->check()) {
        $sudahUlasan = \App\Models\TrainerUlasan::where('trainer_id', $id)
            ->where('user_id', auth()->id())
            ->exists();
    }

    return view('pages.pelatihan-pembimbing-detail', compact(
        'trainer', 'ulasan', 'avgRating', 'totalUlasan', 'sudahUlasan'
    ));
}

public function simpanUlasanTrainer(Request $request, $id)
{
    $request->validate([
        'rating'   => 'required|integer|min:1|max:5',
        'komentar' => 'nullable|string|max:1000',
    ]);

    $trainer = \App\Models\User::where('role', 'trainer')->findOrFail($id);

    // Cegah duplikat
    $sudah = \App\Models\TrainerUlasan::where('trainer_id', $id)
        ->where('user_id', auth()->id())
        ->exists();

    if ($sudah) {
        return back()->with('error', 'Anda sudah memberikan ulasan untuk trainer ini.');
    }

    \App\Models\TrainerUlasan::create([
        'trainer_id' => $id,
        'user_id'    => auth()->id(),
        'rating'     => $request->rating,
        'komentar'   => $request->komentar,
    ]);

    return back()->with('success', 'Ulasan berhasil dikirim. Terima kasih!');
}

// =========================================================
// TANDAI MODUL SELESAI
// =========================================================
public function tandaiModulSelesai(Request $request, $modulId)
{
    $modul = \App\Models\Program::where('tipe', 'modul')
        ->where('status', 'approved')
        ->findOrFail($modulId);

    // Pastikan user sudah diterima di program ini
    $diterima = \App\Models\PendaftaranProgram::where('user_id', auth()->id())
        ->where('program_id', $modul->kurikulum_id)
        ->where('status', 'diterima')
        ->exists();

    if (!$diterima) {
        return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
    }

    // Upsert progress
    \App\Models\ModulProgress::updateOrCreate(
        ['user_id' => auth()->id(), 'modul_id' => $modulId],
        [
            'program_id' => $modul->kurikulum_id,
            'status'     => 'selesai',
            'selesai_at' => now(),
        ]
    );

    // Cek apakah semua modul sudah selesai
    $totalModul = \App\Models\Program::where('kurikulum_id', $modul->kurikulum_id)
        ->where('tipe', 'modul')
        ->where('status', 'approved')
        ->count();

    $selesaiCount = \App\Models\ModulProgress::where('user_id', auth()->id())
        ->where('program_id', $modul->kurikulum_id)
        ->count();

    $semuaSelesai = $totalModul > 0 && $selesaiCount >= $totalModul;

    return response()->json([
        'success'      => true,
        'semua_selesai' => $semuaSelesai,
        'program_id'   => $modul->kurikulum_id,
    ]);
}

// =========================================================
// HALAMAN SERTIFIKAT
// =========================================================
public function sertifikat($programId)
{
    $program = \App\Models\Program::where('status', 'approved')->findOrFail($programId);

    // Pastikan user sudah diterima
    $pendaftaran = \App\Models\PendaftaranProgram::where('user_id', auth()->id())
        ->where('program_id', $programId)
        ->where('status', 'diterima')
        ->firstOrFail();

    // Pastikan semua modul sudah selesai
    $totalModul = \App\Models\Program::where('kurikulum_id', $programId)
        ->where('tipe', 'modul')
        ->where('status', 'approved')
        ->count();

    $selesaiCount = \App\Models\ModulProgress::where('user_id', auth()->id())
        ->where('program_id', $programId)
        ->count();

    if ($totalModul > 0 && $selesaiCount < $totalModul) {
        abort(403, 'Selesaikan semua modul terlebih dahulu.');
    }

    $user          = auth()->user();
    $trainerGelar  = \App\Models\Trainer::where('user_id', $program->trainer_id)
                        ->value('academic_degree') ?? $program->trainer?->name ?? 'KAJI Indonesia';
    $tanggalSelesai = \App\Models\ModulProgress::where('user_id', auth()->id())
                        ->where('program_id', $programId)
                        ->max('selesai_at');

    return view('pages.sertifikat', compact(
        'program', 'user', 'trainerGelar', 'tanggalSelesai', 'pendaftaran'
    ));
}

// =========================================================
// DOWNLOAD SERTIFIKAT PDF
// =========================================================
public function downloadSertifikat($programId)
{
    $program = \App\Models\Program::where('status', 'approved')->findOrFail($programId);

    $pendaftaran = \App\Models\PendaftaranProgram::where('user_id', auth()->id())
        ->where('program_id', $programId)
        ->where('status', 'diterima')
        ->firstOrFail();

    $totalModul = \App\Models\Program::where('kurikulum_id', $programId)
        ->where('tipe', 'modul')->where('status', 'approved')->count();

    $selesaiCount = \App\Models\ModulProgress::where('user_id', auth()->id())
        ->where('program_id', $programId)->count();

    if ($totalModul > 0 && $selesaiCount < $totalModul) {
        abort(403, 'Selesaikan semua modul terlebih dahulu.');
    }

    $user          = auth()->user();
    $trainerGelar  = \App\Models\Trainer::where('user_id', $program->trainer_id)
                        ->value('academic_degree') ?? $program->trainer?->name ?? 'KAJI Indonesia';
    $tanggalSelesai = \App\Models\ModulProgress::where('user_id', auth()->id())
                        ->where('program_id', $programId)->max('selesai_at');

    $html = view('pages.sertifikat-pdf', compact(
        'program', 'user', 'trainerGelar', 'tanggalSelesai'
    ))->render();

    // Gunakan DomPDF (pastikan sudah install: composer require barryvdh/laravel-dompdf)
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)
        ->setPaper('a4', 'landscape');

    $filename = 'Sertifikat-' . \Illuminate\Support\Str::slug($program->judul) . '-' . auth()->id() . '.pdf';

    return $pdf->download($filename);
}

public function searchMentor(Request $request)
{
    $keyword = $request->get('q', '');

    $trainers = User::where('users.role', 'trainer')
        ->leftJoin('trainer', 'trainer.user_id', '=', 'users.id') // ← fix
        ->where('trainer.status', 'approved')                      // ← fix
        ->select(
            'users.*',
            'trainer.keahlian',           // ← fix
            'trainer.displayed_bidang',   // ← fix
            'trainer.white_bg_photo',     // ← fix
            'trainer.foto', 
            'trainer.academic_degree',    // ← fix
            'trainer.gmaps_location',     // ← fix
            'trainer.lokasi as location', // ← fix
            'trainer.avg_rating',         // ← fix
            'trainer.total_ulasan',       // ← fix
        )
        ->paginate(12);

    $trainerIds = $trainers->pluck('id');
    $ulasanData = \App\Models\TrainerUlasan::selectRaw('trainer_id, AVG(rating) as avg_rating, COUNT(*) as total_ulasan')
        ->whereIn('trainer_id', $trainerIds)
        ->groupBy('trainer_id')
        ->get()
        ->keyBy('trainer_id');

    $result = $trainers->map(function ($trainer) use ($ulasanData) {
        $u = $ulasanData->get($trainer->id);
        return [
            'id'                => $trainer->id,
            'name'              => $trainer->name,
            'academic_degree'   => $trainer->academic_degree,
            'bidang_keahlian'   => $trainer->bidang_keahlian,
            'location'          => !empty(trim($trainer->address ?? '')) ? $trainer->address : null,
            'white_bg_photo'    => $trainer->white_bg_photo,
            'foto'               => $trainer->foto,
            'profile_photo_path'=> $trainer->profile_photo_path,
            'avg_rating'        => $u ? round($u->avg_rating, 1) : 0,
            'total_ulasan'      => $u ? $u->total_ulasan : 0,
        ];
    });

    return response()->json($result);
}
}