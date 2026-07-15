<?php
use BitMart\CloudConst;
use BitMart\Spot\APIAccount;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APIAccount = new APIAccount(ExampleConfig::getExampleConfig(['url' => CloudConst::API_URL_PRO]));

$response = $APIAccount->postAccountTransfer('USDT', '10', 'spot_to_fund')['response'];
echo json_encode($response) . PHP_EOL;
