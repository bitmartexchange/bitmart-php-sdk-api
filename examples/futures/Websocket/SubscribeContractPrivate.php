<?php

use BitMart\Websocket\Futures\WsContractPrv;

include_once __DIR__ . '/../../../vendor/autoload.php';


$ws = new WsContractPrv([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]);


// Subscribe Public Channels
$ws->subscribe(
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
