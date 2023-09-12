<?php


namespace BitMart\Futures;


use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;
use BitMart\Param\ContractOrderParam;
use BitMart\Param\ContractPlanOrderParam;

class APIContractTrading
{
    static $cloudClient;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    // ----------- Private API

    /**
     * url: GET https://api-cloud.bitmart.com/contract/private/assets-detail
     * Get Contract Assets (KEYED) - Applicable for querying user contract asset details
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractAssets(): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_ASSETS_URL, CloudConst::GET, [], Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/private/order
     * Get Order Detail (KEYED) - Applicable for querying contract order detail
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @param $orderId : Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractOrderDetail($symbol, $orderId): array
    {
        $params = [
            'symbol' => $symbol,
            'order_id' => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_ORDER_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/private/order-history
     * Get Order History (KEYED) - Applicable for querying contract order history
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @param $startTime : Start time, default is the last 7 days
     * @param $endTime : End time, default is the last 7 days
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractOrderHistory($symbol, $startTime, $endTime): array
    {
        $params = [
            'symbol' => $symbol,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_ORDER_HISTORY_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/private/get-open-orders
     * Get All Open Orders (KEYED) - Applicable for querying contract all open orders
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @param $type : Order type (limit/market)
     * @param $orderState : Order state (all(default)/partially_filled)
     * @param $limit : The number of returned results, with a maximum of 100 and a default of 100
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractOpenOrders($symbol, $type, $orderState, $limit): array
    {
        $params = [
            'symbol' => $symbol,
            'type' => $type,
            'order_state' => $orderState,
            'limit' => $limit,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_OPEN_ORDERS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/private/position
     * Get Current Position (KEYED) - Applicable for checking the position details a specified contract
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractPosition($symbol): array
    {
        $params = [
            'symbol' => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_POSITION_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/private/trades
     * Get Order Trade (KEYED) - Applicable for querying contract order trade detail
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @param $startTime : Start time, default is the last 7 days
     * @param $endTime : End time, default is the last 7 days
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractTrades($symbol, $startTime, $endTime): array
    {
        $params = [
            'symbol' => $symbol,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRADES_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/account/v1/transfer-contract-list
     * Get Transfer List (SIGNED) - Query futures account transfer records
     * @param $currency : Currency (like USDT)
     * @param $timeStart : Start time in milliseconds, (e.g. 1681701557927)
     * @param $timeEnd : End time in milliseconds, (e.g. 1681701557927)
     * @param $page : Number of pages, allowed range [1,1000]
     * @param $limit : Number of queries, allowed range [10,100]
     * @param $recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContractTransferList($currency, $timeStart, $timeEnd, $page, $limit, $recvWindow): array
    {
        $params = [
            'currency' => $currency,
            'time_start' => $timeStart,
            'time_end' => $timeEnd,
            'page' => $page,
            'limit' => $limit,
            'recvWindow' => $recvWindow,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRANSFER_LIST_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/contract/private/submit-order
     * Submit Order (SIGNED) - Applicable for placing contract orders
     * @param ContractOrderParam $contractOrderParam : <see BitMart\Param\ContractOrderParam>
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function submitOrder(ContractOrderParam $contractOrderParam): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SUBMIT_ORDER_URL, CloudConst::POST, $contractOrderParam, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/contract/private/cancel-order
     * Cancel Order (SIGNED) - Applicable for canceling a specific contract order
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @param $orderId : Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function cancelOrder($symbol, $orderId): array
    {
        $params = [
            'symbol' => $symbol,
            'order_id' => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CANCEL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/contract/private/cancel-orders
     * Cancel All Orders (SIGNED) - Applicable for batch order cancellation under a particular contract
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function cancelAllOrder($symbol): array
    {
        $params = [
            'symbol' => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CANCEL_ALL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/contract/private/submit-plan-order
     * Submit Plan Order (SIGNED) - Applicable for placing contract plan orders
     * @param ContractPlanOrderParam $contractPlanOrderParam
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function submitPlanOrder(ContractPlanOrderParam $contractPlanOrderParam): array
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SUBMIT_PLAN_ORDER_URL, CloudConst::POST, $contractPlanOrderParam, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/contract/private/cancel-plan-order
     * Cancel Plan Order (SIGNED) - Applicable for canceling a specific contract plan order
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @param $orderId : Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function cancelPlanOrder($symbol, $orderId): array
    {
        $params = [
            'symbol' => $symbol,
            'order_id' => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_CANCEL_PLAN_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/account/v1/transfer-contract
     * Transfer (SIGNED) - Transfer between spot account and contract account
     * @param $currency : Currency (Only USDT is supported)
     * @param $amount : Transfer amount，allowed range[0.01,10000000000]
     * @param $type : Transfer type(spot_to_contract/contract_to_spot)
     * @param $recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function transfer($currency, $amount, $type, $recvWindow): array
    {
        $params = [
            'currency' => $currency,
            'amount' => $amount,
            'type' => $type,
            'recvWindow' => $recvWindow,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_TRANSFER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/contract/private/submit-leverage
     * Submit Leverage (SIGNED) - Applicable for adjust contract leverage
     * @param $symbol : Symbol of the contract(like BTCUSDT)
     * @param $leverage : Order leverage
     * @param $open_type : Open type, required at close position
                                -cross
                                -isolated
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function submitLeverage($symbol, $open_type, $leverage): array
    {
        $params = [
            'symbol' => $symbol,
            'open_type' => $open_type,
        ];

        if ($leverage) {
            $params["leverage"] = $leverage;
        }

        return self::$cloudClient->request(CloudConst::API_CONTRACT_PRV_SUBMIT_LEVERAGE_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

}