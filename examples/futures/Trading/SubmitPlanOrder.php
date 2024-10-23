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

$response = $APIContract->submitPlanOrder(
    'ETHUSDT',
    4,
    [
        'type' => "limit",
        'leverage' => "5",
        'open_type' => "isolated",
        'mode' => 1,
        'price' => "10",
        'size' => 1,
        'trigger_price' => "2000",
        'executive_price' => "1800",
        'price_way' => 1,
        'price_type' => 1,
    ]
)['response'];


echo json_encode($response);
