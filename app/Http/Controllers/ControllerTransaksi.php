<?php

namespace App\Http\Controllers;

use ZerosDev\TriPay\Client;
use ZerosDev\TriPay\Support\Constant;
use ZerosDev\TriPay\Support\Helper;
use ZerosDev\TriPay\Transaction;
use ZerosDev\TriPay\Merchant;
use ZerosDev\TriPay\Callback;
use Illuminate\Http\Request;
use App\Models\transaksi;


class ControllerTransaksi extends Controller
{
    public function callback(Request $request)
    {
        // $init = $this->tripay->initCallback();
        // $result = $init->getJson();
        
        // return response() -> json($result);
        
        $callback = new Callback($this->tripay);
        $data = $callback->data();
        
        if($request->header("X-Callback-Event") != "payment_status"){
            die("akses dilarang");
        }
        
        $transaksi = transaksi::where('invoice', $data->merchant_ref)->first();
        
        if($transaksi){
            if($data->status == "PAID"){
                $transaksi->status = "PAID";
            }
            
            $transaksi->status = $request->status;
            
            $transaksi->update();
            
            return response()->json($transaksi);
        }
        
            return response()->json(['message' => 'transaksi tidak ada']);
        
        
    }

    public function transaksi_proses(Request $request)
    {
        
        $request=$request->all();
        // return response()->json([
        //     'status'=> 200,
        //     'message'=>$request['nama'],
        // ]);
        
        
        $nama = $request['nama'];
        $email = $request['email'];
        $museum = $request['museum'];
        $kategori = $request['kategori'];
        $phone = $request['phone'];
        $kota = $request['kota'];
        $harga_awal = $request['harga_awal'];
        $metode = $request['metode'];
        
        $transaksi = new transaksi;
        $transaksi-> nama =  $nama;
        $transaksi-> museum = $museum;
        $transaksi-> kategori = $kategori;
        $transaksi-> phone = $phone;
        $transaksi-> kota = $kota;
        $transaksi-> harga_awal = $harga_awal;
        $transaksi-> invoice ="donasi_".rand(20,200);
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
}
