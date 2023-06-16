<?php


namespace BitMart\Lib;


use BitMart\Auth;
use BitMart\CloudConst;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class CloudClient
{
    protected $cloudConfig;
    protected $client;


    public function __construct(CloudConfig $cloudConfig)
    {
        $this->cloudConfig = $cloudConfig;
        $this->client = new Client(['http_errors' => false]);
    }

    public  function request($requestPath, $method, $params, $auth = Auth::NONE): array
    {
        if ($method == 'GET' || $method == 'DELETE') {
            $url = $this->cloudConfig->url . $requestPath . (empty($params) ? '' : '?'.http_build_query($params));
        } else {
            $url = $this->cloudConfig->url . $requestPath;
        }

        // set body
        $body = $method == 'POST' ? json_encode($params, JSON_UNESCAPED_SLASHES) : '';

        if ($auth == Auth::NONE) {
            $headers = CloudUtil::getHeader("", "", "");
        } else if ($auth == Auth::KEYED) {
            $headers = CloudUtil::getHeader($this->cloudConfig->accessKey, "", "");
        } else {
            $timestamp = round(microtime(true) * 1000);
            $sign = CloudUtil::signature($timestamp, $body, $this->cloudConfig);
            $headers = CloudUtil::getHeader($this->cloudConfig->accessKey, $sign, $timestamp);
        }

        try {

            if ($this->cloudConfig->xdebug) {
                echo PHP_EOL;
                echo('[' . @$method . '] ' . $url);
                echo PHP_EOL;
                echo 'RequestHeader:';
                print_r($headers);
                if ($body) {
                    echo 'RequestBody:';
                    print_r($body);
                    echo PHP_EOL;
                }
            }


            $response = $this->client->request($method, $url, [
                RequestOptions::TIMEOUT => $this->cloudConfig->timeoutSecond,
                RequestOptions::HEADERS => $headers,
                RequestOptions::BODY => $body,
            ]);


            $code = $response->getStatusCode();
            $responseBody = $response->getBody();


            $limit = [
                'Remaining' => $response->hasHeader(CloudConst::RATE_LIMIT_REMAINING) ? $response->getHeader(CloudConst::RATE_LIMIT_REMAINING)[0] : 0,
                'Limit' => $response->hasHeader(CloudConst::RATE_LIMIT_LIMIT) ? $response->getHeader(CloudConst::RATE_LIMIT_LIMIT)[0] : 0,
                'Reset' => $response->hasHeader(CloudConst::RATE_LIMIT_RESET) ? $response->getHeader(CloudConst::RATE_LIMIT_RESET)[0] : 0,
            ];

            $result = [
                'response' => json_decode((string)$responseBody),
                'httpCode' => $code,
                'limit' => $limit,
            ];

            if ($this->cloudConfig->xdebug) {
                echo '--';
                echo PHP_EOL;
                print_r($result);
                echo('----------------------------');
            }

            return $result;

        } catch (GuzzleException $e) {
            echo "Exception:" . $e->getMessage();
        }

        return [];
    }

}