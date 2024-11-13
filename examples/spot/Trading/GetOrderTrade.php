<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$endTime = round(microtime(true) * 1000);
$startTime = $endTime - (60*60*1000);
$response = $APISpot->getOrderTradeList(
    '137478201134228205',
    5000
)['response'];

echo json_encode($response);
