<?php


namespace BitMart\Lib;


use BitMart\CloudConst;

class CloudConfig
{
    public $url;
    public $accessKey;
    public $secretKey;
    public $memo;
    public $timeoutSecond;
    public $xdebug;
    public $customHeaders;

    public function __construct($args = array())
    {
        $this->url         = $args['url'] ?? CloudConst::API_URL_PRO;
        $this->accessKey   = $args['accessKey'] ?? "your_api_key";
        $this->secretKey   = $args['secretKey'] ?? "your_api_secret_key";
        $this->memo        = $args['memo'] ?? "your_api_memo";
        $this->timeoutSecond          = $args['timeoutSecond'] ?? 5;
        $this->xdebug      = $args['xdebug'] ?? false;
        $this->customHeaders      = $args['customHeaders'] ?? array();
    }


}