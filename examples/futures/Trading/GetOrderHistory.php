<?php

use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->getContractOrderHistory(
    "BTCUSDT"
)['response'];
echo json_encode($response);


$endTime = round(microtime(true) );
$startTime = $endTime - (60*60);
$response = $APIContract->getContractOrderHistory(
    "BTCUSDT",
    [
        'start_time' => $startTime,
        'end_time' => $endTime,
    ]
)['response'];
echo json_encode($response);
