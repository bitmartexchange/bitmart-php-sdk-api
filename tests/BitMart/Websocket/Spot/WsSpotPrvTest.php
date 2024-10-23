<?php

namespace BitMart\Tests;


use BitMart\Websocket\Spot\WsSpotPrv;

include_once __DIR__ . '/../../../../vendor/autoload.php';


// Cli Run: php tests/BitMart/Websocket/Spot/WsSpotPrvTest.php start
$cloudPrivateWebsocket = new WsSpotPrv(
   [
       'accessKey' => "your_api_key",
       'secretKey' => "your_secret_key",
       'memo' =>  "your_memo",
       'xdebug' => true,
       'callback' => function ($data) {
           echo "-------------------------" . PHP_EOL;
           print_r($data);
       },
       'pong' => function ($data) {
           echo "-------------------------".$data.PHP_EOL;
       }
   ]
);

// Login
$cloudPrivateWebsocket->login();

// Subscribe Private Channels
$cloudPrivateWebsocket->send('{"op": "subscribe", "args": ["spot/user/balance:BALANCE_UPDATE"]}');