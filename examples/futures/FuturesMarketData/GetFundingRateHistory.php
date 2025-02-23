<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractMarket;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractMarket(new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'timeoutSecond' => 5,
]));

$response = $APIContract->getContractFundingRateHistory("BTCUSDT",[
    'limit' => 10
])['response'];

echo json_encode($response);
