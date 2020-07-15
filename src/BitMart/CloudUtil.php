<?php


namespace BitMart;


class CloudUtil
{
    public static function getTimestamp()
    {
        list($s1, $s2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }

    public static function getHeader($apiKey, $sign, $timestamp)
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

        return $headers;
    }

    public static function signature($timestamp, $queryString, $cloudConfig)
    {
        $message = $timestamp . "#" . $cloudConfig->memo . "#" . $queryString;

        return hash_hmac('sha256', $message, $cloudConfig->secretKey, false);
    }

}