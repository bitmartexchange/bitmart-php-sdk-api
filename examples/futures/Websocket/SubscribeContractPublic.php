<?php

use BitMart\Websocket\Futures\WsContractPub;
include_once __DIR__ . '/../../../vendor/autoload.php';
$ws = new WsContractPub([
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
        'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);
// Subscribe Public Channels
$ws->send('{"action":"subscribe","args":["futures/ticker"]}');
$ws->send('{"action":"subscribe","args":["futures/depth20:BTCUSDT"]}');
$ws->send('{"action":"subscribe","args":["futures/trade:BTCUSDT"]}');
$ws->send('{"action":"subscribe","args":["futures/klineBin1m:BTCUSDT"]}');


