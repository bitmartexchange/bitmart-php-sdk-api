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
     * Whether the project .env file has already been parsed
     * @var bool
     */
    private static $envLoaded = false;

    /**
     * Parsed key/value pairs from the project .env file
     * @var array
     */
    private static $envCache = [];

    /**
     * Parse the project root .env file (once) into the static cache.
     *
     * The .env file is OPTIONAL and is NOT committed to git. Lines are
     * `KEY=VALUE`; blank lines and lines starting with `#` are ignored;
     * an optional leading `export ` is stripped; surrounding single/double
     * quotes around the value are removed. This loader does not modify the
     * process environment (no putenv) to avoid global side effects.
     *
     * @return void
     */
    private static function loadEnv(): void
    {
        if (self::$envLoaded) {
            return;
        }
        self::$envLoaded = true;

        $path = dirname(__DIR__) . '/.env';
        if (!is_file($path) || !is_readable($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }
            if (strpos($line, '=') === false) {
                continue;
            }

            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            if (strncmp($key, 'export ', 7) === 0) {
                $key = trim(substr($key, 7));
            }
            if ($key === '') {
                continue;
            }

            $value = trim($value);
            $len = strlen($value);
            if ($len >= 2) {
                $first = $value[0];
                $last = $value[$len - 1];
                if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                    $value = substr($value, 1, -1);
                }
            }

            self::$envCache[$key] = $value;
        }
    }

    /**
     * Resolve a configuration value with the precedence:
     * .env file > system environment variable (getenv) > provided default.
     * Empty values are treated as "not set" and fall through to the next layer.
     *
     * @param string $key Environment key (e.g. BITMART_API_KEY)
     * @param mixed $default Fallback value when not found in .env or env vars
     * @return mixed
     */
    private static function env(string $key, $default = null)
    {
        self::loadEnv();

        if (isset(self::$envCache[$key]) && self::$envCache[$key] !== '') {
            return self::$envCache[$key];
        }

        $value = getenv($key);
        if ($value !== false && $value !== '') {
            return $value;
        }

        return $default;
    }

    /**
     * Get CloudConfig for Spot API tests
     * 
     * @param array $options Additional configuration options to override defaults
     * @return CloudConfig
     */
    public static function getSpotConfig(array $options = []): CloudConfig
    {
        $defaultConfig = [
            'url' => self::env('BITMART_API_URL', self::URL_V1),
            'accessKey' => self::env('BITMART_API_KEY', self::DEFAULT_ACCESS_KEY),
            'secretKey' => self::env('BITMART_SECRET_KEY', self::DEFAULT_SECRET_KEY),
            'memo' => self::env('BITMART_MEMO', self::DEFAULT_MEMO),
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
            'url' => self::env('BITMART_API_URL', self::URL_V2),
            'accessKey' => self::env('BITMART_API_KEY', self::DEFAULT_ACCESS_KEY),
            'secretKey' => self::env('BITMART_SECRET_KEY', self::DEFAULT_SECRET_KEY),
            'memo' => self::env('BITMART_MEMO', self::DEFAULT_MEMO),
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

