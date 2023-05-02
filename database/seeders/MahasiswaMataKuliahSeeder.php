<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
            [
                'mahasiswa_id' => 216252728,
                'matakuliah_id' => 1,
                'nilai' => 75,
            ],
            [
                'mahasiswa_id' => 216252728,
                'matakuliah_id' => 2,
                'nilai' => 85,
            ],
            [
                'mahasiswa_id' => 216252728,
                'matakuliah_id' => 3,
                'nilai' => 80,
            ],
            [
                'mahasiswa_id' => 216252728,
                'matakuliah_id' => 4,
                'nilai' => 100,
            ],
            [
                'mahasiswa_id' => 216252728,
                'matakuliah_id' =>5,
                'nilai' => 90,
            ],
        ];

        DB::table('mahasiswa_matakuliah')->insert($nilai);
    }
}