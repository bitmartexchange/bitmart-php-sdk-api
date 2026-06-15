<?php

use BitMart\CloudConst;
use BitMart\Spot\APISpotSubAccount;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpotSubAccount = new APISpotSubAccount(ExampleConfig::getExampleConfig(['url' => CloudConst::API_URL_PRO]));

$response = $APISpotSubAccount->getSubTransferList(
    'spot to spot',
    100,
    [
        'accountName' => 'subAccountName',
    ]
)['response'];
echo json_encode($response);
