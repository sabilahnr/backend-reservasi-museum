<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\harga;
use App\Models\kategori;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function show()
    {
        $kategori = kategori::select('kategori.*','museum.nama_museum')
                   ->join('museum','museum.id','=','kategori.id_museum')
                    ->get();


        return response()->json([
            'status'=> 200,
            'harga'=>$kategori,
        ]);
    }

    public function edit_show($id_category) 
    {
        // $harga = harga::find($idHarga);

        $kategori = kategori::select('kategori.*','museum.nama_museum')
                        ->where('id_kategori', $id_category)
                        ->join('museum','museum.id','=','kategori.id_museum')
                        ->get();
        if($kategori)
        {
            return response()->json([
                'status'=> 200,
                'harga' => $kategori,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'kategori ID Found',
            ]);
        }

    }

    public function update(Request $request,$id_category)
    {   
        $kategori = kategori::find($id_category);
        $kategori->hari_biasa = $request->input('biasa');
        $kategori->hari_libur = $request->input('libur');
        $kategori->nama_kategori = $request->input('nama_kategori');
        $kategori->nama_kategori_en = $request->input('nama_kategori_en');
        $kategori->update();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Update Harga',
        ]);
    }

    public function destroy($id_category)
    {
        $kategori = kategori::find($id_category);
        if($kategori)
        {
            $kategori->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Berhasil Menghapus Data',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'Tidak ada ID data',
            ]);
        }
    }
    

}
