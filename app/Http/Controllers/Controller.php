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
        $apiKey = 'DEV-65GkYUdqsUOkMlA0OUVaodmoXOjD0LdQEaGgeCrO';
        $privateKey = '7RfDh-1amAs-dPUw4-P2YGL-A8nH8';
        $mode = Constant::MODE_DEVELOPMENT;
        $client = new Client($merchantCode, $apiKey, $privateKey, $mode);
        $this->tripay = new Merchant ($client);
    }

}
