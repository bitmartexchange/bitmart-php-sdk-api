<?php
use BitMart\Websocket\Spot\WsSpotPub;

require_once __DIR__ . '/../../../vendor/autoload.php';

$ws = new WsSpotPub();


// Subscribe Public Channels
$ws->subscribe(
    [
        'op' => "subscribe",
        'args' => [
            // Only Support Public Channel
            "spot/ticker:BTC_USDT",
        ]
    ],
    function ($data) {
        echo "-------------------------" . PHP_EOL;
        echo print_r($data);
    }
);
