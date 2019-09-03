<?php

namespace App\Http\Controllers;

use App\Service\CapiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class ReplyController extends Controller
{
    public function reply(Request $request, CapiService $capi) {
        Log::channel('getLineMessage')->info($request);

        foreach ($request['events'] as $item) {
            $replyToken = $item['replyToken'];
            $code = strtoupper($item['message']['text']);
        }

        $result = $capi->getCurrency($code);

        if (isset($result['error'])) {
            $replyText = $result['error'];
        } else {
            $replyText = $result['currency'].' '.$code;
        }

        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

        $response = $bot->replyText($replyToken, $replyText);

        if ($response->isSucceeded()) {
            Log::channel('getLineMessage')->info('result:Succeeded');
        } else {
            Log::channel('getLineMessage')->error('result:'.$response->getHTTPStatus().' '.$response->getRawBody());
        }
    }
}
