<?php

use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->getContractCurrentPlanOrder()['response'];
echo json_encode($response);



$response = $APIContract->getContractCurrentPlanOrder(
    [
        'symbol' => "BTCUSDT",
        'type' => "limit",
        'limit' => 1,
    ]
)['response'];
echo json_encode($response);
