<?php


namespace BitMart\Lib;


use BitMart\Auth;
use BitMart\CloudConst;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use stdClass;

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
        // Generate unique request ID if logging is enabled
        $requestId = $this->cloudConfig->logger->isEnabled() 
            ? CloudLogger::generateRequestId() 
            : null;

        if ($method == 'GET' || $method == 'DELETE') {
            $url = $this->cloudConfig->url . $requestPath . (empty($params) ? '' : '?'.http_build_query($params));
        } else {
            $url = $this->cloudConfig->url . $requestPath;
        }

        // set body
        if(empty($params)) {
            $params = new stdClass();
        }
        $body = $method == 'POST' ? json_encode($params, JSON_UNESCAPED_SLASHES) : '';

        if ($auth == Auth::NONE) {
            $headers = CloudUtil::getHeader("", "", "", $this->cloudConfig->customHeaders);
        } else if ($auth == Auth::KEYED) {
            $headers = CloudUtil::getHeader($this->cloudConfig->accessKey, "", "", $this->cloudConfig->customHeaders);
        } else {
            $timestamp = round(microtime(true) * 1000);
            $sign = CloudUtil::signature($timestamp, $body, $this->cloudConfig);
            $headers = CloudUtil::getHeader($this->cloudConfig->accessKey, $sign, $timestamp, $this->cloudConfig->customHeaders);
        }

        try {

            // log request
            if ($this->cloudConfig->logger->isEnabled()) {
                $this->cloudConfig->logger->logRequest($method, $url, $headers, $body ?: null, $requestId);
            }


            $response = $this->client->request($method, $url, [
                RequestOptions::TIMEOUT => $this->cloudConfig->timeoutSecond,
                RequestOptions::HEADERS => $headers,
                RequestOptions::BODY => $body,
            ]);


            $code = $response->getStatusCode();
            $responseBody = (string)$response->getBody();


            $limit = [
                'Remaining' => $response->hasHeader(CloudConst::RATE_LIMIT_REMAINING) ? $response->getHeader(CloudConst::RATE_LIMIT_REMAINING)[0] : 0,
                'Limit' => $response->hasHeader(CloudConst::RATE_LIMIT_LIMIT) ? $response->getHeader(CloudConst::RATE_LIMIT_LIMIT)[0] : 0,
                'Reset' => $response->hasHeader(CloudConst::RATE_LIMIT_RESET) ? $response->getHeader(CloudConst::RATE_LIMIT_RESET)[0] : 0,
                'Mode' => $response->hasHeader(CloudConst::RATE_LIMIT_MODE) ? $response->getHeader(CloudConst::RATE_LIMIT_MODE)[0] : 0,
            ];

            $result = [
                'response' => json_decode($responseBody),
                'httpCode' => $code,
                'limit' => $limit,
            ];

            // log response
            if ($this->cloudConfig->logger->isEnabled()) {
                $this->cloudConfig->logger->logResponse($code, $responseBody, $limit, $requestId);
            }

            return $result;

        } catch (GuzzleException $e) {
            // log error
            if ($this->cloudConfig->logger->isEnabled()) {
                $this->cloudConfig->logger->logError("Request failed: " . $e->getMessage(), $e, $requestId);
            } else {
                // if logging is not enabled, use simple output (backward compatibility)
                echo "Exception:" . $e->getMessage();
            }
        }

        return [];
    }

}