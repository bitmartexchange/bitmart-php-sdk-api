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

$response = $APIContract->getContractTransactionHistory()['response'];
echo json_encode($response);


$endTime = round(microtime(true))*1000;
$startTime = $endTime - (60*60)*1000;
$response = $APIContract->getContractTransactionHistory(
    [
        'flow_type' => 0,
        'start_time' => $startTime,
        'end_time' => $endTime,
        'page_size' => 20,
    ]
)['response'];
echo json_encode($response);
