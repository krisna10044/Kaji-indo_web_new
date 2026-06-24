<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        $trainers = [
            [
                'name' => 'Difandi Wahyu Hibatur Rahman',
                'academic_degree' => 'Difandi Wahyu Hibatur Rahman, S.Si',
                'email' => 'difandiwahyuhr@gmail.com',
                'nik' => '3515143009990002',
                'npwp' => '427123757-603000',
                'location' => 'Sidoarjo',
                'experience' => '1 - 2 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1r39WrkBlQggbyrA65fWI_9vKY9hV14xH',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'Arief Budiman',
                'academic_degree' => 'Arief Budiman S.AB., M.AB.',
                'email' => 'ariefdosenpreneur@gmail.com',
                'nik' => '3509210810920005',
                'npwp' => '76.493.985.6-626.000',
                'location' => 'Sidoarjo',
                'experience' => '2 - 3 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1ZrjLwhfuyC6rzqzte__eX_ujbQmPlshp',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'Muhammad Yunus',
                'academic_degree' => 'Muhammad Yunus, S. TP, MP',
                'email' => 'muhammadyunussg@gmail.com',
                'nik' => '3512021903960004',
                'npwp' => '93.494.593.2.-656.000',
                'location' => 'Kab. Jember',
                'experience' => '3 - 5 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'MOH. IMAM BUKHORI',
                'academic_degree' => 'MOH. IMAM BUKHORI, S.Pd.',
                'email' => 'mohimambukhori6@gmail.com',
                'nik' => '3509082810960005',
                'location' => 'Kabupaten Probolinggo',
                'experience' => '2 - 3 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1Y2cfqxTaZEo69Nw0ar4XTFW8mDwDTjSc',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'MANSUR',
                'academic_degree' => 'Dr. Mansur, M.H.I.',
                'email' => 'instrukturnasional.pmk@gmail.com',
                'nik' => '3528022402740001',
                'npwp' => '074939042608000',
                'location' => 'Kab. Pamekasan',
                'experience' => '3 - 5 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1CI-kPlV7NpothZAPDIsBqvvoTk9GX7tf',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'Ida Suryati',
                'academic_degree' => 'Ida Suryati',
                'email' => 'idasuryatirara11@gmail.com',
                'nik' => '3578175807720002',
                'npwp' => '902707082619000',
                'location' => 'Surabaya',
                'experience' => '3 - 5 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1appP_FkrzNwVKoyB-GulCyAoxNivR-dj',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'Sri Rahayu',
                'academic_degree' => 'Dra. Sri Rahayu',
                'email' => 'yayukarara@gmail.com',
                'nik' => '3578276208650001',
                'npwp' => '503650939604000',
                'location' => 'Surabaya',
                'experience' => 'Lebih dari 5 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1WxJaDjdMZqbzYC5Hx91Kdp7jQ-KdwUok',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'Titik Martalina',
                'academic_degree' => 'Titik Martalina, ST',
                'email' => 'ilenchanchan@gmail.com',
                'nik' => '3578146901730002',
                'npwp' => '3578146901730002',
                'location' => 'Sidoarjo',
                'experience' => '3 - 5 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1y_GuectWcdSt35wil4Joqu5Il7gVMT5V',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'Elly Sundari',
                'academic_degree' => 'Elly Sundari, SE',
                'email' => 'cemilanfood78@gmail.com',
                'nik' => '3525144204780001',
                'npwp' => '08.666.010.7-612.000',
                'location' => 'Kab. Gresik',
                'experience' => '2 - 3 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1XHHopqSDXsv2unu8U5-6vjoq_qQ-ZHpA',
                'password' => Hash::make('trainer123'),
            ],
            [
                'name' => 'Gatot Subroto',
                'academic_degree' => 'Gatot Subroto, SE MM',
                'email' => 'gatsutakagawa@gmail.com',
                'nik' => '3173020111770001',
                'npwp' => '09.126.915.9-086.000',
                'location' => 'Jakarta Barat',
                'experience' => '3 - 5 Tahun',
                'role' => 'pembimbing',
                'trainer_status' => 'approved',
                'drive_link_documentation' => 'https://drive.google.com/open?id=1jYE9IWwqa6fTIA5PJmeeTgVDs_YoHGZD',
                'password' => Hash::make('trainer123'),
            ],
        ];

        foreach ($trainers as $data) {
            User::updateOrCreate(
                ['email' => $data['email']], // Mencegah duplikasi jika dijalankan ulang
                $data
            );
        }
    }
}