<?php

namespace App\Service;

use GuzzleHttp\Client;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class CodeService
{
    public $code;

    public function __construct()
    {
        $client = new Client();
        $response = $client->get('https://developers.google.com/adsense/host/appendix/currencies?hl=zh-tw');
        $body = $response->getBody()->getContents();
        preg_match("/<\/p>\s<table>(.+)<\/table>/i", $body, $table);
        preg_match_all("/<tr><td>.+?<\/td><\/tr>/i", $table[1], $tr);
        $code = '';
        foreach ($tr[0] as $item) {
            preg_match_all("/<td>(.+?)<\/td>/", $item, $list);
            $code .= $list[1][0].' => '.$list[1][1]."\r\n";
        }
        $this->code = new TextMessageBuilder($code);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function isGold()
    {
        return ['黃金', 'gold'];
    }

    public function isCode()
    {
        return ['list', '清單', '對照表'];
    }
}
