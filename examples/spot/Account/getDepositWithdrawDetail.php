<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APIAccount;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIAccount = new APIAccount(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIAccount->getDepositWithdrawDetail("1231231212312312")['response'];

echo json_encode($response);
