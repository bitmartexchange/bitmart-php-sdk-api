<?php

namespace BitMart\Tests;


use BitMart\Websocket\Spot\WsSpotPub;

include_once __DIR__ . '/../../../../vendor/autoload.php';

// Cli Run: php tests/BitMart/Websocket/Spot/WsSpotPubTest.php start
$cloudWebsocket = new WsSpotPub([
    'xdebug' => true,
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
    'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);


// Subscribe Public Channels
$cloudWebsocket->send('{"op": "subscribe", "args": ["spot/ticker:BTC_USDT"]}');

