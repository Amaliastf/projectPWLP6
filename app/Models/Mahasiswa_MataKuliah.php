<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Mahasiswa_matakuliah extends Model
{
    use HasFactory;
    protected $table ='mahasiswa_matakuliah';
}