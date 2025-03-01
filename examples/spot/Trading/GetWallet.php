<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));


$response = $APISpot->getWallet()['response'];

echo json_encode($response);



$response = $APISpot->getWallet(
    [
        'currency' => 'BTC'
    ]
)['response'];
echo json_encode($response);