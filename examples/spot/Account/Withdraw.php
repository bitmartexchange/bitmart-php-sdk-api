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

// Parameters for Withdraw to the blockchain
$response = $APIAccount->postWithdraw(
    'USDT-ERC20',
    '40',
    [
        'address' => "0xe57b69a8776b37860407965B73cdFFBDF",
        'address_memo' => '123',
        'destination' => 'To Digital Address',
    ],
)['response'];

echo json_encode($response);


// Parameters for Withdraw to BitMart account
$response = $APIAccount->postWithdraw(
    'USDT-ERC20',
    '40',
    [
        'type' => 1,
        'value' => '876940329',
        'areaCode' => '',
    ],
)['response'];

echo json_encode($response);