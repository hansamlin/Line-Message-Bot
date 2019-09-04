<?php

namespace App\Service;

use GuzzleHttp\Client;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class CapiService
{
    public $content;

    public function __construct()
    {
        $client = new Client();
        $response = $client->get('https://tw.rter.info/capi.php');
        $body = $response->getBody();
        $this->content = json_decode($body->getContents(), true);
    }

    public function getCurrency($code)
    {
        if (isset($this->content['USD'.$code])) {
            return new TextMessageBuilder($this->content['USD'.$code]['Exrate'], $code);
        } else {
            return new TextMessageBuilder('請輸入正確貨幣代碼');
        }
    }
}
