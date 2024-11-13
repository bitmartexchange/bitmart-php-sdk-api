<?php

namespace BitMart\Websocket\Futures;



use BitMart\CloudConst;
use BitMart\Lib\CloudWebsocket;

class WsContractPub extends CloudWebsocket
{
    protected $cloudConfig = null;

    public function __construct($args = array())
    {
        $url = $args['url'] ?? CloudConst::WS_FUTURES_PUBLIC_URL_PRO;
        $xdebug = $args['xdebug'] ?? false;
        $callback = $args['callback'] ?? null;
        $pong = $args['pong'] ?? null;

        parent::__construct($url, $xdebug, false, false, $callback, $pong);
    }


}
