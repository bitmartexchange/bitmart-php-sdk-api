<?php
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APISpot = new APISpot(ExampleConfig::getExampleConfig());

$response = $APISpot->getAlgoHistoryOrders(
    [
        'symbol' => 'BTC_USDT',
        'orderMode' => 'trigger',
        'limit' => 200,
    ]
)['response'];

echo json_encode($response) . PHP_EOL;
