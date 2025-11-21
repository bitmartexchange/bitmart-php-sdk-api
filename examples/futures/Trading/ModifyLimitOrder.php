<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->modifyLimitOrder(
    'BTCUSDT',
    [
        'order_id' => "220609666322019",
        'price' => "50000",
        'size' => 1,
    ]
)['response'];
echo json_encode($response);

