<?php

use BitMart\Futures\APIContractMarket;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractMarket(new CloudConfig([
    'timeoutSecond' => 5,
]));;
$endTime = round(microtime(true));
$startTime = $endTime - (60*60);
$response = $APIContract->getContractKline(
    "BTCUSDT",
    "15",
    $startTime,
    $endTime
)['response'];

echo json_encode($response);
