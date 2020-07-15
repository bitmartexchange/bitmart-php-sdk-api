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

}