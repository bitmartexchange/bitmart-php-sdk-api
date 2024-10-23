<?php
use BitMart\Websocket\Spot\WsSpotPub;
require_once __DIR__ . '/../../../vendor/autoload.php';
// Create Spot Websocket Client
$ws = new WsSpotPub([
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
    'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);


// Subscribe Public Channels
$ws->send('{"op": "subscribe", "args": ["spot/ticker:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/kline1m:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/depth5:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/trade:BTC_USDT"]}');
