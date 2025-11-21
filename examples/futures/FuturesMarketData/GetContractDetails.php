<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractMarket;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractMarket(new CloudConfig([
    'url' => "https://demo-api-cloud-v2.bitmart.com",
    'timeoutSecond' => 5,
    'logger' => [
        'enabled' => true,
        'format' => 'default',
        'outputToConsole' => true,
    ] 
]));

$response = $APIContract->getContractDetails()['response'];

echo json_encode($response);
