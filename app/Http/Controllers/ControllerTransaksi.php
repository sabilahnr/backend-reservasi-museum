<?php

namespace App\Http\Controllers;

use App\Exports\PemasukanExport;
use App\Exports\PengunjungExport;
use App\Models\kategori;
use App\Models\museum;
use App\Models\tikets;
use ZerosDev\TriPay\Client;
use ZerosDev\TriPay\Support\Constant;
use ZerosDev\TriPay\Support\Helper;
use ZerosDev\TriPay\Transaction;
use ZerosDev\TriPay\Merchant;
use ZerosDev\TriPay\Callback;
use Illuminate\Http\Request;
use App\Models\transaksi;
use Carbon\Carbon;
use Database\Seeders\tiket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use GuzzleHttp\Client as CLIENGUZ;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\ApiException;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ControllerTransaksi extends Controller
{

    public function validasi(Request $request)
   {
    $validator = Validator::make($request->all(),[
        'nama'=>'required|max:191',
        'kota'=>'required|max:191',
        'negara'=>'nullable|max:191',
        'phone'=>'required|min:10|max:13',
        'jumlah'=>'required|max:191',
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

        $transaksi = new transaksi();
        $transaksi->nama = $request->input('nama'); 
        $transaksi->id_kategori = $request->input('id_kategori'); 
        $transaksi->phone = $request->input('phone'); 
        $transaksi->kota = $request->input('kota'); 
        $transaksi->jumlah = $request->input('jumlah'); 
        $transaksi->total_harga = $request->input('total_harga');
        $transaksi->tanggal = $request->input('tanggal'); 
        $transaksi->email = $request->input('email'); 
        $transaksi->pembayaran = $request->input('pembayaran'); 
        if($request->input('harga_awal') == 0) {
            $transaksi->tanggal_pembayaran = Carbon::now();
        }
        $transaksi->status = $request->input('status'); 
        $transaksi->save();

        $museum =  DB::table('museum')->find($request->input('id_kategori'));
        
        $kode_awal = preg_split("/\s+/", $museum->nama_museum);
        $id_musuem = $museum->id;
        $hasil = "";


        foreach ($kode_awal as $w) {
            $hasil .= mb_substr($w, 0, 1);
        }
        $transaksi->kode_tiket = $hasil."-".$id_musuem.$request->input('id_kategori').$request->jumlah."-".str_replace("-", "", $request->tanggal)."-".$transaksi->id;
        $transaksi->save();

        $apiKey = $_ENV['SENDINBLUE_API_KEY'];

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
        $apiInstance = new TransactionalEmailsApi(new CLIENGUZ(), $config);

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
            Kode TIket anda adalah Anda: {$transaksi->kode_tiket}<br><br>
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
            'kode_tiket' => $transaksi->kode_tiket,
            'message' => "Berhasil",
        ]);
    }

    public function show()
    {
        // $user = User::where('id' , Auth::id())->first();
        // $user->getRoleNames();
        
       
        $transaksi = transaksi::with('kategori.museum')->get();

        return response()->json([
            'status'=> 200,
            'pengunjung'=>$transaksi,
        ]);
    }

    public function show_pemasukan()
{
    // $pemasukan = DB::table('transaksis')
    //                 ->join('kategori', 'transaksis.id_kategori', '=', 'kategori.id')
    //                 ->join('museum', 'kategori.id_museum', '=', 'museum.id')
    //                 ->where('status', 'Lunas')
    //                 ->where('total_harga', '<>', '0')
    //                 ->get();
    
    $pemasukan = transaksi::where('status', 'Lunas')
                    ->where('total_harga', '<>', '0')
                    ->get();

    return response()->json([
        'status' => 200,
        'pemasukan' => $pemasukan,
    ]);
}

    public function showKonfirmasi()
    {
        // $tiket = Pengunjung::all();
        $tiket =  DB::table('transaksis')->where('kehadiran','Hadir')->get();
        return response()->json([
            'status'=> 200,
            'pengunjung'=>$tiket,
        ]);
    }

    public function showStatus()
    {
        $transaksi =  DB::table('transaksis')->where('status','Lunas')->get();

        return response()->json([
            'status'=> 200,
            'pengunjung'=>$transaksi,
        ]);
    }

    public function show_ticket($kode)
    {

        $tiket =  transaksi::where('kode_tiket',$kode)->with('kategori.museum')->get();
        if($tiket->isEmpty())
        {
            $no_hp = DB::table('transaksis')->where('phone',$kode)->with('kategori.museum')->get();
            
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

        // $data = kategori::select('kategori.*','museum.nama_museum')
        //                 ->where('kategori.id', $id_category)
        //                 ->join('museum','museum.id','=','kategori.id_museum')
        //                 ->get();
    
        $data = kategori::with('museum')->get();
    
        if($data){
            return response()->json([
                'status'=> 200,
                'data'=>$data,
                ]);
        }else{
            return response()->json([
                'status'=> 300,
                'message'=>'tidak ada',
                ]);
        }
    
    }

    public function kehadiran(Request $request)
    {
        $dataPengunjung = transaksi::find($request->input('idData'));
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
        $dataPengunjung = transaksi::find($request->input('idData'));
        $dataPengunjung->id_admin=$request->input('idAdmin');
        $dataPengunjung->status = "Lunas";
        $dataPengunjung->tanggal_pembayaran =  Carbon::now(); 
        $dataPengunjung->update();

    
        
        return response()->json([
            'status'=> 200,
            'message'=>'Pembayaran Pengunjung Berhasil',
        ]);
    }


    public function PengunjungExport(Request $request)
    {
        $idMuseum = $request->input('nama_museum');
        $startDate = $request->input('start_date', Carbon::now()->subMonth());
        $endDate = $request->input('end_date', Carbon::now()); 
        
        
    
        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();
        
        if ($idMuseum) {

            // Inisialisasi objek export dengan filter nama museum dan range waktu
            $export = new PengunjungExport($idMuseum, $startDateTime, $endDateTime);
        } else {
   
            // Inisialisasi objek export tanpa filter nama museum, namun dengan range waktu
            $export = new PengunjungExport(null, $startDateTime, $endDateTime);
        }
    
        // $export = new PemasukanExport($museumName, $startDateTime, $endDateTime);
    
        return Excel::download($export, 'pengunjung.xlsx');
    }

    public function pemasukanExport(Request $request)
    {
        $idMuseum = $request->input('nama_museum');
        $startDate = $request->input('start_date', Carbon::now()->subMonth());
        $endDate = $request->input('end_date', Carbon::now());
    
        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();

        if ($idMuseum) {

            // Inisialisasi objek export dengan filter nama museum dan range waktu
            $export = new PemasukanExport($idMuseum, $startDateTime, $endDateTime);
        } else {
   
            // Inisialisasi objek export tanpa filter nama museum, namun dengan range waktu
            $export = new PemasukanExport(null, $startDateTime, $endDateTime);
        }
        
        return Excel::download($export, 'pengunjung.xlsx');
    
    }

    public function transaksi_proses(Request $request)
    {
        
        // $request=$request->all();
        
        $nama = $request['nama'];
        $email = $request['email'];
        $museum = $request['museum'];
        $kategori = $request['kategori'];
        $phone = $request['phone'];
        $kota = $request['kota'];
        $harga_awal = $request['harga_awal'];
        $metode = $request['metode'];

       

        $transaksi = new transaksi();
        $transaksi->nama = $request->input('nama'); 
        $transaksi->kota = $request->input('kota'); 
        $transaksi->phone = $request->input('phone'); 
        $transaksi->jumlah = $request->input('jumlah'); 
        $transaksi->id_kategori = $request->input('id_kategori'); 
        $transaksi->tanggal = $request->input('tanggal'); 
        $transaksi->email = $request->input('email'); 
        $transaksi->total_harga = $request->input('harga_awal');
        $transaksi->pembayaran = 'non-tunai'; 
        $transaksi->status = 'belom lunas'; 
        $transaksi-> invoice ="pembayaran_".rand(20,200);
        $transaksi->save();

        
        $kode_awal = preg_split("/\s+/", $request->museum);
        $id_musuem = DB::table('museum')->where('nama_museum', $request->museum)->first()->id;
        $hasil = "";


        foreach ($kode_awal as $w) {
            $hasil .= mb_substr($w, 0, 1);
        }
        $transaksi->kode_tiket = $hasil."-".$id_musuem.$request->input('id_kategori').$request->jumlah."-".str_replace("-", "", $request->tanggal)."-".$transaksi->id;
        $transaksi->save();

        
        $merchantRef = $transaksi->invoice;
        
        $merchantCode = 'T20488';
        $apiKey = 'DEV-QimuixpQfJWLFWGaZI5NHYRyWBam6aNinoNONy6r';
        $privateKey = '2kssQ-y2zKN-ZV1EG-iEq15-9iqgx';
        $mode = Constant::MODE_DEVELOPMENT;
        $guzzleOptions = [];
        
        $data = [
                    'method'         => $metode,
                    'merchant_ref'   => $merchantRef,
                    'amount'         => $harga_awal,
                    'customer_name'  => $nama,
                    'customer_email' => $email,
                    'customer_phone' => $phone,
                    'order_items'    => [
                        [
                            'sku'         => 'FB-06',
                            'name'        => $museum,
                            'price'       => $harga_awal,
                            'quantity'    => 1,
                        ]
                    ],
                    'return_url'   => 'https://museumsolo.com/',
                    'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                    'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$harga_awal, $privateKey)
                ];
        
        
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        
        return $response ? $response : $error ;
        
        // return response()->json($hasil);
        
        
    }
    
     public function metode()
    {
        $apiKey = 'DEV-QimuixpQfJWLFWGaZI5NHYRyWBam6aNinoNONy6r';

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_FRESH_CONNECT  => true,
          CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HEADER         => false,
          CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
          CURLOPT_FAILONERROR    => false,
          CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);

        
        return $response ? $response : $error ;
    }


    protected $privateKey = '2kssQ-y2zKN-ZV1EG-iEq15-9iqgx';

    public function callback(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $invoiceId = $data->merchant_ref;
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $invoice = transaksi::where('invoice', $data->merchant_ref)
                ->where('status', '=', 'pending')
                ->first();
                
                 
                

            // $pengunjung = Pengunjung::where('id',$invoice->id_museum);
            
             

            if (! $invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $invoiceId,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $invoice->update(['status' => 'Lunas']);

                  
                    $apiKey = $_ENV['SENDINBLUE_API_KEY'];

                    $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
                    $apiInstance = new TransactionalEmailsApi(new CLIENGUZ(), $config);



                $to = [
                    [
                        'email' => $invoice->email,
                        'name' => $invoice->nama,
                    ]
                ];

                $sendSmtpEmail = new SendSmtpEmail();
                $sendSmtpEmail->setTo($to);
                $sendSmtpEmail->setSender(new SendSmtpEmailSender(["name" => "UPT Museum Surakarta", "email" => "samuelsteven@student.uns.ac.id"]));
                $sendSmtpEmail->setSubject("Berhasil melakukan Reservasi Tiket Museum");
                $sendSmtpEmail->setHtmlContent("
                    Hallo, {$invoice->nama}!<br><br>
                    Anda berhasil melakukan reservasi tiket museum di {$invoice->museum}!<br><br>
                    Informasi lengkap:<br>
                        nama = {$invoice->nama} <br>
                        kota = {$invoice->kota} <br>
                        phone = {$invoice->phone} <br>
                        jumlah = {$invoice->jumlah} <br>
                        museum = {$invoice->museum} <br>
                        kategori = {$invoice->kategori} <br>
                        tanggal = {$invoice->tanggal} <br>
                        email = {$invoice->email} <br>
                        harga_awal = {$invoice->total_harga}<br>
                        pembayaran = {$invoice->pembayaran} <br><br>
                    Terima kasih atas reservasi anda. Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT dukungan kami.<br><br>
                    Kode TIket anda adalah Anda: {$invoice->kode_tiket}<br><br>
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

                    break;

                case 'EXPIRED':
                    $invoice->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $invoice->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }
    }



}
