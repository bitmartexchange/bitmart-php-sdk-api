<?php

namespace BitMart\Lib;



use Exception;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\MessageInterface;
use React\EventLoop\Loop;

abstract class CloudWebsocket
{
    protected $url = "";
    protected $xdebug = false;
    protected $useLogin = false;
    protected $isSpot = false;
    protected $isClose = false;
    protected $loginParam = false;
    protected $ready = false;
    protected $reconnectionEnabled = true;
    protected $reconnectionParam = [];

    protected $connection = null;
    protected $loop = null;

    public function __construct($url, $xdebug, $useLogin, $isSpot, $callback, $pong)
    {
        $this->url = $url;
        $this->xdebug = $xdebug;
        $this->useLogin = $useLogin;
        $this->isSpot = $isSpot;
        $this->reconnectionEnabled = true;

        $this->connection($callback, $pong);
    }

    public function connection($callback, $pong): void
    {
        $reactConnector = new \React\Socket\Connector([
            'timeout' => 10
        ]);
        $this->ready = false;
        $loop = Loop::get();
        $connector = new Connector($loop, $reactConnector);

        if ($this->xdebug) {
            echo("[websockets] Connecting to " . $this->url . PHP_EOL);
        }

        $connector($this->url)
            ->then(function(WebSocket $conn) use ($loop, $callback, $pong) {
                $this->connection = $conn;


                if ($this->xdebug) {
                    echo("[websockets] Connected " . $this->url . PHP_EOL);
                }

                $conn->on('message', function(MessageInterface $msg) use ($loop, $callback, $pong, $conn) {

                    if($msg->isBinary()) {
                        $data = gzinflate($msg->getPayload());
                    } else {
                        $data = $msg->getPayload();
                    }


                    if ($this->xdebug) {
                        echo("[websockets] Recv:" . $data . PHP_EOL);
                    }

                    if ($data === 'pong') {
                        if($pong) {
                            call_user_func_array($pong, [$data]);
                        }
                        return;
                    }

                    $data_json = json_decode($data, true);
                    if($callback) {
                        call_user_func_array($callback, [$data_json]);
                    }

                    if (isset($data_json['event']) && $data_json['event'] === 'login' && isset($data_json['errorCode'])) {
                        $this->reconnectionEnabled = false;
                        $this->isClose = true;
                        $this->ready = false;
                        $conn->close($reason=$data);
                        $loop->stop();

                    } elseif (isset($data_json['action']) && $data_json['action'] === 'access' && isset($data_json['error'])) {
                        $this->reconnectionEnabled = false;
                        $this->isClose = true;
                        $this->ready = false;
                        $conn->close($reason=$data);
                        $loop->stop();
                    }
                });

                $conn->on('close', function($reason) use ($callback, $pong, $loop) {
                    if ($this->xdebug) {
                        echo "[websockets] Connection closed." . print_r($reason, true) . PHP_EOL;
                    }

                    if ($this->isClose) {
                        echo "[websockets] Client closed." . PHP_EOL;
                        return ;
                    }

                    if ($this->reconnectionEnabled) {
                        echo "[websockets] Reconnecting to " . $this->url . PHP_EOL;

                        $loop->addTimer(2, function () use ($callback, $pong) {
                            $this->connection($callback, $pong);
                        });
                    }
                });


                $loop->addTimer(2, function () use ($loop, $conn) {

                    if ($this->useLogin) {
                        $conn->send($this->loginParam);
                    }

                    $loop->addTimer(2, function () use ($conn) {
                        foreach ($this->reconnectionParam as $key => $value) {
                            if ($this->xdebug) {
                                echo("[websockets] Send:" . $value . PHP_EOL);
                            }

                            $conn->send($value);
                        }

                        $this->ready = true;
                    });
                });


            }, function(Exception $e) use ($loop) {
                echo "Could not connect: {$e->getMessage()}\n";
                $loop->stop();
            });

        $loop->addPeriodicTimer(10, function () {
            $this->keepalive();
        });
    }

    public function send(string $message)
    {
        if (in_array($message, $this->reconnectionParam, true)) {
            if ($this->xdebug) {
                echo "[websockets] Message already sent: " . $message . PHP_EOL;
            }
            return;
        }

        $this->reconnectionParam[] = $message;

        if ($this->ready) {
            if ($this->xdebug) {
                echo "[websockets] Send." . $message . PHP_EOL;
            }
            $this->connection->send($message);
        }
    }

    public function login()
    {
        $this->useLogin = true;
        $timestamp = round(microtime(true) * 1000);
        $sign = CloudUtil::signature($timestamp, "bitmart.WebSocket", $this->cloudConfig);

        if ($this->isSpot) {
            $this->loginParam = json_encode([
                'op' => "login",
                'args' => [$this->cloudConfig->accessKey, $timestamp, $sign]
            ]);
        } else {
            $this->loginParam = json_encode([
                'action' => "access",
                'args' => [$this->cloudConfig->accessKey, $timestamp.'', $sign, 'web']
            ]);
        }
    }

    public function keepalive()
    {
        if ($this->isClose) {
            echo "[websockets] Client closed, stop send ping." . PHP_EOL;
            return ;
        }

        if ($this->connection) {
            if ($this->isSpot) {
                $this->connection->send('ping');

            } else {
                $this->connection->send('{"action":"ping"}');
            }
        } else {
            echo("[websockets] ping error");
        }
    }

    public function stop()
    {
        $this->isClose = true;
    }


}

