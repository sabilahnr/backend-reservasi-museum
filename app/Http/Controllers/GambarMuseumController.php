<?php

namespace App\Http\Controllers;

use App\Models\GambarMuseum;
use App\Http\Requests\StoreGambarMuseumRequest;
use App\Http\Requests\UpdateGambarMuseumRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GambarMuseumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGambarMuseumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function  upload(Request $request, $museumId) {
        $imagesName = [];
        $response = [];


        // return response()->json([
        //     'status'=> $request->all(),
        // ]);
 
        $validator = Validator::make($request->all(),
            [
                'images' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );
 
        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()]);
        }
 
        if($request->has('images')) {
            foreach($request->file('images') as $image) {
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);
 
                GambarMuseum::create([
                    'id_museum' => $museumId,
                    'nama_gambar' => $filename
                ]);
            }
 
            $response["status"] = "successs";
            $response["message"] = "Success! image(s) uploaded";
        }
 
        else {
            $response["status"] = "failed";
            $response["message"] = "Failed! image(s) not uploaded";
        }
        return response()->json($response);
        // $images = DB::table('gambar_museums')->get() ;
        // return response()->json(["status" => "success","data" => $images]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GambarMuseum  $gambarMuseum
     * @return \Illuminate\Http\Response
     */
    public function show(GambarMuseum $gambarMuseum,$museumId)
    {
        $images = GambarMuseum::where('id_museum',$museumId)->get();
        return response()->json(["status" => "success","data" => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambarMuseum  $gambarMuseum
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarMuseum $gambarMuseum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGambarMuseumRequest  $request
     * @param  \App\Models\GambarMuseum  $gambarMuseum
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGambarMuseumRequest $request, GambarMuseum $gambarMuseum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambarMuseum  $gambarMuseum
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambarMuseum $gambarMuseum,$idGambar)
    {
        $images = GambarMuseum::where('idGambar',$idGambar)->get();
        $images->delete();
        
        return response()->json(["status" => 200 ,"msg" => "Berhasil"]);

    }
}
