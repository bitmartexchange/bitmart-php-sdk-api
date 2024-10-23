<?php

use BitMart\Websocket\Futures\WsContractPrv;
include_once __DIR__ . '/../../../vendor/autoload.php';
$ws = new WsContractPrv([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
    'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);
// Login
$ws->login();

// Subscribe Private Channels
$ws->send('{
    "action": "subscribe",
    "args":["futures/asset:USDT", "futures/asset:BTC", "futures/asset:ETH"]
}');