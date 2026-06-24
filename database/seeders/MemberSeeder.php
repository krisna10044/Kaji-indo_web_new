<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            ['nama' => 'BNSP Pendamping UMKM', 'jumlah_pendamping' => 149],
            ['nama' => 'BNSP Digital Marketing', 'jumlah_pendamping' => 78],
            ['nama' => 'Fasilitator Nasional BPOM', 'jumlah_pendamping' => 18],
            ['nama' => 'Fasilitator Daerah BPOM', 'jumlah_pendamping' => 100],
            ['nama' => 'Pendampingan Proses Produk Halal', 'jumlah_pendamping' => 199],
            ['nama' => 'Fasilitator Nasional Formalisai Usaha', 'jumlah_pendamping' => 150],
            ['nama' => 'Fasilitator SNI', 'jumlah_pendamping' => 112],
            ['nama' => 'BNSP Penyelia Halal', 'jumlah_pendamping' => 10],
            ['nama' => 'BNSP Trainer', 'jumlah_pendamping' => 15],
            ['nama' => 'BNSP Fasilitator Pendidikan & Pelatihan', 'jumlah_pendamping' => 15],
            ['nama' => 'BNSP Ekspor', 'jumlah_pendamping' => 10],
            ['nama' => 'BNSP Kurator Produk UMKM', 'jumlah_pendamping' => 10],
            ['nama' => 'BNSP Asesor', 'jumlah_pendamping' => 10],
            ['nama' => 'Tenaga Ahli Konsultan', 'jumlah_pendamping' => 10],
            ['nama' => 'Tenaga Ahli Akuntan', 'jumlah_pendamping' => 10],
            ['nama' => 'Tenaga Ahli Logistik', 'jumlah_pendamping' => 10],
            ['nama' => 'Tenaga Ahli Manajemen Bisnis', 'jumlah_pendamping' => 10],
            ['nama' => 'Tenaga Ahli Hukum', 'jumlah_pendamping' => 3],

        ];

        foreach ($members as $member) {
            Member::create($member);
        }
        
    }
}
