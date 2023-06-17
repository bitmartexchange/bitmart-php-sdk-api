<?php

namespace BitMart\Websocket\Spot;



use BitMart\CloudConst;
use BitMart\Lib\CloudWebsocket;

class WsSpotPub extends CloudWebsocket
{
    protected $cloudConfig = null;
    protected $useLogin = false;

    public function __construct($args = array())
    {
        $url= $args['url'] ?? CloudConst::WS_SPOT_PUBLIC_URL_PRO;
        $xdebug = $args['xdebug'] ?? false;

        parent::__construct($url, $xdebug, false);
    }


    /**
     * Send subscribe message and receive message
     * @param array $subscribeParam {"op": "subscribe", "args": ["spot/user/ticker:ETH_BTC"]}
     * @param func $callback Receive message, callback function
     */
    public function subscribe(array $subscribeParam, $callback)
    {
        $this->addParam($subscribeParam);
        $this->connection($callback);
    }

}

