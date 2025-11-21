<?php

namespace BitMart\Lib;

class CloudLogger
{
    // Instance properties
    private $enabled = false;
    private $logFile = null;
    private $format = 'default'; // 'default', 'simple' or 'json'
    private $outputToConsole = true;
    private $outputToFile = false;


    /**
    * Constructor - create an instance from a configuration array
     */
    public function __construct(array $config = [])
    {
        $this->enabled = $config['enabled'] ?? false;
        $this->logFile = $config['logFile'] ?? null;
        $this->format = $config['format'] ?? 'default';
        $this->outputToConsole = $config['outputToConsole'] ?? true;
        $this->outputToFile = (($config['logFile'] ?? null) !== null) || ($config['outputToFile'] ?? false);
    }

    /**
     * Check if logging is enabled
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }


    /**
     * Log the message to the console and file
     */
    public function log(string $message): void
    {
        if (!$this->enabled) {
            return;
        }

        $this->writeLog($message, "N/A");
    }

    /**
     * Log the request information
     */
    public function logRequest(string $method, string $url, array $headers = [], ?string $body = null, ?string $requestId = null): void
    {
        if (!$this->enabled) {
            return;
        }

        $logMessage = $this->formatRequest($method, $url, $headers, $body, $requestId);
        $this->writeLog($logMessage, $requestId);
    }

    /**
     * Log the response information
     */
    public function logResponse(int $httpCode, $responseBody, array $limit = [], ?string $requestId = null): void
    {
        if (!$this->enabled) {
            return;
        }

        // Convert response body to JSON string if it's an object or array
        $responseJson = is_string($responseBody) 
            ? $responseBody 
            : json_encode($responseBody, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        
        $logMessage = $this->formatResponse($httpCode, $responseJson, $limit, $requestId);
        $this->writeLog($logMessage, $requestId);
    }

    /**
     * Log the error information
     */
    public function logError(string $message, \Throwable $exception = null, ?string $requestId = null): void
    {
        if (!$this->enabled) {
            return;
        }

        $data = ['error' => $message];
        
        if ($exception !== null) {
            $data['exception'] = [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ];
        }

        $logMessage = $this->formatError($message, $data, $requestId);
        $this->writeLog($logMessage, $requestId);
    }

    /**
     * Generate a unique request ID
     */
    public static function generateRequestId(): string
    {
        return bin2hex(random_bytes(8));
    }

    /**
     * Format request log message based on format type
     */
    private function formatRequest(string $method, string $url, array $headers, ?string $body, ?string $requestId): string
    {
        switch ($this->format) {
            case 'json':
                $data = [
                    'timestamp' => date('Y-m-d H:i:s'),
                    'requestId' => $requestId,
                    'type' => 'request',
                    'method' => $method,
                    'url' => $url,
                    'headers' => $headers,
                ];
                if ($body) {
                    $data['body'] = $body;
                }
                return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
            
            case 'simple':
                // Simple format (compatible with xdebug format)
                $logMessage = '[' . $method . '] ' . $url . PHP_EOL;
                $logMessage .= 'RequestHeader:' . PHP_EOL;
                $logMessage .= print_r($headers, true);
                if ($body) {
                    $logMessage .= 'RequestBody:' . $body . PHP_EOL;
                }
                return $logMessage;
            
            case 'default':
            default:
                // Default format - structured with separators
                $logMessage = 'REQUEST: [' . $method . '] ' . $url . PHP_EOL;
                $logMessage .= 'RequestHeader:' . PHP_EOL;
                $logMessage .= json_encode($headers, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
                if ($body) {
                    $logMessage .= 'RequestBody:' . PHP_EOL;
                    $logMessage .= $body . PHP_EOL;
                }
                $logMessage .= str_repeat('-', 80) . PHP_EOL;
                return $logMessage;
        }
    }

    /**
     * Format response log message based on format type
     */
    private function formatResponse(int $httpCode, string $responseJson, array $limit, ?string $requestId): string
    {
        switch ($this->format) {
            case 'json':
                $data = [
                    'timestamp' => date('Y-m-d H:i:s'),
                    'requestId' => $requestId,
                    'type' => 'response',
                    'httpCode' => $httpCode,
                    'response' => json_decode($responseJson, true),
                    'limit' => $limit,
                ];
                return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
            
            case 'simple':
                // Simple format
                return '--Response' . PHP_EOL . $responseJson . PHP_EOL . '----------------------------' . PHP_EOL;
            
            case 'default':
            default:
                // Default format - structured with separators
                $logMessage = 'RESPONSE: HTTP ' . $httpCode . PHP_EOL;
                $logMessage .= 'ResponseBody:' . PHP_EOL;
                $logMessage .= $responseJson . PHP_EOL;
                if (!empty($limit)) {
                    $logMessage .= 'RateLimit: ' . json_encode($limit, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
                }
                $logMessage .= str_repeat('-', 80) . PHP_EOL;
                return $logMessage;
        }
    }

    /**
     * Format error log message based on format type
     */
    private function formatError(string $message, array $data, ?string $requestId): string
    {
        switch ($this->format) {
            case 'json':
                $errorData = [
                    'timestamp' => date('Y-m-d H:i:s'),
                    'requestId' => $requestId,
                    'type' => 'error',
                    'message' => $message,
                    'data' => $data,
                ];
                return json_encode($errorData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
            
            case 'simple':
                // Simple format
                return 'ERROR: ' . $message . PHP_EOL . json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
            
            case 'default':
            default:
                // Default format - structured with separators
                $logMessage = 'ERROR: ' . $message . PHP_EOL;
                $logMessage .= json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
                $logMessage .= str_repeat('-', 80) . PHP_EOL;
                return $logMessage;
        }
    }

    /**
     * Write log message to console and file
     */
    private function writeLog(string $logMessage, ?string $requestId = null): void
    {
        // For json format, timestamp and requestId are already included in the message
        // For other formats, add timestamp and request ID
        if ($this->format !== 'json') {
            $timestamp = date('Y-m-d H:i:s');
            $requestIdPart = $requestId ? ' [RequestID: ' . $requestId . ']' : '';
            $logMessage = '[' . $timestamp . ']' . $requestIdPart . ' ' . $logMessage;
        }
        
        // Output to console
        if ($this->outputToConsole) {
            echo $logMessage;
        }
        
        // Output to file
        if ($this->outputToFile && $this->logFile !== null) {
            $logDir = dirname($this->logFile);
            if (!is_dir($logDir) && $logDir !== '.') {
                @mkdir($logDir, 0755, true);
            }
            file_put_contents($this->logFile, $logMessage, FILE_APPEND);
        }
    }

}

