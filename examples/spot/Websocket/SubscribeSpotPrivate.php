<?php

use BitMart\Websocket\Spot\WsSpotPrv;

require_once __DIR__ . '/../../../vendor/autoload.php';

$ws = new WsSpotPrv([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
    'xdebug' => false
]);

// Subscribe Private Channels
$ws->subscribe(
    [
        'op' => "subscribe",
        'args' => [
            // Only Support Private Channel
            "spot/user/order:BTC_USDT",
        ]
    ]       ,
    function ($data) {
        echo "-------------------------" . PHP_EOL;
        print_r($data);
    }
);
