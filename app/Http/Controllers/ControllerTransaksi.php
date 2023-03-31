<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerTransaksi extends Controller
{
    public function callback()
    {
        
    }

    public function transaksi_proses()
    {

    }

    public function metode()
    {
        $metode = $this->tripay->paymentChannels()->getBody()->getContents();

        return response()->json([
            'status'=> 200,
            'pemasukan'=>$metode,
        ]);
    }
}
