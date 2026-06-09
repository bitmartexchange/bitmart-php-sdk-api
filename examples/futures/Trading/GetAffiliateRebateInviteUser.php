<?php

use BitMart\Futures\APIContractTrading;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->getAffiliateRebateInviteUser(
    1770739200,
    1771257600,
    1,
    50,
    [
        'cid' => 1234567,
    ]
)['response'];
echo json_encode($response);
