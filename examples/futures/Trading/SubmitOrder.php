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

$response = $APIContract->submitOrder(
    'BTCUSDT',
    1,
    [
        'client_order_id' => "test3000000001",
        'type' => "limit",
        'leverage' => "1",
        'open_type' => "isolated",
        'mode' => 1,
        'price' => "10",
        'size' => 1,
    ]
)['response'];


echo json_encode($response);
