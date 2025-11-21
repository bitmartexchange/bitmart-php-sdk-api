<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractMarket;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractMarket(new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'timeoutSecond' => 5,
    'logger' => [
        'enabled' => true,
        'format' => 'default',
        'outputToConsole' => true,
    ] 
]));

$response = $APIContract->getContractMarketTrade("BTCUSDT")['response'];
echo json_encode($response);


$response = $APIContract->getContractMarketTrade(
    "BTCUSDT",
    [
        'limit' => 50,
    ]
)['response'];
echo json_encode($response);

