<?php

use BitMart\Futures\APIContractTrading;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->closeAllPosition(
    1,
    [
        'symbol' => 'BTCUSDT',
        'position_side' => 'long',
    ]
)['response'];
echo json_encode($response);
