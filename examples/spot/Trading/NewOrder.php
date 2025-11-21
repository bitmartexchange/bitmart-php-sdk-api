<?php
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APISpot = new APISpot(ExampleConfig::getExampleConfig());

// Submit limit order with stpMode
$response = $APISpot->postSubmitOrder(
    'BTC_USDT',
    'buy',
    'limit',
    [
        'size' => '0.1',
        'price' => '8800',
        'client_order_id' => 'test20000000005',
        'stpMode' => "cancel_maker"
    ]
)['response'];

echo json_encode($response) . PHP_EOL;

// Submit market order
$response = $APISpot->postSubmitOrder(
    'BTC_USDT',
    'buy',
    'market',
    [
        'notional' => '2',
        'client_order_id' => 'test20000000006'
    ]
)['response'];

echo json_encode($response) . PHP_EOL;

