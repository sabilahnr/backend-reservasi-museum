<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function show()
    {
        $dataFAQ = faq::all();
        return response()->json([
            'status'=> 200,
            'dataFAQ'=>$dataFAQ,
        ]);
    }

    public function edit_show($id_faq)
    {
        $faq = faq::find($id_faq);

        return response()->json([
            'status'=> 200,
            'faq'=> $faq,
        ]);
    }

    public function update(Request $request,$id_faq)
    {
        $faq = faq::find($id_faq);

        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        $faq->update();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Update FAQ',
        ]);
    }

    public function store(Request $request)
    {
        $faq = new faq();

        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        $faq->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Tambah FAQ',
        ]);
    }

    public function destroy($id_faq)
    {
        $faq = faq::find($id_faq);
        if($faq)
        {
            $faq->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Berhasil Delete FAQ',
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
