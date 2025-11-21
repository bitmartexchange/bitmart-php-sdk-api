<?php

use BitMart\Futures\APIContractTrading;
require_once __DIR__ . '/../../ExampleConfig.php';

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getContractPositionV2()['response'];
echo json_encode($response);


$response = $APIContract->getContractPositionV2(
    [
        'symbol' => 'BTCUSDT',
    ]
)['response'];
echo json_encode($response);

