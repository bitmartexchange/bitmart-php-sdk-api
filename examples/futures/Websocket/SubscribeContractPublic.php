<?php

use BitMart\Websocket\Futures\WsContractPub;


include_once __DIR__ . '/../../../vendor/autoload.php';

$ws = new WsContractPub();


// Subscribe Public Channels
$ws->subscribe(
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
