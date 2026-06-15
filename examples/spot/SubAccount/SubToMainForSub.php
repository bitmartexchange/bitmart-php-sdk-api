<?php

use BitMart\CloudConst;
use BitMart\Spot\APISpotSubAccount;
require_once __DIR__ . '/../../ExampleConfig.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpotSubAccount = new APISpotSubAccount(ExampleConfig::getExampleConfig(['url' => CloudConst::API_URL_PRO]));

$response = $APISpotSubAccount->postSubToMainForSub(
    'test-request-no-0002',
    '1',
    'USDT'
)['response'];
echo json_encode($response);
