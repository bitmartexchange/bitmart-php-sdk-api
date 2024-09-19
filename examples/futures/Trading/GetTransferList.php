<?php

use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->getContractTransferList(
    1, 10
)['response'];
echo json_encode($response);


$endTime = round(microtime(true) * 1000);
$startTime = $endTime - (60*60*1000);
$response = $APIContract->getContractTransferList(
    1, 10,
    [
        'currency' => 'USDT',
        'time_start' => $startTime,
        'time_end' => $endTime,
        'recvWindow' => 5000,
    ]
)['response'];
echo json_encode($response);
