<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractMarket;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractMarket(new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
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
