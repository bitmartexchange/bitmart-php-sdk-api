<?php

namespace BitMart\Lib;



use Exception;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\Frame;
use Ratchet\RFC6455\Messaging\MessageInterface;
use React\EventLoop\Loop;

abstract class CloudWebsocket
{
    protected $url = "";
    protected $xdebug = false;
    protected $useLogin = false;
    protected $loginParam = false;
    protected $reconnectionEnabled = true;
    protected $reconnectionSubscribeParam = [];

    protected $connection = null;

    public function __construct($url, $xdebug, $useLogin)
    {
        $this->url = $url;
        $this->xdebug = $xdebug;
        $this->useLogin = $useLogin;
        $this->reconnectionEnabled = true;
    }

    public function ping()
    {
        if ($this->connection) {
            $this->connection->send(new Frame('', true, Frame::OP_PING));
        } else {
            echo("[websockets] ping error");
        }
    }

    public function addParam($subscribeParam) {
        $subscribeParam = json_encode($subscribeParam);

        array_push($this->reconnectionSubscribeParam, $subscribeParam);
    }

    public function connection($callback): void
    {
        $reactConnector = new \React\Socket\Connector([
            'timeout' => 10
        ]);
        $loop = Loop::get();
        $connector = new Connector($loop, $reactConnector);

        if ($this->xdebug) {
            echo("[websockets] Connecting to " . $this->url . PHP_EOL);
        }

        $connector($this->url)
            ->then(function(WebSocket $conn) use ($loop, $callback) {
                $this->connection = $conn;

                if ($this->xdebug) {
                    echo("[websockets] Connected " . $this->url . PHP_EOL);
                }

                if ($this->useLogin) {
                    if ($this->xdebug) {
                        echo("[websockets] Send:" . $this->loginParam . PHP_EOL);
                    }

                    $conn->send($this->loginParam);

                }

                $conn->on('message', function(MessageInterface $msg) use ($loop, $callback, $conn) {

                    if($msg->isBinary()) {
                        $data = gzinflate($msg->getPayload());
                    } else {
                        $data = $msg->getPayload();
                    }

                    if ($data === 'pong') {
                        return;
                    }

                    if ($this->xdebug) {
                        echo("[websockets] Recv:" . $data . PHP_EOL);
                    }

                    $data = json_decode($data, true);
                    call_user_func_array($callback, [$data]);

                    if (isset($data['event']) && $data['event'] === 'login' && isset($data['errorCode'])) {
                        $this->reconnectionEnabled = false;
                        $conn->close($reason=$data);
                        $loop->stop();

                    } elseif (isset($data['action']) && $data['action'] === 'access' && isset($data['error'])) {
                        $this->reconnectionEnabled = false;
                        $conn->close($reason=$data);
                        $loop->stop();
                    }
                });

                $conn->on('close', function($reason) use ($callback, $loop) {
                    if ($this->xdebug) {
                        echo "[websockets] Connection closed." . print_r($reason) . PHP_EOL;
                    }

                    if ($this->reconnectionEnabled) {
                        echo "[websockets] Reconnecting to " . $this->url . PHP_EOL;

                        $loop->addTimer(2, function () use ($callback) {
                            $this->connection($callback);
                        });
                    }
                });

                $loop->addTimer(2, function () use ($conn) {
                    foreach ($this->reconnectionSubscribeParam as $key => $value) {
                        if ($this->xdebug) {
                            echo("[websockets] Send:" . $value . PHP_EOL);
                        }

                        $conn->send($value);
                    }
                });


            }, function(Exception $e) use ($loop) {
                echo "Could not connect: {$e->getMessage()}\n";
                $loop->stop();
            });

        $loop->addPeriodicTimer(10, function () {
            $this->ping();
        });
    }



}

