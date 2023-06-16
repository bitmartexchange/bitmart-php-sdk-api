<?php

namespace BitMart\Websocket\Futures;



use BitMart\CloudConst;
use BitMart\Lib\CloudConfig;
use BitMart\Lib\CloudUtil;
use BitMart\Lib\CloudWebsocket;

class WsContractPrv extends CloudWebsocket
{
    protected $cloudConfig = null;
    protected $useLogin = false;

    public function __construct($args = array())
    {
        $url= $args['url'] ?? CloudConst::WS_CONTRACT_PRIVATE_URL_PRO;
        $xdebug = $args['xdebug'] ?? false;

        $this->cloudConfig = new CloudConfig([
            'accessKey' => $args['accessKey'] ?? "your_api_key",
            'secretKey' => $args['secretKey'] ?? "your_api_secret_key",
            'memo' => $args['memo'] ?? "your_api_memo",
        ]);

        parent::__construct($url, $xdebug, true);
    }


    /**
     * Send subscribe message and receive message
     * @param array $subscribeParam {"action": "subscribe","args":["futures/asset:USDT"]}
     * @param func $callback Receive message, callback function
     */
    public function subscribe(array $subscribeParam, $callback)
    {
        $this->loginParam = $this->createLoginParam();
        $this->addParam($subscribeParam);
        $this->connection($callback);
    }

    public function createLoginParam(): string
    {
        $timestamp = round(microtime(true) * 1000);
        $sign = CloudUtil::signature($timestamp, "bitmart.WebSocket", $this->cloudConfig);

        return json_encode([
            'action' => "access",
            'args' => [$this->cloudConfig->accessKey, $timestamp.'', $sign, 'web']
        ]);
    }

}

