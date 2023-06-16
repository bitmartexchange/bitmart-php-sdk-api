<?php
use BitMart\Lib\CloudConfig;
use BitMart\Param\SpotOrderParam;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APISpot->postSubmitOrder(new SpotOrderParam(
    [
        'symbol' => 'BTC_USDT',
        'side' => 'buy',
        'type' => 'limit',
        'size' => '0.1',
        'price' => '8800',
        'clientOrderId' => 'test20000000001'
    ]
))['response'];

echo json_encode($response);
