<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{

    public function index()
    {
        $data = Pegawai::all();
        return response($data);
    }

    public function show($nip)
    {     
        $data = Pegawai::where('nip', $nip)->get();

        return response($data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|string',
            'nip' => 'required|unique:pegawais,nip,l,id',
            'alamat' => 'required|string'
        ]);

        $nama = $request->input('nama');
        $nip = $request->input('nip');
        $alamat = $request->input('alamat');

        Pegawai::create(['nama'=>$nama, 'nip'=>$nip, 'alamat'=>$alamat]);
        return response('Berhasil Tambah Data Pegawai');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|string',
            'nip' => 'required|unique:pegawais,nip,l,id',
            'alamat' => 'required|string'
        ]);
        $pegawai = Pegawai::where('id', $id)->first();
        $pegawai->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'alamat'=> $request->alamat 
        ]);
        return response('Berhasil Ubah Data Pegawai');
    }

    public function destroy($id)
    {
        $data = Pegawai::where('id', $id)->first();

        $data->delete();

        return response('Berhasil Menghapus Data Pegawai');
    }
}
