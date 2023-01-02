<?php

namespace App\Http\Controllers\API;

use App\Models\harga;

use App\Models\museum;
use App\Models\kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

  public function edit_show($id_category) 
    {
        $museum = museum::find($id_category);
        
        if($museum)
        {
            return response()->json([
                'status'=> 200,
                'museum' => $museum,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Museum Id Found',
            ]);
        }

    }

    public function destroy($id_museum)
    {
        $museum = museum::find($id_museum);
        if($museum)
        {
            $museum->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Museum Berhasil Dihapus',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'Tidak ada ID Museum',
            ]);
        }
    }



    public function store(Request $request) 
    {
        // $nama_kategori = DB::table('kategori')->where('nama_kategori',$request->kategori)->first();
        $nama_kategori = DB::table('kategori')->where('id_museum',$request->nama)->where('nama_kategori',$request->kategori)->first();
        
            if($nama_kategori !== null)
            {
                return response()->json([
                    'status'=> 205,
                    'message'=>'Kategori Sudah Ada',
                ]);
            }        
            else
            {
                $kategori = kategori::create([
                            'nama_kategori' => $request->kategori,
                            'id_museum' => $request->nama,  
                            'min' => 1,
                            'max' => 500,
                        ]);
                $id_kategori = kategori::latest('id')->first();
                harga::create([
                                'id_museum' => $request->nama, 
                                'id_kategori' => $id_kategori->id,
                                'hari_biasa' => $request->biasa,
                                'hari_libur' => $request->libur
                            ]);

                            return response()->json([
                                            'status'=> 200,
                                            'message'=>'Data Berhasil Ditambahkan',
                                        ]);
            }
        // return response()->json([
        //                                     'status'=> 200,
        //                                     'message'=>$nama_kategori,
        //                                 ]);

        
    }

    public function update(Request $request,$id_museum)
    {
        // $harga = harga::select('harga.*')->where('id', $id_category)->get();
        $museum = museum::find($id_museum);

        $museum->nama_museum = $request->input('museum');
        $museum->update();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Update Museum' + $museum ,
        ]);
    }

    public function store_museum(Request $request) 
    {
       
        // $faq = museum::find($id_faq);
        $nama_museum = DB::table('museum')->where('nama_museum',$request->nama_museum)->first();
        if($nama_museum)
        {
            return response()->json([
                'status'=> 205,
                'message'=>'Museum Sudah Ada',
            ]);
        }
        else
        {
            $museum = new museum();
            $museum-> nama_museum = $request->input('nama_museum');
            $museum->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Museum di tambahkan',
            ]);
        }
       
    //     $museum = museum::create([
    //         'nama_museum' => $request->nama,
    //     ]);
    //     if($museum) 
    //     {
    //         $id_museum = museum::latest('id')->first();
    //         $kategori = kategori::create([
    //             'nama_kategori' => $request->kategori,
    //             'id_museum' => $id_museum->id,  
    //             'min' => 1,
    //             'max' => 500,
    //         ]);
    //         if($kategori)
    //         {
    //             $id_kategori = kategori::latest('id')->first();
    //             harga::create([
    //                 'id_museum' => $id_museum->id,
    //                 'id_kategori' => $id_kategori->id,
    //                 'hari_biasa' => $request->biasa,
    //                 'hari_libur' => $request->libur
    //             ]);

    //             return response()->json([
    //                 'status'=> 200,
    //                 'message'=>'Row Inserted',
    //             ]);
    //         }
    //     }
    }
}

