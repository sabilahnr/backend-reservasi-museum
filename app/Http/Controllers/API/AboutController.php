<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\about;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show($id_museum)
    {
        $dataAbout = about::where('id_museum',$id_museum)->first();
        // $satu = $dataAbout->museum;
        return response()->json([
            'status'=> 200,
            'dataAbout'=>$dataAbout,
        ]);
    }



    public function edit_show($id_about)
    {
        $about = about::find($id_about);

        return response()->json([
            'status'=> 200,
            'about'=> $about,
        ]);
    }

    public function update(Request $request,$id_about)
    {
        $about = about::find($id_about);

        $about->about = $request->input('about');
        $about->about_en = $request->input('about_en');
        $about->update();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Update About',
        ]);
    }

    public function store(Request $request)
    {
        $about = new about();

        $about->about = $request->input('about');
        $about->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Tambah About',
        ]);
    }

    public function destroy($id_about)
    {
        $about = about::find($id_about);
        if($about)
        {
            $about->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Berhasil Delete About',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Student ID Found',
            ]);
        }
    }
}
