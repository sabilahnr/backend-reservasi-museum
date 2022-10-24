<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\harga;
use App\Models\kategori;
use App\Models\museum;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengunjungController extends Controller
{
   public function validasi(Request $request)
   {
    $validator = Validator::make($request->all(),[
        'nama'=>'required|max:191',
        'kota'=>'required|max:191',
        'negara'=>'nullable|max:191',
        'phone'=>'required|min:10|max:13',
        'jumlah'=>'required|max:191',
        'foto.*'=>'nullable|mimes:application/pdf',
        // 'harga_awal'=>'required|max:191',
        // 'potongan_harga'=>'required|max:191',
        // 'harga_akhir'=>'required|max:191',
        'museum'=>'required|max:191',
        'kategori'=>'required|max:191',
        'tanggal'=>'required|max:191',       
        'attachment.*'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        // 'pembayaran'=>'required|max:191',
    ],[
        'nama.required' => 'Kolom nama wajib diisi',
        'kota.required' => 'Kolom kota wajib diisi',
        'phone.required' => 'Kolom phone wajib diisi',
        'jumlah.required' => 'Kolom jumlah wajib diisi',
        // 'foto.required' => 'Kolom Foto wajib diisi',
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

    // return response()->json([
    //             'status'=> 200,
    //             'foto'=>$request->get('foto'),
    //         ]);


   }
    public function store(Request $request)
    {  



        $pengunjung = new Pengunjung;
        $pengunjung->nama = $request->input('nama'); 
        $pengunjung->kota = $request->input('kota'); 
        $pengunjung->phone = $request->input('phone'); 
        $pengunjung->jumlah = $request->input('jumlah'); 
        $pengunjung->museum = $request->input('museum'); 
        $pengunjung->kategori = $request->input('kategori'); 
        $pengunjung->tanggal = $request->input('tanggal'); 
        $pengunjung->attachment = $request->input('foto'); 
        $pengunjung->harga_awal = $request->input('harga_awal');
        $pengunjung->pembayaran = $request->input('pembayaran'); 
        $pengunjung->status = $request->input('status'); 
        $pengunjung->save();

        
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data pengunjung'
        ]);
    }

    public function show()
    {
        $pengunjung = Pengunjung::all();
        return response()->json([
            'status'=> 200,
            'pengunjung'=>$pengunjung,
        ]);
    }

    public function showKonfirmasi()
    {
        $pengunjung = Pengunjung::where('status', 1)->get();
        return response()->json([
            'status'=> 200,
            'pengunjung'=>$pengunjung,
        ]);
    }

    public function show_data($id_category)
    {

        // $harga = harga::with('kategori')
        //                 ->where('id_kategori',$id_category)
        //                 ->get();

        $data = harga::select('harga.*','museum.nama_museum','kategori.nama_kategori','kategori.min','kategori.max')
                        ->where('id_kategori', $id_category)
                        ->join('museum','museum.id','=','harga.id_museum')
                        ->join('kategori','kategori.id','=','harga.id_kategori')
                        ->get();
    
    
        if($data){
            return response()->json([
                'status'=> 200,
                'data'=>$data,
                ]);
        }else{
            return response()->json([
                'status'=> 300,
                'message'=>'ga ada',
                ]);
        }
    
    }

    public function kehadiran(Request $request)
    {
        $dataPengunjung = Pengunjung::find($request->input('idData'));

        $dataPengunjung->id_admin=$request->input('idAdmin');
        $dataPengunjung->status='Lunas';
        $dataPengunjung->update();
    
        
        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Konfirmasi Pengunjung',
        ]);
    }
}
