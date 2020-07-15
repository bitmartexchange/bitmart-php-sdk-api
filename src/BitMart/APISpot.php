<?php


namespace BitMart;


class APISpot
{
    static $cloudClient ;

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
    public function getCurrencies()
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_CURRENCIES_URL, CloudConst::GET, [], Auth::NONE);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols
     * Get a list of all trading pairs on the platform
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbol()
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_URL, CloudConst::GET, [], Auth::NONE);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols/details
     * Get a detailed list of all trading pairs on the platform
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolDetail()
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_DETAILS_URL, CloudConst::GET, [], Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/ticker
     * Ticker is an overview of the market status of a trading pair,
     *      including the latest trade price, top bid and ask prices and 24-hour trading volume
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getTicker()
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_TICKER_URL, CloudConst::GET, [], Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/ticker
     * Ticker is an overview of the market status of a trading pair,
     *      including the latest trade price, top bid and ask prices and 24-hour trading volume
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolTicker($symbol)
    {
        $params = [
            "symbol" => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_TICKER_URL, CloudConst::GET, $params, Auth::NONE);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/steps
     * Get all k-line steps supported by the platform, expressed in minutes, minimum 1 minute.
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getKlineStep()
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_STEPS_URL, CloudConst::GET, [], Auth::NONE);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols/kline
     * Get k-line data within a specified time range of a specified trading pair
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $from: Start timestamp (in seconds, UTC+0 TimeZome)
     * @param $to: End timestamp (in seconds, UTC+0 TimeZome)
     * @param $step: k-line step Steps (in minutes, default 1 minute)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolKline($symbol, $from, $to, $step = 1)
    {
        $params = [
            "symbol" => $symbol,
            "from" => $from,
            "to" => $to,
            "step" => $step,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_KLINE_URL, CloudConst::GET, $params, Auth::NONE);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols/book
     * Get full depth of trading pairs.
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $precision: Price precision, the range is defined in trading pair details
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolBook($symbol, $precision)
    {
        $params = [
            "symbol" => $symbol,
        ];
        if ($precision) {
            $params["precision"] = $precision;
        }

        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_BOOK_URL, CloudConst::GET, $params, Auth::NONE);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/symbols/trades
     * Get the latest trade records of the specified trading pair
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSymbolTrades($symbol)
    {
        $params = [
            "symbol" => $symbol,
        ];

        return self::$cloudClient->request(CloudConst::API_SPOT_SYMBOLS_TRADES_URL, CloudConst::GET, $params, Auth::NONE);
    }

    // -------------- Balance API

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/wallet
     * Get the user's wallet balance for all currencies
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getWallet()
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_WALLET_URL, CloudConst::GET, [], Auth::KEYED);
    }

    // -------------- Trading API

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/submit_order
     * Place order
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $size: Order size
     * @param $price: Price
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitOrderLimitBuy($symbol, $size, $price)
    {
        $params = [
            "symbol" => $symbol,
            "side" => "buy",
            "type" => "limit",
            "size" => $size,
            "price" => $price,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/submit_order
     * Place order
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $size: Order size
     * @param $price: Price
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitOrderLimitSell($symbol, $size, $price)
    {
        $params = [
            "symbol" => $symbol,
            "side" => "sell",
            "type" => "limit",
            "size" => $size,
            "price" => $price,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/submit_order
     * Place order
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $notional: Quantity bought, required when buying at market price notional
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitOrderMarketBuy($symbol, $notional)
    {
        $params = [
            "symbol" => $symbol,
            "side" => "buy",
            "type" => "market",
            "notional" => $notional,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/submit_order
     * Place order
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $size: Quantity sold, required when selling at market price size
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubmitOrderMarketSell($symbol, $size)
    {
        $params = [
            "symbol" => $symbol,
            "side" => "sell",
            "type" => "market",
            "size" => $size,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_SUBMIT_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/cancel_order
     * Cancel an outstanding order
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $orderId: Order id
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postCancelOrder($symbol, $orderId)
    {
        $params = [
            "symbol" => $symbol,
            "order_id" => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_CANCEL_ORDER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/cancel_orders
     * Cancel all outstanding orders in the specified side for a trading pair
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $side: buy or sell
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postCancelAllOrder($symbol, $side)
    {
        $params = [
            "symbol" => $symbol,
            "side" => $side,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_CANCEL_ORDERS_URL, CloudConst::POST, $params, Auth::SIGNED);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/order_detail
     * Get order detail
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $orderId: Order id
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getOrderDetail($symbol, $orderId)
    {
        $params = [
            "symbol" => $symbol,
            "order_id" => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_ORDER_DETAIL_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/orders
     * Get a list of user orders
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $status: Status
     *                  1=Order failure
     *                  2=Order success
     *                  3=Freeze failure
     *                  4=Freeze success
     *                  5=Partially filled
     *                  6=Fully filled
     *                  7=Canceling
     *                  8=Canceled
     *                  9=Outstanding (4 and 5)
     *                  10= 6 and 8
     * @param $offset: Current page, starts from 1
     * @param $limit: Items returned per page (value range 1-100)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getUserOrder($symbol, $status, $offset, $limit)
    {
        $params = [
            "symbol" => $symbol,
            "status" => $status,
            "offset" => $offset,
            "limit" => $limit,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_ORDERS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/trades
     * Get user trade history
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $offset: Current page, starts from 1
     * @param $limit: Records returned per page (value range 1-100)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getUserTrade($symbol, $offset, $limit)
    {
        $params = [
            "symbol" => $symbol,
            "offset" => $offset,
            "limit" => $limit,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_TRADES_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/trades
     * Get user trade history
     * @param $symbol: Trading pair (e.g. BTC_USDT)
     * @param $orderId: Order id
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getUserOrderTrade($symbol, $orderId)
    {
        $params = [
            "symbol" => $symbol,
            "order_id" => $orderId,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_TRADES_URL, CloudConst::GET, $params, Auth::KEYED);
    }

}