<?php


namespace BitMart\Lib;


use BitMart\CloudConst;
use BitMart\Lib\CloudLogger;

class CloudConfig
{
    public $url;
    public $accessKey;
    public $secretKey;
    public $memo;
    public $timeoutSecond;
    public $customHeaders;
    public $loggerConfig;
    public $logger; // CloudLogger instance

    public function __construct($args = array())
    {
        $this->url         = $args['url'] ?? CloudConst::API_URL_PRO;
        $this->accessKey   = $args['accessKey'] ?? "your_api_key";
        $this->secretKey   = $args['secretKey'] ?? "your_api_secret_key";
        $this->memo        = $args['memo'] ?? "your_api_memo";
        $this->timeoutSecond          = $args['timeoutSecond'] ?? 5;
        $this->customHeaders      = $args['customHeaders'] ?? array();
        $this->loggerConfig = $args['logger'] ?? [];
        
        // Create logger instance for this CloudConfig
        $this->logger = new CloudLogger($this->loggerConfig);
    }


}