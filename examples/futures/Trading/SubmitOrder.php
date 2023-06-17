<?php

use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;
use BitMart\Param\ContractOrderParam;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->submitOrder(new ContractOrderParam(
    [
        'symbol' => "BTCUSDT",
        'clientOrderId' => "test3000000001",
        'type' => "limit",
        'side' => 1,
        'leverage' => "1",
        'openType' => "isolated",
        'mode' => 1,
        'price' => "10",
        'size' => 1,
    ]
))['response'];


echo json_encode($response);
