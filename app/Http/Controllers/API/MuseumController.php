<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\museum;
use App\Models\kategori;
use App\Models\harga;
use Illuminate\Http\Request;

class MuseumController extends Controller
{
    //

    public function show()
    {
        $museum = museum::all();
        return response()->json([
            'status'=> 200,
            'museum'=>$museum,
        ]);
    }

    public function validasi(Request $request)
   {
    $validator = Validator::make($request->all(),[
        'nama'=>'required|max:191',
        'kategori'=>'required|max:191',
        'minimum' =>'required|numeric|min: 1',
        'max' =>'required|numeric|min: 1',
        'harga_biasa'=>'required|numeric|min:4',
        'harga_libur'=>'required|numeric|min:4',
    ],[
        'nama.required' => 'Kolom nama wajib diisi',
        'kategori.required' => 'Kolom kategori wajib diisi',
        'min.required' => 'Kolom min wajib diisi',
        'max.required' => 'Kolom max wajib diisi',
        'harga_biasa.required' => 'Kolom harga_biasa wajib diisi',
        'harga_libur.required' => 'Kolom harga_libur wajib diisi',
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
        $museum = museum::create([
            'nama_museum' => $request->nama,
        ]);
        if($museum) 
        {
            $id_museum = museum::latest('id')->first();
            $kategori = kategori::create([
                'nama_kategori' => $request->kategori,
                'id_museum' => $id_museum->id,  
                'min' => 1,
                'max' => 500,
            ]);
            if($kategori)
            {
                $id_kategori = kategori::latest('id')->first();
                harga::create([
                    'id_museum' => $id_museum->id,
                    'id_kategori' => $id_kategori->id,
                    'hari_biasa' => $request->biasa,
                    'hari_libur' => $request->libur
                ]);

                return response()->json([
                    'status'=> 200,
                    'message'=>'Row Inserted',
                ]);
            }
        }
    }
}

