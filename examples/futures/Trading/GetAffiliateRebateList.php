<?php

use BitMart\Futures\APIContractTrading;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getAffiliateRebateList(
    1,
    50,
    'USDT',
    [
        'user_id' => 1234567,
        'rebate_start_time' => 1770739200,
        'rebate_end_time' => 1771257600,
    ]
)['response'];
echo json_encode($response);
