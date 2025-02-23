

<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APIAccount;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIAccount = new APIAccount(new CloudConfig());

$response = $APIAccount->getCurrencies()['response'];
echo json_encode($response);


$response = $APIAccount->getCurrencies([
    'currencies' => 'BTC'
])['response'];
echo json_encode($response);