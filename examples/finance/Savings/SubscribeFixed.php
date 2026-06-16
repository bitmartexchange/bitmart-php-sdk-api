<?php

use BitMart\CloudConst;
use BitMart\Finance\APIFinance;
require_once __DIR__ . "/../../ExampleConfig.php";
require_once __DIR__ . "/../../../vendor/autoload.php";

// Finance endpoints use the V1 host (api-cloud.bitmart.com)
$APIFinance = new APIFinance(ExampleConfig::getExampleConfig(["url" => CloudConst::API_URL_PRO]));

$response = $APIFinance->subscribeFixed("1001", "10", "20000009000000300002", "OFF")["response"];
echo json_encode($response);
