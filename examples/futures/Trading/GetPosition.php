<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getContractPosition(
)['response'];
echo json_encode($response);


$response = $APIContract->getContractPosition(
    [
        'symbol' => 'BTCUSDT',
        'account' => 'futures',
    ]
)['response'];
echo json_encode($response);
