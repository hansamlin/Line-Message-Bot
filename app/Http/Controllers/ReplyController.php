<?php

namespace App\Http\Controllers;

use App\Service\CapiService;
use Illuminate\Http\Request;
use App\Service\Reply;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Service\CapiService $capi
     * @return void
     * @throws \ReflectionException
     */
    public function store(Request $request, CapiService $capi)
    {
        Log::channel('getLineMessage')->info($request);

        foreach ($request['events'] as $item) {
            $replyToken = $item['replyToken'];
            $code = strtoupper($item['message']['text']);
        }

        $result = $capi->get($code);

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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
