<?php

namespace BitMart\Tests;


use BitMart\Websocket\Futures\WsContractPub;

include_once __DIR__ . '/../../../../vendor/autoload.php';

// Cli Run: php tests/BitMart/Websocket/Futures/WsContractPubTest.php start
$cloudWebsocket = new WsContractPub([
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
$cloudWebsocket->send('{"action":"subscribe","args":["futures/ticker:BTCUSDT"]}');


