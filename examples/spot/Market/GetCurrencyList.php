<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'timeoutSecond' => 5,
]));

$response = $APISpot->getCurrencies()['response'];

echo json_encode($response);
