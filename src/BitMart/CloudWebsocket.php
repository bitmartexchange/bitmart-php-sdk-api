<?php

namespace BitMart;

use Workerman\Connection\AsyncTcpConnection;
use Workerman\Lib\Timer;
use Workerman\Worker;

class CloudWebsocket
{

    protected $cloudConfig = null;
    protected $useLogin = false;
    protected $reconnectionEnabled = true;
    protected $reconnectionSubscribeParam = array();


    public function __construct(CloudConfig $cloudConfig)
    {
        $this->cloudConfig = $cloudConfig;
        $this->reconnectionEnabled = true;
    }


    /**
     * First login, then send subscribe message then receive message
     * @param array $subscribeParam {"op": "subscribe", "args": ["spot/user/ticker:ETH_BTC"]}
     * @param func $callback Receive message, callback function
     */
    public function subscribeWithLogin(array $subscribeParam, $callback)
    {
        $this->useLogin = true;
        $this->connection($subscribeParam, $callback);
    }


    /**
     * Send subscribe message and receive message
     * @param array $subscribeParam {"op": "subscribe", "args": ["spot/user/ticker:ETH_BTC"]}
     * @param func $callback Receive message, callback function
     */
    public function subscribeWithoutLogin(array $subscribeParam, $callback)
    {
        $this->connection($subscribeParam, $callback);
    }

    private function connection($subscribeParam, $callback): void
    {
        $subscribeParam = json_encode($subscribeParam);

        array_push($this->reconnectionSubscribeParam, $subscribeParam);

        $worker = new Worker();

        $worker->onWorkerStart = function ($worker) use ($subscribeParam, $callback) {

            echo("[websockets] Connecting to " . $this->cloudConfig->url . PHP_EOL);
            $ws_connection = new AsyncTcpConnection($this->cloudConfig->url);
            $ws_connection->transport = 'ssl';


            // Keep-AliveAsyncTcpConnection
            Timer::add(10, function () use ($ws_connection) {
                $ws_connection->send("ping");
            });


            $ws_connection->onConnect = function ($connection) use ($subscribeParam) {
                if ($this->useLogin) {
                    $loginParam = $this->createLoginParam();
                    if ($this->cloudConfig->xdebug) {
                        echo("[websockets] Send:" . $loginParam . PHP_EOL);
                    }
                    $connection->send($loginParam);

                    sleep(2); // wait login successful
                }
                if ($this->cloudConfig->xdebug) {
                    echo("[websockets] Send:" . $subscribeParam . PHP_EOL);
                }
                $connection->send($subscribeParam);
            };


            $ws_connection->onMessage = function ($connection, $data) use ($callback) {

                if ($data == "pong") {
                    return ;
                }

                if (!str_starts_with($data, "{")) {
                    $data = gzinflate($data);
                }

                if ($this->cloudConfig->xdebug) {
                    echo("[websockets] Recv:" . $data . PHP_EOL);
                }

                $data = json_decode($data, true);
                call_user_func_array($callback, array($data));


                if (isset($data["event"])) {
                    if ($data["event"] == "login" && isset($data["errorCode"])) {
                        $this->reconnectionEnabled = false;
                        $connection->cancelReconnect();
                        echo "[websockets] Close. Reason: login failed......" . PHP_EOL;
                    }
                }

            };

            $ws_connection->onError = function ($connection, $code, $msg) {
                echo "Error: $msg" . PHP_EOL;
            };

            $ws_connection->onClose = function ($connection) {
                echo "[websockets] Connection closed" . PHP_EOL;

                if ($this->reconnectionEnabled) {
                    echo("[websockets] Reconnecting to " . $this->cloudConfig->url . PHP_EOL);
                    $connection->reconnect(2);

                    if ($this->useLogin) {
                        $connection->send($this->createLoginParam());
                        sleep(2);// wait login successful
                    }

                    foreach ($this->reconnectionSubscribeParam as $key => $value) {
                        $connection->send($value);
                    }

                }
            };

            $ws_connection->connect();

        };

        Worker::runAll();
    }

    public function createLoginParam(): string
    {
        $timestamp = CloudUtil::getTimestamp();
        $sign = CloudUtil::signature($timestamp, "bitmart.WebSocket", $this->cloudConfig);

        return json_encode([
            'op' => "login",
            'args' => [$this->cloudConfig->accessKey, $timestamp, $sign]
        ]);
    }

}