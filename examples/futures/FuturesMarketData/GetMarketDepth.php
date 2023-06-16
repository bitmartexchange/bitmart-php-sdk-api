<?php

use BitMart\Futures\APIContractMarket;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractMarket(new CloudConfig([
    'timeoutSecond' => 5,
]));;

$response = $APIContract->getContractDepth("BTCUSDT")['response'];

echo json_encode($response);
