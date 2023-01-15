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
        // $kategori = kategori::where('id_museum',$museumId)
        //                     ->get();
        $kategori = harga::where('id_museum',$museumId)
                            ->get();
        // $kategori = harga::where('id_museum',$museumId)
        //             ->join('kategori', 'kategori.id', '=', 'harga.id_kategori')                   
        //             ->get();
        // $kategori = harga::where('id_museum',$museumId)->kategori()->get();
        
        return response()->json([
            'status'=> 200,
            'kategori'=>$kategori,
        ]);
    }
}
