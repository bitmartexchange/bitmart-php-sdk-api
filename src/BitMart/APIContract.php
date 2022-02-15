<?php


namespace BitMart;


class APIContract
{
    static $cloudClient;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    // ----------- Public API

    /**
     * url: GET https://api-cloud.bitmart.com/contract/v1/tickers
     * Get the latest market quotations of the futures
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getTickers()
    {
        return self::$cloudClient->request(CloudConst::API_CONTRACT_TICKERS_URL, CloudConst::GET, [], Auth::NONE);
    }


}