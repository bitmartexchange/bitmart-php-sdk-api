<?php
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APISpot = new APISpot(ExampleConfig::getExampleConfig());

$response = $APISpot->getAlgoOrderById(
    '118100034543076010',
    [
        'queryState' => 'open',
    ]
)['response'];

echo json_encode($response) . PHP_EOL;
