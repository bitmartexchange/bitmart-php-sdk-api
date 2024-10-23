<?php

use BitMart\Websocket\Spot\WsSpotPrv;
require_once __DIR__ . '/../../../vendor/autoload.php';
// Create Spot Websocket Client
$ws = new WsSpotPrv([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
    'callback' => function ($data) {
        echo "-------------------------" . PHP_EOL;
        print_r($data);
    },
]);
// Login
$ws->login();

// Subscribe Private Channels
$ws->send('{"op": "subscribe", "args": ["spot/user/balance:BALANCE_UPDATE"]}');

$ws->send('{"op": "subscribe", "args": ["spot/user/order:BTC_USDT"]}');

