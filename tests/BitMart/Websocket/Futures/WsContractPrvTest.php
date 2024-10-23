<?php

namespace BitMart\Tests;


use BitMart\Websocket\Futures\WsContractPrv;

include_once __DIR__ . '/../../../../vendor/autoload.php';

// Cli Run: php tests/BitMart/Websocket/Futures/WsContractPrvTest.php start
$cloudWebsocket = new WsContractPrv([
    'accessKey' => "your_api_key",
    'secretKey' => "your_secret_key",
    'memo' =>  "your_memo",
    'xdebug' => true,
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
    'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);

// Login
$cloudWebsocket->login();

// Subscribe Private Channels
$cloudWebsocket->send('{
    "action": "subscribe",
    "args":["futures/asset:USDT", "futures/asset:BTC", "futures/asset:ETH"]
}');