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
        $harga = harga::select('harga.*','museum.nama_museum','kategori.nama_kategori')
                   ->join('museum','museum.id','=','harga.id_museum')
                    ->join('kategori','kategori.id','=','harga.id_kategori')
                    ->get();


        return response()->json([
            'status'=> 200,
            'harga'=>$harga,
        ]);
    }

    public function edit_show($id_category) 
    {
        // $harga = harga::find($idHarga);

        $harga = harga::select('harga.*','museum.nama_museum','kategori.nama_kategori','kategori.min','kategori.max')
                        ->where('id_kategori', $id_category)
                        ->join('museum','museum.id','=','harga.id_museum')
                        ->join('kategori','kategori.id','=','harga.id_kategori')
                        ->get();
        if($harga)
        {
            return response()->json([
                'status'=> 200,
                'harga' => $harga,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Harga ID Found',
            ]);
        }

    }

    public function update(Request $request,$id_category)
    {
        // $harga = harga::select('harga.*')->where('id', $id_category)->get();
        $harga = harga::find($id_category);

        $harga->hari_biasa = $request->input('biasa');
        $harga->hari_libur = $request->input('libur');
        $harga->update();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Update Harga',
        ]);
    }

    public function 
    destroy($id_category)
    {
        $harga = harga::find($id_category);
        $kategori = kategori::find($id_category);
        if($harga)
        {
            $harga->delete();
            $kategori->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Student Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Student ID Found',
            ]);
        }
    }
    

}
