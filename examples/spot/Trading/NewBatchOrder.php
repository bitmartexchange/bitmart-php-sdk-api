<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$orderParam = array();

$orderParam[] =
    [
        'symbol' => 'BTC_USDT',
        'side' => 'buy',
        'type' => 'limit',
        'size' => '0.1',
        'price' => '8800',
        'clientOrderId' => 'test0000000003'
    ];

$orderParam[] =
    [
        'symbol' => 'BTC_USDT',
        'side' => 'sell',
        'type' => 'market',
        'size' => '0.2',
        'notional' => '5',
        'clientOrderId' => 'test0000000004'
    ];

$response = $APISpot->postSubmitBatchOrder('BTC_USDT', $orderParam, [
    'recvWindow' => 5000
])['response'];

echo json_encode($response);
