<?php

namespace BitMart\Tests;

use BitMart\CloudConst;
use BitMart\Lib\CloudConfig;

/**
 * Test configuration constants and helpers
 * 
 * This class provides unified CloudConfig instances for Spot and Futures tests
 */
class TestConfig
{
    /**
     * Default API credentials for testing
     * These should be replaced with actual test credentials or environment variables
     */
    const DEFAULT_ACCESS_KEY = "your_api_key";
    const DEFAULT_SECRET_KEY = "your_secret_key";
    const DEFAULT_MEMO = "your_memo";
    const DEFAULT_TIMEOUT = 5;
    const URL_V1 = CloudConst::API_URL_PRO;
    const URL_V2 = CloudConst::API_URL_V2_PRO;

    /**
     * Get CloudConfig for Spot API tests
     * 
     * @param array $options Additional configuration options to override defaults
     * @return CloudConfig
     */
    public static function getSpotConfig(array $options = []): CloudConfig
    {
        $defaultConfig = [
            'url' => self::URL_V1,
            'accessKey' => self::DEFAULT_ACCESS_KEY,
            'secretKey' => self::DEFAULT_SECRET_KEY,
            'memo' => self::DEFAULT_MEMO,
            'timeoutSecond' => self::DEFAULT_TIMEOUT,
            'logger' => [
                'enabled' => true,
                'format' => 'simple',
                'outputToConsole' => true,
                'outputToFile' => true,
                'logFile' => dirname(__DIR__) . '/logs/unit_test_spot.log',
            ],
            'customHeaders' => array(
                "Your-Custom-Header1" => "value1",
                "Your-Custom-Header2" => "value2",
            ),
        ];

        // Merge with provided options (options take precedence)
        $config = array_merge($defaultConfig, $options);
        
        // Deep merge for logger config
        if (isset($options['logger']) && is_array($options['logger'])) {
            $config['logger'] = array_merge($defaultConfig['logger'], $options['logger']);
        }

        return new CloudConfig($config);
    }

    /**
     * Get CloudConfig for Futures API tests
     * 
     * @param array $options Additional configuration options to override defaults
     * @return CloudConfig
     */
    public static function getFuturesConfig(array $options = []): CloudConfig
    {
        $defaultConfig = [
            'url' => self::URL_V2,
            'accessKey' => self::DEFAULT_ACCESS_KEY,
            'secretKey' => self::DEFAULT_SECRET_KEY,
            'memo' => self::DEFAULT_MEMO,
            'timeoutSecond' => self::DEFAULT_TIMEOUT,
            'logger' => [
                'enabled' => true,
                'format' => 'simple',
                'outputToConsole' => true,
                'outputToFile' => true,
                'logFile' => dirname(__DIR__) . '/logs/test_futures.log',
            ],
        ];

        // Merge with provided options (options take precedence)
        $config = array_merge($defaultConfig, $options);
        
        // Deep merge for logger config
        if (isset($options['logger']) && is_array($options['logger'])) {
            $config['logger'] = array_merge($defaultConfig['logger'], $options['logger']);
        }

        return new CloudConfig($config);
    }

}

