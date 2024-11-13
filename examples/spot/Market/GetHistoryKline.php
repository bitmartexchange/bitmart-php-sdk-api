<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';


$APISpot = new APISpot(new CloudConfig([
    'timeoutSecond' => 5,
]));

$before = round(microtime(true));
$after = $before - (60*60);

$response = $APISpot->getV3HistoryKline(
    'BTC_USDT',
    $before,
    $after,
    15,
    10
)['response'];

echo json_encode($response);
