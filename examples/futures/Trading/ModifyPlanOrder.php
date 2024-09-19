<?php

use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->modifyPlanOrder(
    'ETHUSDT',
    [
        'trigger_price' => '2000',
        'executive_price' => '1450',
        'price_type' => 1,
        'client_order_id' => '2132131231231212',
        'type' => 'limit',
    ]
)['response'];


echo json_encode($response);
