<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Fetch images
     * @param NA
     * @return JSON response
     */
    public function index() {
        $images = Slider::all();
        return response()->json(["status" => "success", "count" => count($images), "data" => $images]);
    }

    /**
     * Upload Image
     * @param $request
     * @return JSON response
     */
    public function upload(Request $request) {
        $imagesName = [];
        $response = [];

        // return response()->json([
        //     'status'=> $request->all(),
        // ]);
 
        $validator = Validator::make($request->all(),
            [
                'images' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]
        );
 
        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Upload Gambar Tidak Berhasil", "Gagal" => $validator->errors()]);
        }
 
        if($request->has('images')) {
            foreach($request->file('images') as $image) {
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);
 
                Slider::create([
                    'slider_name' => $filename
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
    }

    public function destroy($id)
    {
        $files = Slider::find($id);
        if($files)
        {
            $files->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Berhasil Delete File',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Data ID Found',
            ]);
        }
    }
}
