<?php

use BitMart\CloudConst;
use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->modifyPresetPlanOrder(
    'ETHUSDT',
    [
        'order_id' => 220609666322019,
        'preset_take_profit_price' => '2000',
        'preset_stop_loss_price' => '1900',
        'preset_take_profit_price_type' => 1,
        'preset_stop_loss_price_type' => 1,
    ]
)['response'];


echo json_encode($response);
