<?php
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APISpot = new APISpot(ExampleConfig::getExampleConfig());

// Submit a plan (trigger) algo order
$response = $APISpot->postSubmitAlgoOrder(
    'BTC_USDT',
    'buy',
    'trigger',
    [
        'trigger_price' => '20000',
        'trigger_type' => 'limit',
        'price' => '20000',
        'size' => '0.1',
        'client_order_id' => 'test_algo_0001',
    ]
)['response'];

echo json_encode($response) . PHP_EOL;
