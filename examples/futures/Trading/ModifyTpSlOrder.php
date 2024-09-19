<?php

use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->modifyTpSlOrder(
    'ETHUSDT',
    [
        'order_id' => 220609666322019,
        'trigger_price' => '2000',
        'price_type' => 2,
        'plan_category' => 2,
        'category' => 'limit',
    ]
)['response'];


echo json_encode($response);
