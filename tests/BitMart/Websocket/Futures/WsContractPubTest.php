<?php

namespace BitMart\Tests;


use BitMart\Websocket\Futures\WsContractPub;

include_once __DIR__ . '/../../../../vendor/autoload.php';

// Cli Run: php tests/BitMart/Websocket/Futures/WsContractPubTest.php start
$cloudWebsocket = new WsContractPub([
    'xdebug' => false
]);


// Subscribe Public Channels
$cloudWebsocket->subscribe(
    [
        'action' => "subscribe",
        'args' => [
            // Only Support Public Channel
            "futures/ticker"
        ]
    ],
    function ($data) {
        echo "-------------------------" . PHP_EOL;
        echo print_r($data);
    }
);
