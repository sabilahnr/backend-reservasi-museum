<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengunjungController extends Controller
{
   public function validasi(Request $request)
   {
    $validator = Validator::make($request->all(),[
        'nama'=>'required|max:191',
        'kota'=>'required|max:191',
        'negara'=>'nullable|max:191',
        'phone'=>'required|max:191',
        'jumlah'=>'required|max:191',
        'museum'=>'required|max:191',
        'kategori'=>'required|max:191',
        'tanggal'=>'required|max:191',
        'foto.*'=>'required|image|mimes:jpg,png,jpeg,gif,svg',
        'attachment'=>'nullable|max:191',
    ],[
        'nama.required' => 'Kolom nama wajib diisi',
        'kota.required' => 'Kolom kota wajib diisi',
        'phone.required' => 'Kolom phone wajib diisi',
        'jumlah.required' => 'Kolom jumlah wajib diisi',
        // 'foto.required' => 'Kolom Foto wajib diisi',
    ]);

    if($validator->fails())
    {
        return response()->json([
            'status'=> 422,
            'validate_err'=> $validator->messages(),
        ]);
    }
    else
    {
        return response()->json([
            'status'=> 200,
            'message'=>'Tervalidasi',
        ]);
    }

   }
   
   
   
    public function store(Request $request)
    {
        $pengunjung = new Pengunjung;
        $pengunjung->nama = $request->input('nama'); 
        $pengunjung->kota = $request->input('kota'); 
        $pengunjung->phone = $request->input('phone'); 
        $pengunjung->jumlah = $request->input('jumlah'); 
        $pengunjung->museum = $request->input('museum'); 
        $pengunjung->kategori = $request->input('kategori'); 
        $pengunjung->tanggal = $request->input('tanggal'); 
        $pengunjung->foto = $request->input('foto'); 
        $pengunjung->harga = $request->input('harga');
        $pengunjung->pembayaran = $request->input('pembayaran'); 
        $pengunjung->save();
        
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data pengunjung'
        ]);
    }
}
