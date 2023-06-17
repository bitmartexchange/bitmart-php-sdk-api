<?php


namespace BitMart\Spot;


use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;

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
    public function getSystemTime(): array
    {
        return self::$cloudClient->request(CloudConst::API_SYSTEM_TIME_URL, CloudConst::GET, []);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/system/service
     * Get System Service Status
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSystemService(): array
    {
        return self::$cloudClient->request(CloudConst::API_SYSTEM_SERVICE_URL, CloudConst::GET, []);
    }

}