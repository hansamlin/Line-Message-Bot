<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 * test code
 */
Route::get('test', function (Request $request) {
    //echo phpinfo();
    //$client = new Client();
    //$response = $client->get('https://tw.rter.info/capi.php');
    //    //
    //    //$body = $response->getBody();
    //    //$content = $body->getContents();
    //    //dump(json_decode($content, true));

});

Route::post('reply', 'ReplyController@reply');
