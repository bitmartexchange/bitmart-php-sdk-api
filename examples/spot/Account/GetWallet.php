<?php
use BitMart\Spot\APIAccount;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../ExampleConfig.php';

$APIAccount = new APIAccount(ExampleConfig::getExampleConfig());

// Get wallet balance for specific currency
$response = $APIAccount->getWallet( ['currency' => 'BTC'])['response'];
echo json_encode($response) . PHP_EOL;

// Get wallet balance with USD valuation
$response = $APIAccount->getWallet([ 'needUsdValuation' => true])['response'];
echo json_encode($response) . PHP_EOL;

// Get all wallet balances
$response = $APIAccount->getWallet()['response'];
echo json_encode($response) . PHP_EOL;

