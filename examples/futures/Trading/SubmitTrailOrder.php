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

$response = $APIContract->submitTrailOrder(
    [
        'symbol' => "BTCUSDT",
        'side' => 1,
        'leverage' => "5",
        'open_type' => "isolated",
        'size' => 1,
        'activation_price' => "80000",
        'callback_rate' => "2",
        'activation_price_type' => 1,
    ]
)['response'];


echo json_encode($response);
