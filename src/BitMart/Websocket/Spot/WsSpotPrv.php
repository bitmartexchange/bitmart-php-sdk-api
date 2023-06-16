<?php

namespace BitMart\Websocket\Spot;



use BitMart\CloudConst;
use BitMart\Lib\CloudConfig;
use BitMart\Lib\CloudWebsocket;
use BitMart\Lib\CloudUtil;

class WsSpotPrv extends CloudWebsocket
{
    protected $cloudConfig = null;
    protected $useLogin = false;

    public function __construct($args = array())
    {
        $url= $args['url'] ?? CloudConst::WS_SPOT_PRIVATE_URL_PRO;
        $xdebug = $args['xdebug'] ?? false;

        $this->cloudConfig = new CloudConfig([
            'accessKey' => $args['accessKey'] ?? "your_api_key",
            'secretKey' => $args['secretKey'] ?? "your_api_secret_key",
            'memo' => $args['memo'] ?? "your_api_memo",
        ]);

        parent::__construct($url, $xdebug, true);
    }


    /**
     * First login, then send subscribe message then receive message
     * @param array $subscribeParam {"op": "subscribe", "args": ["spot/user/order"]}
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
            'op' => "login",
            'args' => [$this->cloudConfig->accessKey, $timestamp, $sign]
        ]);
    }
}

