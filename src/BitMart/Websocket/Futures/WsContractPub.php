<?php

namespace BitMart\Websocket\Futures;



use BitMart\CloudConst;
use BitMart\Lib\CloudWebsocket;

class WsContractPub extends CloudWebsocket
{
    protected $cloudConfig = null;
    protected $useLogin = false;

    public function __construct($args = array())
    {
        $url= $args['url'] ?? CloudConst::WS_CONTRACT_PUBLIC_URL_PRO;
        $xdebug = $args['xdebug'] ?? false;

        parent::__construct($url, $xdebug, false);
    }


    /**
     * Send subscribe message and receive message
     * @param array $subscribeParam {"action":"subscribe","args":["futures/ticker","futures/depth20:BTCUSDT"]}
     * @param func $callback Receive message, callback function
     */
    public function subscribe(array $subscribeParam, $callback)
    {
        $this->addParam($subscribeParam);
        $this->connection($callback);
    }

}

