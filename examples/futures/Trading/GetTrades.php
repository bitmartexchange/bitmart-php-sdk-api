<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->getContractTrades(
    "BTCUSDT"
)['response'];
echo json_encode($response);


$endTime = round(microtime(true) );
$startTime = $endTime - (60*60);
$response = $APIContract->getContractTrades(
    "BTCUSDT",
    [
        'start_time' => $startTime,
        'end_time' => $endTime,
    ]
)['response'];
echo json_encode($response);
