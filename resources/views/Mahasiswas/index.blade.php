@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <form action="{{ route('mahasiswas.index') }}" method="GET" class="d-flex" role="search">
                    <input type="text" name="search" class="form-control me-2" type="search" placeholder="Search">
                    <span class="input-group-prepend">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    </span>
                    
                </form>
            </div>
        </nav>
        <div class="float-right my-2">
            <a class="btn btnsuccess" href="{{ route('mahasiswas.create') }}"> Input Mahasiswa</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th>Foto</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>No_Handphone</th>
        <th>Action</th>
        <!-- <th>Tanggal_Lahir</th> -->
        <!-- <th width="280px">Action</th> -->
    </tr>
    @foreach ($mahasiswas as $Mahasiswa)
    <tr>
        <td>{{ $Mahasiswa->Nim }}</td>
        <td>{{ $Mahasiswa->Nama }}</td>
        <td><img width="100px" src="{{ asset('storage/'.$Mahasiswa->Foto) }}"></td>
        <td>{{ $Mahasiswa->Kelas->nama_kelas }}</td>
        <td>{{ $Mahasiswa->Jurusan }}</td>
        <td>{{ $Mahasiswa->No_Handphone }}</td>
        <!-- <td>{{ $Mahasiswa->Email }}</td>
        <td>{{ $Mahasiswa->Tanggal_Lahir }}</td> -->
        <td>

            <form action="{{ route('mahasiswas.destroy',$Mahasiswa->Nim) }}" method="POST">
                <a class="btn btn-info" href="{{ route('mahasiswas.show',$Mahasiswa->Nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswas.edit',$Mahasiswa->Nim) }}">Edit</a>
                <a class="btn btn-success" href="mahasiswas/nilai/{{$Mahasiswa->Nim }}">Nilai</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<!-- {{ $mahasiswas->links() }} -->
<div>
    {!! $mahasiswas->withQueryString()->links('pagination::bootstrap-5') !!}
</div>
@endsection