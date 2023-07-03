<?php

namespace App\Http\Controllers\API;


use App\Models\kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\harga;

class KategoriController extends Controller
{
    
    
    public function show($museumId)
    {
        $kategori = kategori::where('id_museum',$museumId)                
                    ->get();                       
        
        return response()->json([
            'status'=> 200,
            'kategori'=>$kategori,
        ]);
    }

    public function show_kategori()
    {
        // $kategori = kategori::all();
        $kategori = kategori::select('kategori.*','museum.nama_museum')
                        ->join('museum','museum.id','=','kategori.id_museum')
                        ->get();
        return response()->json([
            'status'=> 200,
            'kategori'=>$kategori,
        ]);
    }


    public function store(Request $request) 
    {
       
        // $faq = museum::find($id_faq);
        $nama_kategori = kategori::where('id_museum',$request->id_museum)->where('nama_kategori',$request->kategori)->first();
        // $nama_kategori = kategori::where('nama_kategori',$request->kategori)->first();
        

        if($nama_kategori !== null)
        {
            return response()->json([
                'status'=> 205,
                'message'=>'kategori Sudah Ada',
            ]);
        }
        else
        {
            $kategori = new kategori();
            $kategori-> id_museum = $request->input('id_museum');
            $kategori-> nama_kategori = $request->input('kategori');
            $kategori-> nama_kategori_en = $request->input('kategori_en');
            $kategori-> hari_biasa = $request->input('biasa');
            $kategori-> hari_libur = $request->input('libur');
            $kategori-> min = $request->input('min');
            $kategori-> max = $request->input('max');
            $kategori->save();

            return response()->json([
                'status'=> 200,
                'message'=>"Berhasil Menambahkan Kategori",
            ]);
        }
    }

    public function destroy($id_kategori)
    {
        $kategori = kategori::find($id_kategori);

       
        if($kategori)
        {
            $kategori->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'kategori Berhasil Dihapus',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'Tidak ada ID kategori',
            ]);
        }
    }

    public function edit_show($id_category) 
    {
        $kategori = kategori::select('kategori.*','museum.nama_museum')
                        ->join('museum','museum.id','=','kategori.id_museum')
                        ->where('kategori.id', '=', $id_category)
                        ->get();
        
        if($kategori)
        {
            return response()->json([
                'status'=> 200,
                'kategori' => $kategori,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No kategori Id Found',
            ]);
        }

    }

    public function update(Request $request,$id_kategori)
    {
        // $harga = harga::select('harga.*')->where('id', $id_category)->get();
        $kategori = kategori::find($id_kategori);

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->nama_kategori_en = $request->nama_kategori_en;
        $kategori->hari_biasa = $request->hari_biasa;
        $kategori->hari_libur = $request->hari_libur;
        $kategori->min = $request->min;
        $kategori->max = $request->max;
        $kategori->update();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Update kategori'  ,
        ]);
    }
}
