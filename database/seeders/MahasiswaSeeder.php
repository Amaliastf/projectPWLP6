<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[[
            'Nim'=>'216252728',
            'Nama'=> 'Lee Haechan',
            'Kelas'=> '23',
            'Jurusan'=>'Teknik Informatika',
            'No_Handphone'=>'08213142626',
            'Email'=>'ecanie@gmail.com',
            'Tanggal_Lahir'=>'06 Juni 2000'

        ],
        [
            'Nim'=>'216252729',
            'Nama'=> 'Hwang Renjun',
            'Kelas'=> '23',
            'Jurusan'=>'Kesenian',
            'No_Handphone'=>'08213173627',
            'Email'=>'injunn@gmail.com',
            'Tanggal_Lahir'=>'23 Maret 2000'
        ],
        [
            'Nim'=>'216252725',
            'Nama'=> 'Na Jaemin',
            'Kelas'=> '22',
            'Jurusan'=>'Kedokteran',
            'No_Handphone'=>'08976282692',
            'Email'=>'nana@gmail.com',
            'Tanggal_Lahir'=>'13 Agustus 2000'
        ]];
        DB::table('mahasiswas')->insert($data);
    }
}
