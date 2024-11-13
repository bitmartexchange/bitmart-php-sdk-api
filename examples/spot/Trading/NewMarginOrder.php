<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APISpot->postSubmitMarginOrder(
    'BTC_USDT',
    'buy',
    'limit',
    [
        'size' => '0.1',
        'price' => '8800',
        'clientOrderId' => 'test200000000022221'
    ]
)['response'];

echo json_encode($response);


