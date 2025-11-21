<?php

use BitMart\Futures\APIContractTrading;

require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getContractPositionRisk(
)['response'];
echo json_encode($response);


$response = $APIContract->getContractPositionRisk(
    [
        'symbol' => 'BTCUSDT',
        'account' => 'futures',
    ]
)['response'];
echo json_encode($response);
