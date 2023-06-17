<?php

namespace BitMart\Tests;


use BitMart\Websocket\Spot\WsSpotPrv;

include_once __DIR__ . '/../../../../vendor/autoload.php';

// Cli Run: php tests/BitMart/Websocket/Spot/WsSpotPrvTest.php start
$cloudPrivateWebsocket = new WsSpotPrv(
   [
       'accessKey' => "your_api_key",
       'secretKey' => "your_secret_key",
       'memo' =>  "your_memo",
       'xdebug' => true
   ]
);


// Subscribe Private Channels
$cloudPrivateWebsocket->subscribe(
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