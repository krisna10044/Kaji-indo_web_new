<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $produks = [
            [
                'nama'      => 'Panorama Batik',
                'deskripsi' => 'Panorama batik yaitu usaha yang bergerak dibidang produksi batik tulis yang masih tradisional, sehingga harganya cukup relatif mahal karena nilai seninya yang ditawarkan.',
                'foto_detail'    => '4-madura collection(pict).png',
                'foto'    => '',
                'whatsapp'  => '628123456789',
                'alamat'    => 'Jl. Batik No. 123, Yogyakarta',
            ],
            [
                'nama'      => 'Batik Nusantara',
                'deskripsi' => 'Batik Nusantara menghadirkan koleksi batik modern dengan motif khas daerah yang kaya akan budaya dan nilai seni tinggi.',
                'foto'    => '2-rumah ikan keluarga(pict).jpg',
                'foto_detail'    => '2-rumah ikan keluarga.jpg',
                'whatsapp'  => '628234567890',
                                'alamat'    => 'Jl. Batik No. 123, Yogyakarta',

            ],
            [
                'nama'      => 'Kerajinan Tenun',
                'deskripsi' => 'Kerajinan tenun tangan dengan bahan alami pilihan yang menghasilkan kain berkualitas tinggi dan tahan lama.',
                'foto'    => '3-kue kering naila(pict).png',
                'foto_detail'    => '3-kue kering naila.png',
                'whatsapp'  => '628345678901',
            ],
            [
                'nama'      => 'Batik Mega Mendung',
                'deskripsi' => 'Batik Mega Mendung khas Cirebon dengan motif awan yang khas dan warna-warna cerah yang memukau.',
                'foto'    => '3-kue kering naila(pict).png',
                'foto_detail'    => '3-kue kering naila.png',
                'whatsapp'  => '628456789012',
            ],
            [
                'nama'      => 'Tenun Ikat Sumba',
                'deskripsi' => 'Tenun ikat khas Sumba dengan motif tradisional yang dibuat secara handmade oleh pengrajin lokal berpengalaman.',
                'foto'    => '4-madura collection(pict).png',
                'foto_detail'    => '4-madura collection.png',
                'whatsapp'  => '628567890123',
            ],
            [
                'nama'      => 'Batik Parang',
                'deskripsi' => 'Batik Parang adalah salah satu motif batik tertua di Indonesia yang melambangkan kekuatan dan keberanian.',
                'foto'    => '5-frozen cinta damai(pict).jpg',
                'foto_detail'    => '5-frozen cinta damai.jpg',
                'whatsapp'  => '628678901234',
            ],
            [
                'nama'      => 'Songket Palembang',
                'deskripsi' => 'Songket Palembang merupakan kain tenun mewah dengan benang emas dan perak yang menjadi kebanggaan Sumatera Selatan.',
                'foto'    => '6-budidaya bawang merah asrori(pict).jpeg',
                'foto_detail'    => '6-budidaya bawang merah asrori.jpeg',
                'whatsapp'  => '628789012345',
            ],
            [
                'nama'      => 'Batik Kawung',
                'deskripsi' => 'Batik Kawung dengan motif lingkaran yang melambangkan kesucian dan harapan, dibuat oleh pengrajin batik berpengalaman.',
                'foto'    => '7-kerajinan tangan khas papua(pict).jpeg',
                'foto_detail'    => '7-kerajinan tangan khas papua.jpeg',
                'whatsapp'  => '628890123456',
            ],
                        [
                'nama'      => 'Panorama Batik',
                'deskripsi' => 'Panorama batik yaitu usaha yang bergerak dibidang produksi batik tulis yang masih tradisional, sehingga harganya cukup relatif mahal karena nilai seninya yang ditawarkan.',
                'foto'    => '8-pencucian motor (aqila)(pict).jpg',
                'foto_detail'    => '8-pencucian motor (aqila).jpg',
                'whatsapp'  => '628123456789',
            ],
            [
                'nama'      => 'Batik Nusantara',
                'deskripsi' => 'Batik Nusantara menghadirkan koleksi batik modern dengan motif khas daerah yang kaya akan budaya dan nilai seni tinggi.',
                'foto'    => '9-bengkel motor amiruddin(pict).jpeg',
                'foto_detail'    => '9-bengkel motor amiruddin.jpeg',
                'whatsapp'  => '628234567890',
            ],
            [
                'nama'      => 'Kerajinan Tenun',
                'deskripsi' => 'Kerajinan tenun tangan dengan bahan alami pilihan yang menghasilkan kain berkualitas tinggi dan tahan lama.',
                'foto'    => '10-suhartini bakery(pict).jpeg',
                'foto_detail'    => '10-suhartini bakery.jpeg',
                'whatsapp'  => '628345678901',
            ],
            [
                'nama'      => 'Batik Mega Mendung',
                'deskripsi' => 'Batik Mega Mendung khas Cirebon dengan motif awan yang khas dan warna-warna cerah yang memukau.',
                'foto'    => '11-berkah jaya abadi(pict).jpg',
                'foto_detail'    => '11-berkah jaya abadi.jpg',
                'whatsapp'  => '628456789012',
            ],
            [
                'nama'      => 'Tenun Ikat Sumba',
                'deskripsi' => 'Tenun ikat khas Sumba dengan motif tradisional yang dibuat secara handmade oleh pengrajin lokal berpengalaman.',
                'foto'    => '12-budidaya capai moch. Abd. Halik(pict).jpg',
                'foto_detail'    => '12-budidaya capai moch. Abd. Halik.jpg',
                'whatsapp'  => '628567890123',
            ],
            [
                'nama'      => 'Batik Parang',
                'deskripsi' => 'Batik Parang adalah salah satu motif batik tertua di Indonesia yang melambangkan kekuatan dan keberanian.',
                'foto'    => '13-jasa penjahitan(pict).jpg',
                'foto_detail'    => '13-jasa penjahitan.jpg',
                'whatsapp'  => '628678901234',
            ],
            [
                'nama'      => 'Songket Palembang',
                'deskripsi' => 'Songket Palembang merupakan kain tenun mewah dengan benang emas dan perak yang menjadi kebanggaan Sumatera Selatan.',
                'foto'    => '14-jual beli tembakau sucipto(pict).jpg',
                'foto_detail'    => '14-jual beli tembakau sucipto.jpg',
                'whatsapp'  => '628789012345',
            ],
            [
                'nama'      => 'Batik Kawung',
                'deskripsi' => 'Batik Kawung dengan motif lingkaran yang melambangkan kesucian dan harapan, dibuat oleh pengrajin batik berpengalaman.',
                'foto'    => '15-sapi potong faizah(pict).jpg',
                'foto_detail'    => '15-sapi potong faizah.jpg',
                'whatsapp'  => '628890123456',
            ],
        ];
 
        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    
    }
}
