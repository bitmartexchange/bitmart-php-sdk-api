<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));


$response = $APISpot->postCancelBatchOrder("BTC_USDT", [
    'clientOrderIds' => '137478201134228205',
])['response'];

echo json_encode($response);



$response = $APISpot->postCancelBatchOrder("BTC_USDT", [
    'orderIds' => '137478201134228205',
])['response'];

echo json_encode($response);