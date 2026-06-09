<?php

use BitMart\Futures\APIContractTrading;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getAffiliateRebateApi(
    1234567,
    1770739200,
    1771257600
)['response'];
echo json_encode($response);
