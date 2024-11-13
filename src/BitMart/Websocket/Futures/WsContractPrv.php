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
        $url= $args['url'] ?? CloudConst::WS_FUTURES_PRIVATE_URL_PRO;
        $xdebug = $args['xdebug'] ?? false;
        $callback = $args['callback'] ?? null;
        $pong = $args['pong'] ?? null;

        $this->cloudConfig = new CloudConfig([
            'accessKey' => $args['accessKey'] ?? "your_api_key",
            'secretKey' => $args['secretKey'] ?? "your_api_secret_key",
            'memo' => $args['memo'] ?? "your_api_memo",
        ]);

        parent::__construct($url, $xdebug, true, false, $callback, $pong);
    }

}

