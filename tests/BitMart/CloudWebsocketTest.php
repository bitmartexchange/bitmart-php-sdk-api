<?php

namespace BitMart;



include_once __DIR__.'/../../vendor/autoload.php';

// Cli Run: php tests/BitMart/CloudWebsocketTest.php start
$cloudWebsocket = new CloudWebsocket(new CloudConfig(
    CloudConst::WS_URL_PRO,
    "-80618e45710812162b04892c7ee5ead4a3cc3e56",
    "6c6c98544461bbe71db2bca4c6d7fd0021e0ba9efc215f9c6ad41852df9d9df9",
    "test001"
));

// Subscribe Public Channels
$cloudWebsocket->subscribeWithoutLogin(
    [
        'op' => "subscribe",
        'args' => [
            // Only Support Public Channel
            "spot/ticker:BTC_USDT",
            "spot/ticker:ETH_USDT",
        ]
    ],
    function ($data) {
        echo "----------------\n";
        print_r($data);
        echo "----------------\n";
    }
);


// Subscribe Public And Private Channels
$cloudWebsocket->subscribeWithLogin(
    [
        'op' => "subscribe",
        'args' => [
            // Public Channel
            "spot/ticker:BTC_USDT",

            // Private Channel
            "spot/user/order:BTC_USDT",
        ]
    ],
    function ($data) {
        echo "----------------\n";
        print_r($data);
        echo "----------------\n";
    }
);