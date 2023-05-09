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

    <ul class="list-group">
    <li class="list-group-item"><b>Nim : </b>{{$Mahasiswa->Nim}}</li>
    <li class="list-group-item"><b>Nama : </b>{{$Mahasiswa->Nama}}</li>
    <li class="list-group-item"><b>Kelas : </b>{{$Mahasiswa->kelas->nama_kelas}}</li>
    </ul><br><br><br>
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
@endsection