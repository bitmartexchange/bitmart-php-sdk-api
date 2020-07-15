<?php


namespace BitMart;


class APISystem
{
    static $cloudClient ;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/system/time
     * Get System Time
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSystemTime()
    {
        return self::$cloudClient->request(CloudConst::API_SYSTEM_TIME_URL, CloudConst::GET, [], Auth::NONE);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/system/service
     * Get System Service Status
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSystemService()
    {
        return self::$cloudClient->request(CloudConst::API_SYSTEM_SERVICE_URL, CloudConst::GET, [], Auth::NONE);
    }

}