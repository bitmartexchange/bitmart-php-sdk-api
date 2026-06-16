<?php

use BitMart\CloudConst;
use BitMart\Finance\APIFinance;
require_once __DIR__ . "/../../ExampleConfig.php";
require_once __DIR__ . "/../../../vendor/autoload.php";

// Finance endpoints use the V1 host (api-cloud.bitmart.com)
$APIFinance = new APIFinance(ExampleConfig::getExampleConfig(["url" => CloudConst::API_URL_PRO]));

$response = $APIFinance->modifyFixedAutoRenewal("200001", "REINVEST_FIXED")["response"];
echo json_encode($response);
