<?php

namespace App\Service;

use GuzzleHttp\Client;

class CapiService
{
    public $content;

    public function __construct(Client $client)
    {
        $response = $client->get('https://tw.rter.info/capi.php');
        $body = $response->getBody();
        $this->content = json_decode($body->getContents(), true);
    }

    public function getCurrency($code)
    {
        if (isset($this->content['USD'.$code])) {
            return ['currency' => $this->content['USD'.$code]['Exrate']];
        } else {
            return ['error' => '請輸入正確貨幣代碼'];
        }
    }
}
