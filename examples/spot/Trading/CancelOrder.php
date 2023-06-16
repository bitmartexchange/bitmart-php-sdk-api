<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APISpot->postCancelOrder("BTC_USDT", "<order_id>", null)['response'];

echo json_encode($response);
