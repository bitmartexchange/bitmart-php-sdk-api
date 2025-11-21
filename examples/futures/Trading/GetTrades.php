<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractTrading;
require_once __DIR__ . '/../../ExampleConfig.php';

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getContractTrades([
    'symbol' => 'BTCUSDT',
])['response'];
echo json_encode($response);


$endTime = round(microtime(true));
$startTime = $endTime - (60 * 60);
$response = $APIContract->getContractTrades(
    [
        'symbol' => 'BTCUSDT',
        'account' => 'futures',
        'start_time' => $startTime,
        'end_time' => $endTime,
    ]
)['response'];
echo json_encode($response);


$response = $APIContract->getContractTrades(
    [
        'symbol' => 'BTCUSDT',
        'account' => 'futures',
    ]
)['response'];
echo json_encode($response);
