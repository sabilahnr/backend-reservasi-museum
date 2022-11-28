<?php

namespace App\Http\Controllers;

use App\Models\Panduan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanduanController extends Controller
{
    /**
     * Fetch images
     * @param NA
     * @return JSON response
     */
    public function index() {
        $images = Panduan::all();
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
 
        $validator = Validator::make($request->all(),
            [
                'images' => 'required',
                'images.*' => 'required|mimes:pdf'
            ]
        );
 
        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()]);
        }
 
        if($request->has('images')) {
            foreach($request->file('images') as $image) {
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);
 
                Panduan::create([
                    'panduan_name' => $filename
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
}
