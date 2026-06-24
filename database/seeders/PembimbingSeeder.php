<?php

namespace Database\Seeders;

use App\Models\Mentor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pembimbing;

class PembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $pembimbings = [
            ['nama' => 'Kanjeng Putra',  'role' => 'Pendamping', 'lokasi' => 'Kota Jakarta Barat',  'foto' => 'pembimbing1.jpeg',  'deskripsi' => 'Saya adalah lulusan Administrasi Bisnis Universitas Brawijaya dengan ketertarikan pada administrasi perkantoran, pengelolaan data, komunikasi bisnis, dan digital marketing. Saya berpengalaman mengelola dokumen, menyusun laporan, dan memberikan pelayanan informasi, serta mempelajari strategi digital marketing, pembuatan konten, dan analisis insight. Saya pernah magang di PT PLN (Persero) Unit Layanan Pelanggan Kediri Kota sebagai staf administrasi dan terlibat dalam branding media sosial, termasuk membantu branding UMKM melalui pembuatan konten dan optimalisasi Instagram. Dengan kemampuan komunikasi yang baik/public speaking, serta saya terbiasa mengoperasikan MS Office, Google Work Space, Media Sosial dan memiliki kemampuan analisis data, marketing, serta bahasa asing yang cukup baik. Dengan kemampuan dan pengalaman yang saya miliki, saya siap bergabung, beradaptasi, dan memberikan kontribusi nyata untuk mendukung perkembangan dan keberhasilan perusahaan.', 'ulasan' => 0],
            ['nama' => 'Martin Louis',   'role' => 'Pendamping', 'lokasi' => 'Kabupaten Jonggol',    'foto' => 'pebimbing2.jpeg',  'deskripsi' => 'Saya adalah lulusan Administrasi Bisnis Universitas Brawijaya dengan ketertarikan pada administrasi perkantoran, pengelolaan data, komunikasi bisnis, dan digital marketing. Saya berpengalaman mengelola dokumen, menyusun laporan, dan memberikan pelayanan informasi, serta mempelajari strategi digital marketing, pembuatan konten, dan analisis insight. Saya pernah magang di PT PLN (Persero) Unit Layanan Pelanggan Kediri Kota sebagai staf administrasi dan terlibat dalam branding media sosial, termasuk membantu branding UMKM melalui pembuatan konten dan optimalisasi Instagram. Dengan kemampuan komunikasi yang baik/public speaking, serta saya terbiasa mengoperasikan MS Office, Google Work Space, Media Sosial dan memiliki kemampuan analisis data, marketing, serta bahasa asing yang cukup baik. Dengan kemampuan dan pengalaman yang saya miliki, saya siap bergabung, beradaptasi, dan memberikan kontribusi nyata untuk mendukung perkembangan dan keberhasilan perusahaan.', 'ulasan' => 0],
            ['nama' => 'Irul Kim',       'role' => 'Pendamping', 'lokasi' => 'Kota Jambi',           'foto' => 'pebimbing3.jpg',  'deskripsi' => 'Saya adalah lulusan Administrasi Bisnis Universitas Brawijaya dengan ketertarikan pada administrasi perkantoran, pengelolaan data, komunikasi bisnis, dan digital marketing. Saya berpengalaman mengelola dokumen, menyusun laporan, dan memberikan pelayanan informasi, serta mempelajari strategi digital marketing, pembuatan konten, dan analisis insight. Saya pernah magang di PT PLN (Persero) Unit Layanan Pelanggan Kediri Kota sebagai staf administrasi dan terlibat dalam branding media sosial, termasuk membantu branding UMKM melalui pembuatan konten dan optimalisasi Instagram. Dengan kemampuan komunikasi yang baik/public speaking, serta saya terbiasa mengoperasikan MS Office, Google Work Space, Media Sosial dan memiliki kemampuan analisis data, marketing, serta bahasa asing yang cukup baik. Dengan kemampuan dan pengalaman yang saya miliki, saya siap bergabung, beradaptasi, dan memberikan kontribusi nyata untuk mendukung perkembangan dan keberhasilan perusahaan.', 'ulasan' => 0],
            ['nama' => 'Sultan Wali',    'role' => 'Pendamping', 'lokasi' => 'Kabupaten Kembangan',  'foto' => 'pebimbing4.jpeg',  'deskripsi' => 'Pendamping berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 0],
            ['nama' => 'Dewi Sartika',   'role' => 'Konsultan',  'lokasi' => 'Kota Bandung',         'foto' => 'pebimbing5.jpeg',  'deskripsi' => 'Konsultan berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 3],
            ['nama' => 'Budi Santoso',   'role' => 'Mentor',     'lokasi' => 'Kota Surabaya',        'foto' => 'pebimbing6.jpeg',  'deskripsi' => 'Mentor berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 1],
            ['nama' => 'Kanjeng Putra',  'role' => 'Pendamping', 'lokasi' => 'Kota Jakarta Barat',  'foto' => 'pembimbing1.jpeg',  'deskripsi' => 'Pendamping berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 0],
            ['nama' => 'Martin Louis',   'role' => 'Pendamping', 'lokasi' => 'Kabupaten Jonggol',    'foto' => 'pebimbing2.jpeg',  'deskripsi' => 'Pendamping berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 0],
            ['nama' => 'Irul Kim',       'role' => 'Pendamping', 'lokasi' => 'Kota Jambi',           'foto' => 'pebimbing3.jpg',  'deskripsi' => 'Pendamping berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 0],
            ['nama' => 'Sultan Wali',    'role' => 'Pendamping', 'lokasi' => 'Kabupaten Kembangan',  'foto' => 'pebimbing4.jpeg',  'deskripsi' => 'Pendamping berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 0],
            ['nama' => 'Dewi Sartika',   'role' => 'Konsultan',  'lokasi' => 'Kota Bandung',         'foto' => 'pebimbing5.jpeg',  'deskripsi' => 'Konsultan berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 3],
            ['nama' => 'Budi Santoso',   'role' => 'Mentor',     'lokasi' => 'Kota Surabaya',        'foto' => 'pebimbing6.jpeg',  'deskripsi' => 'Mentor berpengalaman di bidang pengembangan UMKM.', 'ulasan' => 1],
                      
            ];
 
        foreach ($pembimbings as $item) {
            Mentor::firstOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
