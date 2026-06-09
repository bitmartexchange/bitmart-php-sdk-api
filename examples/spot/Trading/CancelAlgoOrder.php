<?php
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APISpot = new APISpot(ExampleConfig::getExampleConfig());

$response = $APISpot->postCancelAlgoOrder(
    'BTC_USDT',
    '1223181',
    'trigger'
)['response'];

echo json_encode($response) . PHP_EOL;
