<?php

use BitMart\Futures\APIContractTrading;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getContractAutoRepayment(
    [
        'from_coin_code' => 'USDT',
        'page' => 1,
        'size' => 1000,
    ]
)['response'];
echo json_encode($response);
