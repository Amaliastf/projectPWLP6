<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table ='matakuliah';

    public function mahasiswa(){
        return $this->belongsToMany(Mahasiswa::class, "mahasiswa_matakuliah", "mahasiswa_id", "matakuliah_id");
    }
}