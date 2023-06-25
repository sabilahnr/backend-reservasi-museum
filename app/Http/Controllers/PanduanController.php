<?php

namespace App\Http\Controllers;

use App\Models\Panduan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PanduanController extends Controller
{
    /**
     * Fetch images
     * @param NA
     * @return JSON response
     */
    public function index() {
            $images = DB::table('panduans')->whereBetween('id',array(2,10))->get() ;
            return response()->json(["status" => "success","data" => $images]);
        
    }
    public function index_panduan($id) {
            $images = Panduan::find($id);
            return response()->json(["status" => "success", "data" => $images]);
        
    }

    /**
     * Upload Image
     * @param $request
     * @return JSON response
     */
    public function  upload(Request $request) {
        $imagesName = [];
        $response = []; 
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

    public function destroy($id)
    {
        $files = Panduan::find($id);
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


    public function update_panduan_text(Request $request)
    {

        $panduan = Panduan::find(1);
        $panduan->panduan_name = $request->input('panduan_name');
        $panduan->panduan_name_en = $request->input('panduan_name_en');
        $panduan->update();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil update panduan Text',
        ]);

    }

}
