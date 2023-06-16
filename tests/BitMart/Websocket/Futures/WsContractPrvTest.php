<?php

namespace BitMart\Tests;


use BitMart\Websocket\Futures\WsContractPrv;

include_once __DIR__ . '/../../../../vendor/autoload.php';

// Cli Run: php tests/BitMart/Websocket/Futures/WsContractPrvTest.php start
$cloudWebsocket = new WsContractPrv([
    'accessKey' => "your_api_key",
    'secretKey' => "your_secret_key",
    'memo' =>  "your_memo",
    'xdebug' => true
]);


// Subscribe Private Channels
$cloudWebsocket->subscribe(
    [
        'action' => "subscribe",
        'args' => [
            "futures/asset:USDT"
        ]
    ],
    function ($data) {
        echo "-------------------------" . PHP_EOL;
        echo print_r($data);
    }
);
