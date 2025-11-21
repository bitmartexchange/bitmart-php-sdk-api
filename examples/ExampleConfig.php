<?php

use BitMart\CloudConst;
use BitMart\Lib\CloudConfig;

/**
 * Example configuration helper class
 * 
 * Provides default CloudConfig instances for examples
 */
class ExampleConfig
{
    /**
     * Default API credentials for examples
     * Replace these with your actual API credentials
     */
    const DEFAULT_ACCESS_KEY = "your_api_key";
    const DEFAULT_SECRET_KEY = "your_secret_key";
    const DEFAULT_MEMO = "your_memo";
    const DEFAULT_TIMEOUT = 5;
    const DEFAULT_URL = CloudConst::API_URL_V2_PRO;


    /**
     * Get CloudConfig for API examples
     * 
     * @param array $options Configuration options:
     *   - 'accessKey' => string (optional, defaults to DEFAULT_ACCESS_KEY)
     *   - 'secretKey' => string (optional, defaults to DEFAULT_SECRET_KEY)
     *   - 'memo' => string (optional, defaults to DEFAULT_MEMO)
     *   - 'logger' => array (optional, logger configuration)
     *   - 'url' => string (optional, defaults to API_URL_V2_PRO)
     *   - 'timeoutSecond' => int (optional, defaults to 5)
     *   - 'customHeaders' => array (optional)
     * @return CloudConfig
     */
    public static function getExampleConfig(array $options = []): CloudConfig
    {
        $defaultConfig = [
            'url' => $options['url'] ?? self::DEFAULT_URL,
            'accessKey' => $options['accessKey'] ?? self::DEFAULT_ACCESS_KEY,
            'secretKey' => $options['secretKey'] ?? self::DEFAULT_SECRET_KEY,
            'memo' => $options['memo'] ?? self::DEFAULT_MEMO,
            'timeoutSecond' => $options['timeoutSecond'] ?? self::DEFAULT_TIMEOUT,
            'logger' => [
                'enabled' => true,
                'format' => 'default',
                'outputToConsole' => true,
            ],
        ];

        // Merge with provided options
        $config = array_merge($defaultConfig, $options);
        
        // Deep merge for logger config
        if (isset($options['logger']) && is_array($options['logger'])) {
            $config['logger'] = array_merge($defaultConfig['logger'], $options['logger']);
        }

        return new CloudConfig($config);
    }

}

