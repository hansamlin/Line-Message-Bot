<?php

namespace App\Http\Controllers;

use App\Service\CapiService;
use App\Service\GoldService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class ReplyController extends Controller
{
    public function reply(Request $request, GoldService $gold, CapiService $capi)
    {
        Log::channel('getLineMessage')->info($request);

        $text = 'twd';
        foreach ($request['events'] as $item) {
            $replyToken = $item['replyToken'];
            $text = $item['message']['text'];
        }

        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

        if ($text == '黃金' or strtolower($text) == 'gold') {
            $replyMessage = $gold->getImage();
        } else {
            $replyMessage = $capi->getCurrency(strtoupper($text));
        }
        $response = $bot->replyMessage($replyToken, $replyMessage);

        if ($response->isSucceeded()) {
            Log::channel('getLineMessage')->info('result:Succeeded');
        } else {
            Log::channel('getLineMessage')->error('result:'.$response->getHTTPStatus().' '.$response->getRawBody());
        }
    }
}
