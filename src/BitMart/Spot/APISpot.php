<?php


namespace BitMart\Spot;



use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;
use BitMart\Param\MarginOrderParam;
use BitMart\Param\SpotOrderParam;

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
     * url: GET https://api-cloud.bitmart.com/spot/v2/ticker
     * Applicable to query the latest ticker of all trading pairs, please note that the endpoint returns more data, please reduce the frequency of calls
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getTicker(): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_TICKER_URL, CloudConst::GET, []);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/ticker_detail
     * Applicable for querying aggregated tickers of a particular trading pair
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getTickerDetail($symbol): array
    {
        $params = [
            "symbol" => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_TICKER_DETAIL_URL, CloudConst::GET, $params);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/steps
     * Get all k-line steps supported by the platform, expressed in minutes, minimum 1 minute.
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getKlineStep(): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_STEPS_URL, CloudConst::GET, []);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols/kline
     * Get k-line data within a specified time range of a specified trading pair
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $from : Start timestamp (in seconds, UTC+0 TimeZome)
     * @param $to : End timestamp (in seconds, UTC+0 TimeZome)
     * @param $step : k-line step Steps (in minutes, default 1 minute)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolKline($symbol, $from, $to, $step = 1): array
    {
        $params = [
            "symbol" => $symbol,
            "from" => $from,
            "to" => $to,
            "step" => $step,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_KLINE_URL, CloudConst::GET, $params);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols/book
     * Get full depth of trading pairs.
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $precision : Price precision, the range is defined in trading pair details
     * @param $size : Number of results per request. The value can be transmitted [1-200], there are altogether [2-400] buying and selling depths
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolBook($symbol, $precision, $size): array
    {
        $params = [
            "symbol" => $symbol,
        ];
        if ($precision) {
            $params["precision"] = $precision;
        }
        if ($size) {
            $params["size"] = $size;
        }

        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_BOOK_URL, CloudConst::GET, $params);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols/trades
     * Get the latest trade records of the specified trading pair
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $n : Number of returned items, the default maximum is 50
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolTrades($symbol, $n): array
    {
        $params = [
            "symbol" => $symbol,
        ];

        if ($n) {
            $params["N"] = $n;
        }


        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_TRADES_URL, CloudConst::GET, $params);
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
     * @param SpotOrderParam $spotOrderParam : <see BitMart\Param\SpotOrderParam>
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitOrder(SpotOrderParam $spotOrderParam): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_ORDER_URL, CloudConst::POST, $spotOrderParam, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/margin/submit_order
     * New Margin Order(v1) (SIGNED) - Applicable for margin order placement
     * @param MarginOrderParam $marginOrderParam :  <see BitMart\Param\MarginOrderParam>
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitMarginOrder(MarginOrderParam $marginOrderParam): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_MARGIN_ORDER_URL, CloudConst::POST, $marginOrderParam, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v2/batch_orders
     * New Batch Order(v2) (SIGNED) - Batch order
     * @param $orderParams : Order parameters, the number of transactions cannot exceed 10
     * @return array
     */
    public function postSubmitBatchOrder($orderParams): array
    {
        $params = [
            "order_params" => $orderParams
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_BATCH_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v3/cancel_order
     * Cancel Order(v3) (SIGNED) - Applicable to the cancellation of a specified unfinished order
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $orderId : Order id
     * @param $clientOrderId : Client-defined Order ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postCancelOrder($symbol, $orderId, $clientOrderId): array
    {
        $params = [
            "symbol" => $symbol,
            "order_id" => $orderId,
            "client_order_id" => $clientOrderId,
        ];

        return self::$cloudClient->request(CloudConst::API_SPOT_CANCEL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/cancel_orders
     * Cancel all outstanding orders in the specified side for a trading pair
     * @param $symbol : Trading pair (e.g. BTC_USDT)
     * @param $side : buy or sell
     * @return array : ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postCancelAllOrder($symbol, $side): array
    {
        $params = [
            "symbol" => $symbol,
            "side" => $side,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_CANCEL_ORDERS_URL, CloudConst::POST, $params, Auth::SIGNED);
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