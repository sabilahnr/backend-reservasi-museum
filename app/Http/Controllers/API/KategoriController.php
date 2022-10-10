<?php

namespace App\Http\Controllers\API;


use App\Models\kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
