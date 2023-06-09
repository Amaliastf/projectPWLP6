<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas; 
use illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Storage;
use PDF;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $user = Auth::index();
        //$mahasiswas = Mahasiswa::paginate(5);
        //return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
        
        // if ($request->has('search')) {
        //     $mahasiswas = Mahasiswa::where('Nama', 'LIKE', '%'. request('search') . '%')->paginate(5);
        //     return view('mahasiswas.index', ['mahasiswas' => $mahasiswas]);
        // }else{
        // //fungsi eloquent menampilkan data menggunakan pagination
        // // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
        // $mahasiswas = Mahasiswa::orderBy('Nim', 'desc')->paginate(5);
        // return view('mahasiswas.index', compact('mahasiswas'))
        // ->with('i', (request()->input('page', 1) - 1) * 5);
        // }
        $mahasiswas = Mahasiswa::where([
            ['Nama', '!=', Null],
            [function ($query) use ($request){
                if(($search = $request->search)){
                    $query->orwhere('Nama', 'Like', '%' . $search . '%')->get();
                }
            }]
        ])->paginate(5);
        $posts = Mahasiswa::orderBy('Nim', 'desc');
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('mahasiswas.create');
        $kelas = Kelas::all(); //mendapatkan data dari tabel
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')){
            $image_name = $request->file('image')->store('images', 'public');
        }
        //melakukan validasi data
            $request->validate([
                'Nim' => 'required',
                'Nama' => 'required',
                'Kelas' => 'required',
                'Jurusan' => 'required',
                'No_Handphone' => 'required',
                // 'Email' => 'required',
                // 'Tanggal_Lahir' => 'required',
            ]);

        //fungsi eloquentment untuk menambah data
        $mahasiswas= new Mahasiswa;
        $mahasiswas->Nim=$request->get('Nim');
        $mahasiswas->Nama=$request->get('Nama');
        $mahasiswas->Foto=$image_name;
        // $mahasiswas->Kelas=$request->get('Kelas');
        $mahasiswas->Jurusan=$request->get('Jurusan');
        $mahasiswas->No_Handphone=$request->get('No_Handphone');
       // $mahasiswas->save();

        //fungsi eloquent untuk menambah data
        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();
        
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
             ->with('success', 'Mahasiswa Berhasil Ditambahkan');

         
        // //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());
        // //jika data berhasil ditambahkan, akan kembali ke halaman utama
        // return redirect()->route('mahasiswas.index')
        //     ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($Nim);
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
$request->validate([
    'Nim' => 'required',
    'Nama' => 'required',
    'Kelas' => 'required',
    'Jurusan' => 'required',
    'No_Handphone' => 'required',
    'Email' => 'required',
    'Tanggal_Lahir' => 'required',
    ]);

    // if ($request->file('image')) {
    //     $image_name = $request->file('image')->store('mahasiswa', 'public');
    // }
    $mahasiswas = Mahasiswa::with('kelas')->where('Nim',$Nim)->first();
    if ($mahasiswas->foto && file_exists(storage_path('app/public/' . $mahasiswas->foto))) {
        Storage::delete('public/' . $mahasiswas->foto);  
    }
    $image_name = $request->file('image')->store('images', 'public');

    //fungsi eloquent untuk mengupdate data inputan kita
    // Mahasiswa::find($Nim)->update($request->all());
    // //jika data berhasil diupdate, akan kembali ke halaman utama
    // return redirect()->route('mahasiswas.index')
    // ->with('success', 'Mahasiswa Berhasil Diupdate');
    $mahasiswas=Mahasiswa::with('kelas')->where('Nim',$Nim)->first();
    $mahasiswas->Nim=$request->get('Nim');
    $mahasiswas->Nama=$request->get('Nama');
    $mahasiswas->Foto = $image_name;
    $mahasiswas->Tanggal_lahir=$request->get('Tanggal_lahir');
    $mahasiswas->Jurusan=$request->get('Jurusan');
    $mahasiswas->Email=$request->get('Email');
    $mahasiswas->No_Handphone=$request->get('No_Handphone');
    $mahasiswas->save();

    //Unutk menambahkan dengan relasi belongs to
    $kelas = new Kelas;
    $kelas->id = $request->get('Kelas');

    $mahasiswas->kelas()->associate($kelas);
    $mahasiswas->save();

    //jika data berhasil
    return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil di Update');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
Mahasiswa::find($Nim)->delete();
return redirect()->route('mahasiswas.index')
-> with('success', 'Mahasiswa Berhasil Dihapus');
    }
    public function nilai($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.nilai', compact('Mahasiswa'));
    }
    public function cetak_khs($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        $cetak_khs = PDF::loadView('mahasiswas.KHS', ['Mahasiswa' => $Mahasiswa]);
        return $cetak_khs->stream();
    }
};
