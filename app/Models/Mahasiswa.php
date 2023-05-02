<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa_matakuliah;

class Mahasiswa extends Model
{
    protected $table="mahasiswas"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
        public $timestamps= false;
        protected $primaryKey = 'Nim'; // Memanggil isi DB Dengan primarykey
/**
* The attributes that are mass assignable.
* @var array
*/
        protected $fillable = [
        'Nim',
        'Nama',
        'kelas_id',
        'Jurusan',
        'No_Handphone',
        'Email',
        'Tanggal_Lahir',
        // 'kelas_id',
        ];

        public function kelas()
        {
                return $this->belongsTo(Kelas::class);
        }
        public function matakuliah() {
                return $this->belongsToMany(MataKuliah::class, "mahasiswa_matakuliah", "mahasiswa_id", "matakuliah_id")->withPivot('nilai');
            }
}
