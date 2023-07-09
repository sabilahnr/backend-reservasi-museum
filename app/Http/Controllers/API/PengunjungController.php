<?php

namespace App\Http\Controllers\API;

use App\Exports\PemasukanExport;
use App\Models\harga;
use App\Models\museum;
use App\Models\kategori;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use App\Exports\PengunjungExport;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmationEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\ApiException;

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
        'museum'=>'required|max:191',
        'kategori'=>'required|max:191',
        'tanggal'=>'required|max:191',       
         
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
        $pengunjung->email = $request->input('email'); 
        $pengunjung->harga_awal = $request->input('harga_awal');
        $pengunjung->pembayaran = $request->input('pembayaran'); 
        $pengunjung->status = $request->input('status'); 
        $pengunjung->save();

        
        $kode_awal = preg_split("/\s+/", $request->museum);
        $id_musuem = DB::table('museum')->where('nama_museum', $request->museum)->first()->id;
        $hasil = "";


        foreach ($kode_awal as $w) {
            $hasil .= mb_substr($w, 0, 1);
        }
        $pengunjung->kode_tiket = $hasil."-".$id_musuem."-".$request->tanggal."-".$pengunjung->id  ;
        $pengunjung->save();

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

    $to = [
        [
            'email' => $request->input('email'),
            'name' => $request->input('nama'),
        ]
    ];

    $sendSmtpEmail = new SendSmtpEmail();
    $sendSmtpEmail->setTo($to);
    $sendSmtpEmail->setSender(new SendSmtpEmailSender(["name" => "UPT Museum Surakarta", "email" => "samuelsteven@student.uns.ac.id"]));
    $sendSmtpEmail->setSubject("Berhasil melakukan Reservasi Tiket Museum");
    $sendSmtpEmail->setHtmlContent("
        Hallo, {$request->input('nama')}!<br><br>
        Anda berhasil melakukan reservasi tiket museum di {$request->input('museum')}!<br><br>
        Informasi lengkap:<br>
            Nama = {$request->input('nama')} <br>
            Kota = {$request->input('kota')} <br>
            Nomor HP = {$request->input('phone')} <br>
            Jumlah Pengunjung = {$request->input('jumlah')} <br>
            Museum = {$request->input('museum')} <br>
            Kategori = {$request->input('kategori')} <br>
            Tanggal = {$request->input('tanggal')} <br>
            Email = {$request->input('email')} <br>
            Harga = {$request->input('harga_awal')}<br>
            Pembayaran = {$request->input('pembayaran')} <br><br>
        Terima kasih atas reservasi anda. Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT dukungan kami.<br><br>
        Kode TIket anda adalah Anda: {$pengunjung->kode_tiket}<br><br>
        UPT Museum Surakarta
    ");

    try {
        $apiInstance->sendTransacEmail($sendSmtpEmail);
    }catch (ApiException $e) {
        // Penanganan kesalahan jika gagal mengirim email
        return response()->json([
            'status' => 'gagal',
            'message' => $e->getMessage()
        ]);
    }


        
        // $userEmail = $request->input('email');
        // $confirmationEmail = new ConfirmationEmail($userData);

        // Mail1::to($userEmail)->send($confirmationEmail);

        return response()->json([
            'status' => 200,
            'kode_tiket' => $pengunjung->kode_tiket,
            'message' => "Berhasil",
        ]);
    }

    public function show()
    {
        // $user = User::where('id' , Auth::id())->first();
        // $user->getRoleNames();
        
       
        $pengunjung = Pengunjung::all();

        return response()->json([
            'status'=> 200,
            'pengunjung'=>$pengunjung,
        ]);
    }

    public function show_pemasukan()
    {
        // $pemasukan = Pengunjung::all();
                    
        $pemasukan =  DB::table('pengunjung')->where('status','Lunas')->get();
                    
        return response()->json([
            'status'=> 200,
            'pemasukan'=>$pemasukan,
        ]);
    }

    public function showKonfirmasi()
    {
        // $tiket = Pengunjung::all();
        $tiket =  DB::table('pengunjung')->where('status','Hadir')->get();
        return response()->json([
            'status'=> 200,
            'pengunjung'=>$tiket,
        ]);
    }

    public function showStatus()
    {
        $pengunjung = Pengunjung::all();
        $tiket = Pengunjung::select('pengunjung.*','tikets.kode_tiket')
                            // ->where('pengunjung.kehadiran', null)
                            ->join('tikets','tikets.id_pengunjung','=','pengunjung.id')
                            ->get();
        return response()->json([
            'status'=> 200,
            'pengunjung'=>$pengunjung,
        ]);
    }

    public function show_ticket($kode)
    {

        $tiket =  Pengunjung::where('kode_tiket',$kode)->get();
        if($tiket->isEmpty())
        {
            $no_hp = DB::table('pengunjung')->where('phone',$kode)->get();
            
            if($no_hp)
            {

                return response()->json([
                    'status'=> 200,
                    'data'=>$no_hp,
                    ]);
            }
            else
            {
                return response()->json([
                    'status'=> 200,
                    'msg'=>'Nomor atau kode tiket tidak ada ',
                    ]);
            }
        }
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

        $data = kategori::select('kategori.*','museum.nama_museum')
                        ->where('kategori.id', $id_category)
                        ->join('museum','museum.id','=','kategori.id_museum')
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
        $dataPengunjung->tanggal_kehadiran =  Carbon::now(); 
        $dataPengunjung->kehadiran = "Hadir";
        $dataPengunjung->update();

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
        $dataPengunjung->tanggal_pembayaran =  Carbon::now(); 
        $dataPengunjung->update();

    
        
        return response()->json([
            'status'=> 200,
            'message'=>'Pembayaran Pengunjung Berhasil',
        ]);
    }

    // public function PengunjungExport()
    // {
    //     return Excel::download(new PengunjungExport, 'pengunjung.xlsx');  
    // }

    public function PengunjungExport(Request $request)
    {
        $museumName = $request->input('nama_museum');
        $startDate = $request->input('start_date', Carbon::now()->subMonth());
        $endDate = $request->input('end_date', Carbon::now()); 
        
        
    
        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();
        
        if ($museumName) {

            // Inisialisasi objek export dengan filter nama museum dan range waktu
            $export = new PengunjungExport($museumName, $startDateTime, $endDateTime);
        } else {
   
            // Inisialisasi objek export tanpa filter nama museum, namun dengan range waktu
            $export = new PengunjungExport(null, $startDateTime, $endDateTime);
        }
    
        // $export = new PemasukanExport($museumName, $startDateTime, $endDateTime);
    
        return Excel::download($export, 'pengunjung.xlsx');
    }

    public function pemasukanExport(Request $request)
    {
        $museumName = $request->input('nama_museum');
        $startDate = $request->input('start_date', Carbon::now()->subMonth());
        $endDate = $request->input('end_date', Carbon::now());
    
        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();

        if ($museumName) {

            // Inisialisasi objek export dengan filter nama museum dan range waktu
            $export = new PemasukanExport($museumName, $startDateTime, $endDateTime);
        } else {
   
            // Inisialisasi objek export tanpa filter nama museum, namun dengan range waktu
            $export = new PemasukanExport(null, $startDateTime, $endDateTime);
        }
        
        return Excel::download($export, 'pengunjung.xlsx');
    
    }
    
}
