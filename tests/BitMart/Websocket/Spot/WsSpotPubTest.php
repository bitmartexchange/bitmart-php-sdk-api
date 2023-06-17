<?php

namespace BitMart\Tests;


use BitMart\Websocket\Spot\WsSpotPub;

include_once __DIR__ . '/../../../../vendor/autoload.php';

// Cli Run: php tests/BitMart/Websocket/Spot/WsSpotPubTest.php start
$cloudWebsocket = new WsSpotPub([
    'xdebug' => true
]);


// Subscribe Public Channels
$cloudWebsocket->subscribe(
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
