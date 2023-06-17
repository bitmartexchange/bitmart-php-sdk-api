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

$response = $APIContract->cancelOrder("BTCUSDT", "<order_id>")['response'];


echo json_encode($response);
