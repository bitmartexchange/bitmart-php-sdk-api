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

$response = $APIAccount->getDepositWithdrawHistory(
    "withdraw", 100
)['response'];

echo json_encode($response);

$endTime = round(microtime(true) * 1000);
$startTime = $endTime - (60*60*1000);

$response = $APIAccount->getDepositWithdrawHistory(
    "withdraw", 100,
    [
        'currency' => 'BTC',
        'startTime' => $startTime,
        'endTime' => $endTime,
    ],
)['response'];

echo json_encode($response);