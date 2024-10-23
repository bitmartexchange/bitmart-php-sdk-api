<?php

namespace BitMart\Websocket\Spot;



use BitMart\CloudConst;
use BitMart\Lib\CloudConfig;
use BitMart\Lib\CloudWebsocket;

class WsSpotPrv extends CloudWebsocket
{
    protected $cloudConfig = null;

    public function __construct($args = array())
    {
        $url= $args['url'] ?? CloudConst::WS_SPOT_PRIVATE_URL_PRO;
        $xdebug = $args['xdebug'] ?? false;
        $callback = $args['callback'] ?? null;
        $pong = $args['pong'] ?? null;


        $this->cloudConfig = new CloudConfig([
            'accessKey' => $args['accessKey'] ?? "your_api_key",
            'secretKey' => $args['secretKey'] ?? "your_api_secret_key",
            'memo' => $args['memo'] ?? "your_api_memo",
        ]);

        parent::__construct($url, $xdebug, true, true, $callback, $pong);
    }

}

