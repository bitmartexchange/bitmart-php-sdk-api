<?php


namespace BitMart\Spot;



use Binance\Exception\MissingArgumentException;
use Binance\Util\Strings;
use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;

class APISpot
{
    static $cloudClient;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    // ----------- Public API

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/currencies
     * Get a list of all cryptocurrencies on the platform
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getCurrencies(): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_CURRENCIES_URL, CloudConst::GET, []);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols
     * Get a list of all trading pairs on the platform
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbol(): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_URL, CloudConst::GET, []);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols/details
     * Get a detailed list of all trading pairs on the platform
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolDetail(): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_DETAILS_URL, CloudConst::GET, []);
    }

    /**
     * Get Ticker of All Pairs (V3)
     *
     * url: GET https://api-cloud.bitmart.com/spot/quotation/v3/tickers
     * Get the quotations of all trading pairs, including: snapshot information of the latest transaction price,
     *  first bid price, first ask price and 24-hour trading volume.
     * Note that the interface is not real-time data,
     *  if you need real-time data, please use websocket to subscribe Ticker channel
     *
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getV3Tickers(): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_V3_TICKERS_URL, CloudConst::GET, []);
    }

    /**
     * Get Ticker of a Trading Pair (V3)
     * url: GET https://api-cloud.bitmart.com/spot/quotation/v3/ticker
     *
     * Applicable to query the aggregated market price of a certain trading pair,
     *  and return the latest ticker information.
     * Note that the interface is not real-time data,
     *  if you need real-time data, please use websocket to subscribe Ticker channel
     *
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getV3Ticker($symbol): array
    {
        $params = [
            "symbol" => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_V3_TICKER_URL, CloudConst::GET, $params);
    }

    /**
     * Get Latest K-Line (V3)
     * url: GET https://api-cloud.bitmart.com/spot/quotation/v3/lite-klines
     *
     * Query the latest K-line and return a maximum of 1000 data.
     * Note that the latest K-line of the interface is not real-time data.
     *  If you want real-time data, please use websocket to subscribe to K-line channel
     *
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $before : Query timestamp (unit: second), query the data before this time
     * @param $after : Query timestamp (unit: second), query the data after this time
     * @param $step : k-line step, value [1, 3, 5, 15, 30, 45, 60,
                                    120, 180, 240, 1440, 10080, 43200] unit: minute, default 1
     * @param $limit : Return number, the maximum value is 200, default is 100
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getV3LatestKline($symbol, $before, $after, $step, $limit): array
    {
        $params = [
            "symbol" => $symbol,
        ];

        if ($before) {
            $params["before"] = $before;
        }

        if ($after) {
            $params["after"] = $after;
        }

        if ($step) {
            $params["step"] = $step;
        }

        if ($limit) {
            $params["limit"] = $limit;
        }

        return self::$cloudClient->request(CloudConst::API_SPOT_V3_LATEST_KLINE_URL, CloudConst::GET, $params);
    }

    /**
     * Get History K-Line (V3)
     * url: GET https://api-cloud.bitmart.com/spot/quotation/v3/klines
     * Get k-line data within a specified time range of a specified trading pair.
     *  Note that the interface is not real-time data,
     * if you need real-time data, please use websocket to subscribe KLine channel
     *
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $before : Query timestamp (unit: second), query the data before this time
     * @param $after : Query timestamp (unit: second), query the data after this time
     * @param $step : k-line step, value [1, 3, 5, 15, 30, 45, 60,
                    120, 180, 240, 1440, 10080, 43200] unit: minute, default 1
     * @param $limit : Return number, the maximum value is 200, default is 100
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getV3HistoryKline($symbol, $before, $after, $step, $limit): array
    {
        $params = [
            "symbol" => $symbol,
        ];

        if ($before) {
            $params["before"] = $before;
        }

        if ($after) {
            $params["after"] = $after;
        }

        if ($step) {
            $params["step"] = $step;
        }

        if ($limit) {
            $params["limit"] = $limit;
        }

        return self::$cloudClient->request(CloudConst::API_SPOT_V3_HISTORY_KLINE_URL, CloudConst::GET, $params);
    }


    /**
     * Get Depth (V3)
     * url: GET https://api-cloud.bitmart.com/spot/quotation/v3/books
     *
     * Get full depth of trading pairs.
     * Note that the interface is not real-time data,
     *  if you need real-time data, please use websocket to subscribe Depth channel
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $limit : Order book depth per side. Maximum 50, e.g. 50 bids + 50 asks. Default returns to 35 depth data, e.g. 35 bids + 35 asks.
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getV3Book($symbol, $limit): array
    {
        $params = [
            "symbol" => $symbol,
        ];
        if ($limit) {
            $params["limit"] = $limit;
        }

        return self::$cloudClient->request(CloudConst::API_SPOT_V3_BOOKS_URL, CloudConst::GET, $params);
    }




    /**
     * Get Recent Trades (V3)
     * url: GET https://api-cloud.bitmart.com/spot/quotation/v3/trades
     *
     * Get the latest trade records of the specified trading pair.
     *  Note that the interface is not real-time data,
     *  if you need real-time data, please use websocket to subscribe Trade channel
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $limit : Number of returned items, maximum is 50, default 50
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getV3Trades($symbol, $limit): array
    {
        $params = [
            "symbol" => $symbol,
        ];

        if ($limit) {
            $params["limit"] = $limit;
        }


        return self::$cloudClient->request(CloudConst::API_SPOT_V3_TRADES_URL, CloudConst::GET, $params);
    }

    // -------------- Balance API

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/wallet
     * Get the user's wallet balance for all currencies
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getWallet(): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_WALLET_URL, CloudConst::GET, [], Auth::KEYED);
    }

    // -------------- Trading API

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v2/submit_order
     * New Order(v2) (SIGNED) - Send in a new order.
     * @param string $symbol : Trading pair (e.g. BTC_USDT)
     * @param string $side : Side
                               -buy=Buy order
                               -sell=Sell order
     * @param string $type : Order type
                            -limit=Limit order
                            -market=Market order
                            -limit_maker=PostOnly order
                            -ioc=IOC order
     * @param array $options
     *  clientOrderId : Client-defined OrderId(A combination of numbers and letters, less than 32 bits)
     *  size : Order size || Required for placing orders by quantity
     *  price : Order Price
     *  notional : Required for placing orders by amount
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitOrder(string $symbol,string $side, string $type, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
                'side' => $side,
                'type' => $type,
            ],
            $options,
        );
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/margin/submit_order
     * New Margin Order(v1) (SIGNED) - Applicable for margin order placement
     *
     * @param string $symbol : Trading pair (e.g. BTC_USDT)
     * @param string $side : Side
                             -buy=Buy order
                             -sell=Sell order
     * @param string $type : Order type
                            -limit=Limit order
                            -market=Market order
                            -limit_maker=PostOnly order
                            -ioc=IOC order
     * @param array $options
     *  clientOrderId : Client-defined OrderId(A combination of numbers and letters, less than 32 bits)
     *  size : Order size || Required for placing orders by quantity
     *  price : Order Price
     *  notional : Required for placing orders by amount
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitMarginOrder(string $symbol,string $side, string $type, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
                'side' => $side,
                'type' => $type,
            ],
            $options,
        );
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_MARGIN_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/batch_orders
     * New Batch Order(v4) (SIGNED) - Batch order
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $orderParams : Order parameters, the number of transactions cannot exceed 10
     * @param $options.recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array
     */
    public function postSubmitBatchOrder(string $symbol, array $orderParams, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
                'orderParams' => $orderParams,
            ],
            $options,
        );

        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_BATCH_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v3/cancel_order
     * Cancel Order(v3) (SIGNED) - Applicable to the cancellation of a specified unfinished order
     * @param string $symbol : Trading pair (e.g. BTC_USDT)
     * @param array $options
     *  orderId : Order id
     *  clientOrderId : Client-defined Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postCancelOrder(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_SPOT_CANCEL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/cancel_orders
     * Cancel all outstanding orders in the specified direction for the specified trading pair or cancel based on the order ID
     * @param string $symbol : Trading pair (e.g. BTC_USDT)
     * @param array $options
     *  orderIds : Order Id List (Either orderIds or clientOrderIds must be provided)
     *  clientOrderIds : Client-defined OrderId List (Either orderIds or clientOrderIds must be provided)
     *  recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postCancelBatchOrder(string $symbol, array $options = []): array
    {
        $params = array_merge(
            [
                'symbol' => $symbol,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_SPOT_CANCEL_ORDERS_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/cancel_all
     * Cancel all orders
     * @param array $options
     *  symbol : Trading pair (e.g. BTC_USDT)
     *  side : Order side
                            -buy
                            -sell
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postCancelAllOrder(array $options = []): array
    {
        $params = $options;
        return self::$cloudClient->request(CloudConst::API_SPOT_CANCEL_ALL_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/query/order
     * Query Order By Id (v4) (SIGNED) - Query a single order by orderId
     * @param $orderId : Order id
     * @param $queryState : open/history
     * @param $recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getOrderByOrderId($orderId, $queryState, $recvWindow): array
    {
        $params = [
            "orderId" => $orderId,
            "queryState" => $queryState,
            "recvWindow" => $recvWindow,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_V4_QUERY_ORDER_BY_ID_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/query/client-order
     * Query Order By clientOrderId(v4) (SIGNED) - Query a single order by clientOrderId.
     * @param $clientOrderId : User-defined order id
     * @param $queryState : open/history
     * @param $recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getOrderByClientOrderId($clientOrderId, $queryState, $recvWindow): array
    {
        $params = [
            "clientOrderId" => $clientOrderId,
            "queryState" => $queryState,
            "recvWindow" => $recvWindow,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_V4_QUERY_ORDER_BY_CLIENT_ID_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/query/open-orders
     * Current Open Orders(v4) (SIGNED) - Query the current opening order list of the account, only including state=[new, partially_filled] orders
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $orderMode : Order mode
                             - spot=spot trade
                             - iso_margin=isolated margin trade
     * @param $startTime : Start time in milliseconds, (e.g. 1681701557927)
     * @param $endTime : End time in milliseconds, (e.g. 1681701557927)
     * @param $limit : Number of queries, allowed range [1,200], default 200
     * @param $recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getCurrentOpenOrders($symbol, $orderMode, $startTime, $endTime, $limit, $recvWindow): array
    {
        $params = [
            "symbol" => $symbol,
            "orderMode" => $orderMode,
            "startTime" => $startTime,
            "endTime" => $endTime,
            "limit" => $limit,
            "recvWindow" => $recvWindow,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_V4_QUERY_OPEN_ORDERS_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/query/history-orders
     * Account Orders(v4) (SIGNED) - Query the account history order list, only including state=[filled, canceled, partially_canceled] orders
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $orderMode : Order mode
                             - spot=spot trade
                            - iso_margin=isolated margin trade
     * @param $startTime : Start time in milliseconds, (e.g. 1681701557927)
     * @param $endTime : End time in milliseconds, (e.g. 1681701557927)
     * @param $limit : Number of queries, allowed range [1,200], default 200
     * @param $recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAccountOrders($symbol, $orderMode, $startTime, $endTime, $limit, $recvWindow): array
    {
        $params = [
            "symbol" => $symbol,
            "orderMode" => $orderMode,
            "startTime" => $startTime,
            "endTime" => $endTime,
            "limit" => $limit,
            "recvWindow" => $recvWindow,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_V4_QUERY_HISTORY_ORDERS_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/query/trades
     *
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $orderMode : Order mode
                            - spot=spot trade
                            - iso_margin=isolated margin trade
     * @param $startTime : Start time in milliseconds, (e.g. 1681701557927)
     * @param $endTime : End time in milliseconds, (e.g. 1681701557927)
     * @param $limit : Number of queries, allowed range [1,200], default 200
     * @param $recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getAccountTradeList($symbol, $orderMode, $startTime, $endTime, $limit, $recvWindow): array
    {
        $params = [
            "symbol" => $symbol,
            "orderMode" => $orderMode,
            "startTime" => $startTime,
            "endTime" => $endTime,
            "limit" => $limit,
            "recvWindow" => $recvWindow,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_V4_QUERY_TRADES_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v4/query/order-trades
     * Order Trade List(v4) (SIGNED) - Query all transaction records of a single order
     * @param $orderId : Order id
     * @param $recvWindow : Trade time limit, allowed range (0,60000], default: 5000 milliseconds
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getOrderTradeList($orderId, $recvWindow): array
    {
        $params = [
            "orderId" => $orderId,
            "recvWindow" => $recvWindow,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_V4_QUERY_ORDER_TRADES_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

}