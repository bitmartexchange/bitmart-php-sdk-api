<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APISpot->postSubmitOrder(
    'BTC_USDT',
    'buy',
    'limit',
    [
        'size' => '0.1',
        'price' => '8800',
        'client_order_id' => 'test20000000005'
    ]
)['response'];

echo json_encode($response);


$response = $APISpot->postSubmitOrder(
    'BTC_USDT',
    'buy',
    'market',
    [
        'notional' => '2',
        'price' => '8800',
        'client_order_id' => 'test20000000006'
    ]
)['response'];

echo json_encode($response);

