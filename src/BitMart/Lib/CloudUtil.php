<?php


namespace BitMart\Lib;


use BitMart\CloudConst;

class CloudUtil
{

    public static function getHeader($apiKey, $sign, $timestamp, $customHeaders): array
    {
        $headers = array();

        $headers[CloudConst::CONTENT_TYPE] = CloudConst::APPLICATION_JSON;
        $headers[CloudConst::USER_AGENT] = CloudConst::VERSION;

        if ($apiKey) {
            $headers[CloudConst::X_BM_KEY] = $apiKey;
        }

        if ($sign) {
            $headers[CloudConst::X_BM_SIGN] = $sign;
        }

        if ($timestamp) {
            $headers[CloudConst::X_BM_TIMESTAMP] = $timestamp;
        }

        foreach ($customHeaders as $key => $value) {
            $headers[$key] = $value;
        }

        return $headers;
    }

    public static function signature($timestamp, $queryString, $cloudConfig): string
    {
        $message = $timestamp . "#" . $cloudConfig->memo . "#" . $queryString;

        return hash_hmac('sha256', $message, $cloudConfig->secretKey, false);
    }

}