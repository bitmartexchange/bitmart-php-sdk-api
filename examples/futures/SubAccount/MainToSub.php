<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractSubAccount;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

// Contract sub-account endpoints use the V2 host (api-cloud-v2.bitmart.com)
$APIContractSubAccount = new APIContractSubAccount(ExampleConfig::getExampleConfig(['url' => CloudConst::API_URL_V2_PRO]));

$response = $APIContractSubAccount->postMainToSub(
    'test-request-no-0006',
    '1',
    'USDT',
    'subAccountName'
)['response'];
echo json_encode($response);
