<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;
require_once __DIR__ . '/../../ExampleConfig.php';

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(ExampleConfig::getExampleConfig());

$response = $APIContract->cancelAllAfter("BTCUSDT", 360)['response'];
echo json_encode($response);

