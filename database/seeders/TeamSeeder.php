<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            ['nama' => 'ARI PRABOWO, ST,.MM', 'jabatan' => 'Direktur Eksekutif', 'foto' => 'ari_prabowo.jpg'],
            ['nama' => 'DINA EDIWANI', 'jabatan' => 'Manajer Program', 'foto' => 'dina.png'],
            ['nama' => 'MEI YANTI NAINGGOLAN', 'jabatan' => 'Direktur Pelatihan dan Kemitraan', 'foto' => 'mei.png'],
          ];

        foreach ($teams as $team) {
            \App\Models\Team::create($team);
        }
    }
}
