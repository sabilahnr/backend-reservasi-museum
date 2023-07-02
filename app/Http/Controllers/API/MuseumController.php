<?php

namespace App\Http\Controllers\API;

use App\Models\harga;

use App\Models\museum;
use App\Models\kategori;
use App\Models\about;
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
            'status' => 200,
            'museum' => $museum,
        ]);
    }

    public function validasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:191',
            'kategori' => 'required|max:191',
            'minimum' => 'required|numeric|min: 1',
            'max' => 'required|numeric|min: 1',
            'harga_biasa' => 'required|numeric|min:4',
            'harga_libur' => 'required|numeric|min:4',
        ], [
            'nama.required' => 'Kolom nama wajib diisi',
            'kategori.required' => 'Kolom kategori wajib diisi',
            'min.required' => 'Kolom min wajib diisi',
            'max.required' => 'Kolom max wajib diisi',
            'harga_biasa.required' => 'Kolom harga_biasa wajib diisi',
            'harga_libur.required' => 'Kolom harga_libur wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->messages(),
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Tervalidasi',
            ]);
        }
    }

    public function edit_show($id_category)
    {
        $museum = museum::find($id_category);

        if ($museum) {
            return response()->json([
                'status' => 200,
                'museum' => $museum,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Museum Id Found',
            ]);
        }
    }

    public function destroy($id_museum)
    {
        $museum = museum::find($id_museum);
        $about = about::where('id_museum',$id_museum)->get();
        
        if ($museum) {
            $kategori = kategori::where('id_museum',$id_museum)->get();
            $kategori->each->delete();
            $about->each->delete();
            $museum->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Museum Berhasil Dihapus',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada ID Museum',
            ]);
        }
    }



    public function store(Request $request)
    {
        // $nama_kategori = DB::table('kategori')->where('nama_kategori',$request->kategori)->first();

        // $nama_kategori = DB::table('kategori')->where('id_museum',$request->nama)->where('nama_kategori',$request->kategori)->first();

        //     if($nama_kategori !== null)
        //     {
        //         return response()->json([
        //             'status'=> 205,
        //             'message'=>'Kategori Sudah Ada',
        //         ]);
        //     }        
        //     else
        //     {

        $kategori = kategori::where('id_museum', $request->nama)->first();




        if ($kategori !== null) {
            return response()->json([
                'status' => 220,
                'message' => 'Data Sudah Dibuat',
                'messagee' => $kategori,
            ]);
        } else {
            kategori::create([
                'id_museum' => $request->nama,
                'hari_biasa' => $request->biasa,
                'hari_libur' => $request->libur
            ]);


            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menambahkan Data ',
            ]);
        }
    }

    public function update(Request $request, $id_museum)
    {
        $museum = museum::find($id_museum);
        $museum->nama_museum = $request->input('museum');
        $museum->update();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil Update Museum',
        ]);
    }

    public function store_museum(Request $request)
    {
        $nama_museum = DB::table('museum')->where('nama_museum', $request->nama_museum)->first();
        if ($nama_museum) {
            return response()->json([
                'status' => 205,
                'message' => 'Museum Sudah Ada',
            ]);
        } else {
            $museum = new museum();
            $museum->nama_museum = $request->input('nama_museum');
            $museum->save();
            $id_museum = museum::latest('id')->first();

            $about = new about();
            $about->id_museum = $id_museum->id;
            $about->about = '<p>ini adalah Museum....</p>';
            $about->about_en = '<p>This is Museum....</p>';
            $about->save();

            $kategori = new kategori();
            $kategori->id_museum = $id_museum->id;
            $kategori->nama_kategori = 'Umum';
            $kategori->nama_kategori_en = 'Public';
            $kategori->hari_biasa = '0';
            $kategori->hari_libur = '0';
            $kategori->min = '1';
            $kategori->max = '500';
            $kategori->save();


            return response()->json([
                'status' => 200,
                'message' => 'Museum di tambahkan',
            ]);
        }
    }
}
