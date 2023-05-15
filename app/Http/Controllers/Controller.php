<?php

namespace App\Http\Controllers;

use ZerosDev\TriPay\Client ;
use ZerosDev\TriPay\Merchant;
use ZerosDev\TriPay\Support\Constant;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $tripay;


    public function __construct()
    {
        $merchantCode = 'T20488';
        $apiKey = 'DEV-QimuixpQfJWLFWGaZI5NHYRyWBam6aNinoNONy6r';
        $privateKey = '2kssQ-y2zKN-ZV1EG-iEq15-9iqgx';
        $mode = Constant::MODE_DEVELOPMENT;
        $guzzleOptions = [];
        $client = new Client($merchantCode, $apiKey, $privateKey, $mode);
        // $this->tripay = new Merchant ($client);
        $this->tripay = $client;
    }

}
