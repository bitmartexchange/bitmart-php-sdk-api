<?php

use BitMart\Futures\APIContractTrading;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->submitOrder(
    'BTCUSDT',
    1,
    [
        // 'client_order_id' => "test3000000001xx",
        'type' => "limit",
        'leverage' => "100",
        'open_type' => "isolated",
        'mode' => 1,
        'price' => "9200",
        'size' => 1,
        'stp_mode' => 1,
    ]
)['response'];


echo json_encode($response);
