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
        $callback = $args['callback'] ?? null;
        $pong = $args['pong'] ?? null;

        parent::__construct($url, $xdebug, false, true, $callback, $pong);

    }

}

