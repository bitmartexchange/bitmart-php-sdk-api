<?php
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APISpot = new APISpot(ExampleConfig::getExampleConfig());

$orderParam = array();

$orderParam[] =
    [
        'symbol' => 'BTC_USDT',
        'side' => 'buy',
        'type' => 'limit',
        'size' => '1000000000',
        'price' => '8800',
        'clientOrderId' => 'test0000000003',
        'stpMode' => "cancel_maker"
    ];

$orderParam[] =
    [
        'symbol' => 'BTC_USDT',
        'side' => 'sell',
        'type' => 'market',
        'size' => '2000000000',
        'notional' => '5',
        'clientOrderId' => 'test0000000004'
    ];

// Submit batch order with stpMode
$response = $APISpot->postSubmitBatchOrder('BTC_USDT', $orderParam, [
    'recvWindow' => 5000,
])['response'];

echo json_encode($response);
