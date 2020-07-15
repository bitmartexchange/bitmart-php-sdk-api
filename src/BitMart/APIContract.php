<?php


namespace BitMart;


class APIContract
{
    static $cloudClient ;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    // ----------- Public API

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/contracts
     * Get contract list information
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getContracts()
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_CONTRACTS_URL, CloudConst::GET, [], Auth::NONE);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/pnls
     * Get ADL list
     * @param $contractId: 	Contract ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getPnls($contractId)
    {
        $params = [
            "contractID" => $contractId
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_PNLS_URL, CloudConst::GET, $params, Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/indexes
     * Get the index price of all contracts
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getIndex()
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_INDEXES_URL, CloudConst::GET, [], Auth::NONE);
    }

    // ----------- Market API


    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/tickers
     * Get contract ticker
     * @param $contractId: 	Contract ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getTicker($contractId)
    {
        $params = [
            "contractID" => $contractId
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_TICKERS_URL, CloudConst::GET, $params, Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/tickers
     * Get contract ticker
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAllTicker()
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_TICKERS_URL, CloudConst::GET, [], Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/quote
     * Get K-Line
     * @param $contractId: Contract ID
     * @param $startTime: Start time
     * @param $endTime: End time
     * @param $unit: Frequency
     * @param $resolution: Frequency unit, M: minute, H: hour, D: day
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getQuote($contractId, $startTime, $endTime, $unit, $resolution)
    {
        $params = [
            "contractID" => $contractId,
            "startTime" => $startTime,
            "endTime" => $endTime,
            "unit" => $unit,
            "resolution" => $resolution,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_QUOTE_URL, CloudConst::GET, $params, Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/indexquote
     * Get index K-Line
     * @param $indexId:	Index ID
     * @param $startTime: Start time
     * @param $endTime: End time
     * @param $unit: Frequency
     * @param $resolution: Frequency unit, M: minute, H: hour, D: day
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getIndexQuote($indexId, $startTime, $endTime, $unit, $resolution)
    {
        $params = [
            "indexID" => $indexId,
            "startTime" => $startTime,
            "endTime" => $endTime,
            "unit" => $unit,
            "resolution" => $resolution,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_INDEX_QUOTE_URL, CloudConst::GET, $params, Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/trades
     * Get contract trade history
     * @param $contractId: Contract ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getTrades($contractId)
    {
        $params = [
            "contractID" => $contractId,
        ];
        return self::$cloudClient->request(CloudConst::API_CONTRACT_TRADES_URL, CloudConst::GET, $params, Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/depth
     * Get contract depth
     * @param $contractId: Contract ID
     * @param $count: Request size, all records will be returned if not passed
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getDepth($contractId, $count)
    {
        $params = [
            "contractID" => $contractId,
        ];

        if ($count) {
            $params["count"] = $count;
        }
        return self::$cloudClient->request(CloudConst::API_CONTRACT_DEPTH_URL, CloudConst::GET, $params, Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/fundingrate
     * Get funding rate
     * @param $contractId: Contract ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getFundingRate($contractId)
    {
        $params = [
            "contractID" => $contractId,
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_FUNDING_RATE_URL, CloudConst::GET, $params, Auth::NONE);
    }


    // --------------- Trading API

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/userOrders
     * Get user order history
     * @param $contractId: Contract ID
     * @param $status:	Order status
     *                        0=All
     *                        1=Submitting
     *                        2=Commissioned
     *                        3=1&2
     *                        4=Completed
     * @param $offset: Offset
     * @param $size: Request size, If size is not passed or size is 0, the system returns a maximum of 60 records
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getUserOrders($contractId, $status, $offset, $size)
    {
        $params = [
            "contractID" => $contractId,
            "status" => $status,
        ];

        if ($offset && $size) {
            $params["offset"] = $offset;
            $params["size"] = $size;
        }

        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_ORDERS_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/userOrderInfo
     * Get user order info
     * @param $contractId: Contract ID
     * @param $orderId: Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getUserOrderInfo($contractId, $orderId)
    {
        $params = [
            "contractID" => $contractId,
            "orderID" => $orderId,
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_ORDER_INFO_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/userTrades
     * Get user trades
     * @param $contractId: Contract ID
     * @param $offset: Offset
     * @param $size: Request size, If size is not passed or size is 0, the system returns a maximum of 60 records
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getUserTrades($contractId, $offset, $size)
    {
        $params = [
            "contractID" => $contractId,
        ];

        if ($offset && $size) {
            $params["offset"] = $offset;
            $params["size"] = $size;
        }

        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_TRADES_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/orderTrades
     * Order trade history
     * @param $contractId: Contract ID
     * @param $orderId: OrderID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getOrderTrades($contractId, $orderId)
    {
        $params = [
            "contractID" => $contractId,
            "orderID" => $orderId,
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_ORDER_TRADES_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/contract/v1/ifcontract/submitOrder
     * Submit order
     * @param OpenOrderParam $openOrderParam
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitOpenOrder(OpenOrderParam $openOrderParam)
    {
        $params = json_decode(json_encode($openOrderParam), true);
        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_SUBMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/contract/v1/ifcontract/batchOrders
     * Batch order
     * @param array OpenOrderParam: $openOrderArrayParam
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitBatchOpenOrder(array $openOrderArrayParam)
    {
        $orders = json_decode(json_encode($openOrderArrayParam), true);
        $params = [
            'orders' => $orders
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_BATCH_ORDERS_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/contract/v1/ifcontract/submitOrder
     * Submit order
     * @param CloseOrderParam $closeOrderParam
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitCloseOrder(CloseOrderParam $closeOrderParam)
    {
        $params = json_decode(json_encode($closeOrderParam), true);
        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_SUBMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/contract/v1/ifcontract/batchOrders
     * Batch order
     * @param array CloseOrderParam: $closeOrderArrayParam
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitBatchCloseOrder(array $closeOrderArrayParam)
    {
        $orders = json_decode(json_encode($closeOrderArrayParam), true);
        $params = [
            'orders' => $orders
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_BATCH_ORDERS_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/contract/v1/ifcontract/cancelOrders
     * Cancel order
     * @param $contractId: Contract ID
     * @param array $orderIds: ids
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postCancelOrder($contractId, array $orderIds)
    {
        $orders = [
            'contract_id' => $contractId,
            'orders' => $orderIds,
        ];

        $params = [
            'orders' => $orders
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_CANCEL_ORDERS_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    // ------------- Account API

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/accounts
     * Query user account information
     * @param $coinCode: Coin code, Example: USDT
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAccount($coinCode)
    {
        $params = [
            'coinCode' => $coinCode
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_ACCOUNTS_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    // --------------- Position API

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/userPositions
     * Get user positions
     * @param $contractId: Contract ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getUserPositions($contractId)
    {
        $params = [
            'contractID' => $contractId,
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_POSITIONS_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/userLiqRecords
     * Get liquidation records
     * @param $contractId: Contract ID
     * @param $orderId: Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getUserLiqRecords($contractId, $orderId)
    {
        $params = [
            'contractID' => $contractId,
        ];

        if ($orderId) {
            $params["orderId"] = $orderId;
        }

        return self::$cloudClient->request(CloudConst::API_CONTRACT_USER_LIQ_RECORDS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/ifcontract/positionFee
     * Get position fee
     * @param $contractId: Contract ID
     * @param $positionId: Position ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getPositionFee($contractId, $positionId)
    {
        $params = [
            'contractID' => $contractId,
            'positionID' => $positionId,
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_POSITION_FEE_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/contract/v1/ifcontract/marginOper
     * Add or reduce margin for fixed margin position
     * @param $contractId: Contract ID
     * @param $positionId: Position ID
     * @param $vol: Margin amount
     * @param $operType: Operation type, [1=add margin; 2=reduce margin]
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postMarginOper($contractId, $positionId, $vol, $operType)
    {
        $params = [
            'contract_id' => $contractId,
            'position_id' => $positionId,
            'vol' => $vol,
            'oper_type' => $operType,
        ];

        return self::$cloudClient->request(CloudConst::API_CONTRACT_MARGIN_OPER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }








}