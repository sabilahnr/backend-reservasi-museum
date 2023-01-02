<?php

namespace App\Http\Controllers\API;

use App\Models\harga;
use App\Models\museum;
use App\Models\kategori;
use App\Models\Pengunjung;
use App\Models\tikets;
use Database\Seeders\tiket;
use Illuminate\Http\Request;
use App\Exports\PengunjungExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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
        // 'foto.*'=>'nullable|mimes:application/pdf',
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

        $kode_awal = preg_split("/\s+/", $request->museum);;
        $id_musuem = DB::table('museum')->where('nama_museum', $request->museum)->first()->id;
        $id_kategori = DB::table('kategori')->where('nama_kategori', $request->kategori)->first()->id;
        $hasil = "";

        foreach ($kode_awal as $w) {
            $hasil .= mb_substr($w, 0, 1);
        }
        
        $kodetiket = new tikets;
        $kodetiket->kode_tiket = $hasil."-".$id_musuem.$id_kategori."-".$request->jumlah."-".$request->tanggal."-".$pengunjung->id  ;
        $kodetiket->id_pengunjung = $pengunjung->id ;
        $kodetiket->museum = $request->input('museum'); 
        $kodetiket->kategori = $request->input('kategori');
        $kodetiket->jumlah = $request->input('jumlah'); 
        $kodetiket->tanggal = $request->input('tanggal'); 
        $kodetiket->nama = $request->input('nama');
        $kodetiket->harga = $request->input('harga_awal');
        $kodetiket->save();


        
        
        return response()->json([
            'status' => 200,
            'kode_tiket' => $kodetiket->kode_tiket,
            'message' => "Berhasil",
        ]);
    }

    public function show()
    {
        $pengunjung = Pengunjung::select('pengunjung.*','tikets.kode_tiket')
                                ->join('tikets','tikets.id_pengunjung','=','pengunjung.id')
                                ->get();
        return response()->json([
            'status'=> 200,
            'pengunjung'=>$pengunjung,
        ]);
    }

    public function show_pemasukan()
    {
        $pemasukan = Pengunjung::select('pengunjung.*','users.name')
                    ->join('users','users.id','=','pengunjung.id_admin')
                    ->where('status', 'Lunas')
                    ->get();
                    
        // $pemasukan? = Pengunjung::where('status', 1)->get();
        return response()->json([
            'status'=> 200,
            'pemasukan'=>$pemasukan,
        ]);
    }

    public function showKonfirmasi()
    {
        // $pengunjung = Pengunjung::where('kehadiran', null)->get();
        $tiket = Pengunjung::select('pengunjung.*','tikets.kode_tiket')
                            ->where('pengunjung.kehadiran', null)
                            ->join('tikets','tikets.id_pengunjung','=','pengunjung.id')
                            ->get();



        return response()->json([
            'status'=> 200,
            'pengunjung'=>$tiket,
        ]);
    }

    public function showStatus()
    {
        $pengunjung = Pengunjung::select('pengunjung.*','tikets.kode_tiket')
                                ->where('pengunjung.status', 'belum lunas')
                                ->join('tikets','tikets.id_pengunjung','=','pengunjung.id')
                                ->get();
        return response()->json([
            'status'=> 200,
            'pengunjung'=>$pengunjung,
        ]);
    }

    public function show_ticket($kode)
    {
       $tiket =  DB::table('tikets')->where('kode_tiket',$kode)->first();
       return response()->json([
        'status'=> 200,
        'data'=>$tiket,
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
        $dataPengunjung->kehadiran = "Hadir";
        $dataPengunjung->update();

        $tiket = tikets::where('id_pengunjung', '=', $request->idData)->first();
        $tiket->kehadiran= "Hadir";
        $tiket->update();

    
        
        return response()->json([
            'status'=> 200,
            'message'=>'Berhasil Konfirmasi Pengunjung',
        ]);
    }

    public function status(Request $request)
    {
        $dataPengunjung = Pengunjung::find($request->input('idData'));

        $dataPengunjung->id_admin=$request->input('idAdmin');
        $dataPengunjung->status = "Lunas";
        $dataPengunjung->update();

        
        // $tiket = DB::table('tikets')->where('id_pengunjung',$request->idData)->limit(1);
        $tiket = tikets::where('id_pengunjung', '=', $request->idData)->first();
        $tiket->status= "Lunas";
        $tiket->update();
    
        
        return response()->json([
            'status'=> 200,
            'message'=>'Pembayaran Pengunjung Berhasil',
        ]);
    }

    public function PengunjungExport()
    {
        

        return Excel::download(new PengunjungExport, 'pengunjung.xlsx');
        // return [
        //     (new DownloadExcel)->withFilename('users-' . time() . '.xlsx'),
        // ];
    }
}
