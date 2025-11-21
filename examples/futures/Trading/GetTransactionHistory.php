<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getContractTransactionHistory()['response'];
echo json_encode($response);


$endTime = round(microtime(true)) * 1000;
$startTime = $endTime - (60 * 60) * 1000;
$response = $APIContract->getContractTransactionHistory(
    [
        'account' => 'futures',
        'flow_type' => 0,
        'start_time' => $startTime,
        'end_time' => $endTime,
        'page_size' => 20,
    ]
)['response'];
echo json_encode($response);
