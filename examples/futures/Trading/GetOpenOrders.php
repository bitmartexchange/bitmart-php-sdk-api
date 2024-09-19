<?php

use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->getContractOpenOrders()['response'];
echo json_encode($response);


$response = $APIContract->getContractOpenOrders(
    [
        'symbol' => "BTCUSDT",
        'type' => "limit",
        'order_state' => "all",
        'limit' => 1,
    ]
)['response'];
echo json_encode($response);