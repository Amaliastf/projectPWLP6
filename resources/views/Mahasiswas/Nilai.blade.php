@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <center>
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
                <h1>KARTU HASIL STUDI (KHS)</h1>
            </center>
        </div>
    </div>
    <!-- <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Nim: <br>
            <span class="badge badge-primary badge-pill">{{$Mahasiswa->Nim}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Nama: <br>
            <span class="badge badge-primary badge-pill"><br> {{$Mahasiswa->Nama}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Kelas: <br>
            <span class="badge badge-primary badge-pill">{{$Mahasiswa->kelas->nama_kelas}}</span>
        </li>
    </ul> -->
</div>
<div>
    <ul class="list-group">
  <li class="list-group-item"><b>Nim : </b>{{$Mahasiswa->Nim}}</li>
  <li class="list-group-item"><b>Nama : </b>{{$Mahasiswa->Nama}}</li>
  <li class="list-group-item"><b>Kelas : </b>{{$Mahasiswa->kelas->nama_kelas}}</li>
  
</ul>
<br><br><br>
    <!-- <ul class="list-group list-group-flush text-left mb-4">
        <li class="list-group-item"><b>Nim : </b>{{$Mahasiswa->Nim}}</li>
        <li class="list-group-item"><b>Nama : </b>{{$Mahasiswa->Nama}}</li>
        <li class="list-group-item"><b>Kelas : </b>{{$Mahasiswa->kelas->nama_kelas}}</li>
    </ul> -->

</div>

<table class="table table-bordered">
    <tr>
        <th>Mata_Kuliah</th>
        <th>SKS</th>
        <th>Semester</th>
        <th>Nilai</th>
    </tr>
    @foreach ($Mahasiswa->matakuliah as $matkul)
    <tr>
        <td>{{ $matkul->nama_matkul }}</td>
        <td>{{ $matkul->sks }}</td>
        <td>{{ $matkul->semester }}</td>
        <td>{{ $matkul->pivot->nilai }}</td>
    </tr>
    @endforeach
</table>
<center>
        <a href="{{ route('cetak_khs', $Mahasiswa->Nim) }}" class="btn btn-danger">Cetak PDF</a>
    </center>
@endsection