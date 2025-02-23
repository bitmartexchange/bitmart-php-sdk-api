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

$response = $APIContract->cancelTrailOrder("BTCUSDT")['response'];
echo json_encode($response);


$response = $APIContract->cancelTrailOrder("BTCUSDT", [
    "order_id" => "60633000005"
])['response'];
echo json_encode($response);
