<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\harga;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function show(Request $request,$id_category)
    {
        $id_museum = $request->input('id_museum');
        $id_category = $request->input('id_category');

        $harga = harga::where('id_kategori',$id_category)
                      ->get();
    
    return response()->json([
    'status'=> 200,
    'harga'=>$harga,
    ]);
    }
}
