<?php

namespace App\Http\Controllers;

use App\Models\museum;
use App\Models\Pengunjung;
use App\Models\tikets;
use ZerosDev\TriPay\Client;
use ZerosDev\TriPay\Support\Constant;
use ZerosDev\TriPay\Support\Helper;
use ZerosDev\TriPay\Transaction;
use ZerosDev\TriPay\Merchant;
use ZerosDev\TriPay\Callback;
use Illuminate\Http\Request;
use App\Models\transaksi;
use Database\Seeders\tiket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use GuzzleHttp\Client as CLIENGUZ;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\ApiException;

class ControllerTransaksi extends Controller
{
    // public function callback(Request $request)
    // {
        
    //     $callback = new Callback($this->tripay);
    //     $data = $callback->data();
        
    //     if($request->header("X-Callback-Event") != "payment_status"){
    //         die("akses dilarang");
    //     }
        
    //     $transaksi = transaksi::where('invoice', $data->merchant_ref)->first();
        
    //      return response()->json($data->merchant_ref);
    //     if($transaksi){
    //         if($data->status == "PAID"){
    //             $transaksi->status = "PAID";
    //         }
            
    //         $transaksi->status = $request->status;
            
    //         $transaksi->update();
            
    //         return response()->json($transaksi);
    //     }
        
    //         return response()->json(['message' => 'transaksi tidak ada']);
        
        
    // }

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
        $pengunjung->pembayaran = 'non-tunai'; 
        $pengunjung->status = 'belom lunas'; 
        $pengunjung->save();

        
        $kode_awal = preg_split("/\s+/", $request->museum);
        $id_musuem = DB::table('museum')->where('nama_museum', $request->museum)->first()->id;
        $hasil = "";


        foreach ($kode_awal as $w) {
            $hasil .= mb_substr($w, 0, 1);
        }
        $pengunjung->kode_tiket = $hasil."-".$id_musuem."-".$request->tanggal."-".$pengunjung->id  ;
        $pengunjung->save();

        $transaksi = new transaksi();
        $transaksi-> nama =  $nama;
        $transaksi-> id_museum = $pengunjung->id ;
        $transaksi-> kategori = $kategori;
        $transaksi-> phone = $phone;
        $transaksi-> kota = $kota;
        $transaksi-> harga_awal = $harga_awal;
        $transaksi-> invoice ="pembayaran_".rand(20,200);
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
            $pengunjung = Pengunjung::find($invoice->id_museum);
            
             

            if (! $invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $invoiceId,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $invoice->update(['status' => 'Lunas']);
                    $pengunjung->update(['status' => 'Lunas']);

                  
                    $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
                    $apiInstance = new TransactionalEmailsApi(new CLIENGUZ(), $config);


                $to = [
                    [
                        'email' => $pengunjung->email,
                        'name' => $pengunjung->nama,
                    ]
                ];

                $sendSmtpEmail = new SendSmtpEmail();
                $sendSmtpEmail->setTo($to);
                $sendSmtpEmail->setSender(new SendSmtpEmailSender(["name" => "UPT Museum Surakarta", "email" => "samuelsteven@student.uns.ac.id"]));
                $sendSmtpEmail->setSubject("Berhasil melakukan Reservasi Tiket Museum");
                $sendSmtpEmail->setHtmlContent("
                    Hallo, {$pengunjung->nama}!<br><br>
                    Anda berhasil melakukan reservasi tiket museum di {$pengunjung->museum}!<br><br>
                    Informasi lengkap:<br>
                        nama = {$pengunjung->nama} <br>
                        kota = {$pengunjung->kota} <br>
                        phone = {$pengunjung->phone} <br>
                        jumlah = {$pengunjung->jumlah} <br>
                        museum = {$pengunjung->museum} <br>
                        kategori = {$pengunjung->kategori} <br>
                        tanggal = {$pengunjung->tanggal} <br>
                        email = {$pengunjung->email} <br>
                        harga_awal = {$pengunjung->harga_awal}<br>
                        pembayaran = {$pengunjung->pembayaran} <br><br>
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
