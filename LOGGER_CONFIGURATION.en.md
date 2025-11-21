# CloudLogger Configuration Guide

## Overview

`CloudClient` now uses `CloudLogger` to replace the original `echo` and `print_r`, providing more flexible and configurable logging functionality.

## Configuration

### Method 1: Using logger configuration (Recommended)

Customize logging behavior through the `logger` configuration option:

```php
$config = new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "your_api_key",
    'secretKey' => "your_secret_key",
    'memo' => "your_memo",
    'logger' => [
        'enabled' => true,
        'outputToConsole' => true,
        'logFile' => __DIR__ . '/logs/api.log',  // Optional: save to file
    ]
]);
```

## Log Formats

### 1. default format (Default)

Structured log format with timestamp and formatted data:

```
[2024-01-01 12:00:00] REQUEST: [GET] https://api-cloud-v2.bitmart.com/contract/public/details
{
    "method": "GET",
    "url": "https://api-cloud-v2.bitmart.com/contract/public/details",
    "headers": {...}
}
--------------------------------------------------------------------------------
```

### 2. simple format

Concise format, compatible with the original xdebug output:

```
[GET] https://api-cloud-v2.bitmart.com/contract/public/details
RequestHeader:
Array
(
    ...
)
```

### 3. json format

JSON format for easy program parsing:

```json
{
    "timestamp": "2024-01-01 12:00:00",
    "requestId": "a1b2c3d4e5f6g7h8",
    "type": "request",
    "method": "GET",
    "url": "...",
    "headers": {...}
}
```

## Configuration Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `enabled` | bool | false | Whether to enable logging |
| `format` | string | 'default' | Log format: 'default', 'simple', 'json' |
| `outputToConsole` | bool | true | Whether to output to console |
| `outputToFile` | bool | false | Whether to output to file |
| `logFile` | string\|null | null | Log file path |

## Usage Examples

### Example 1: Basic usage (Testing environment)

```php
$config = new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "your_api_key",
    'secretKey' => "your_secret_key",
    'memo' => "your_memo",
    'logger' => [
        'enabled' => true,
        'outputToConsole' => true,
    ]
]);
```

### Example 2: Development environment (Detailed logs)

```php
$config = new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "your_api_key",
    'secretKey' => "your_secret_key",
    'memo' => "your_memo",
    'logger' => [
        'enabled' => true,
        'format' => 'default',
        'outputToConsole' => true,
    ]
]);
```

### Example 3: Production environment (Save to file, no console output)

```php
$config = new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "your_api_key",
    'secretKey' => "your_secret_key",
    'memo' => "your_memo",
    'logger' => [
        'enabled' => true,
        'format' => 'json',
        'logFile' => __DIR__ . '/logs/api-' . date('Y-m-d') . '.log',
        'outputToConsole' => false,  // No console output in production
        'outputToFile' => true,
    ]
]);
```

### Example 4: Unit tests

```php
// In the test's setUp method
protected function setUp(): void
{
    $this->APIContract = new APIContractTrading(new CloudConfig([
        'url' => CloudConst::API_URL_V2_PRO,
        'accessKey' => "your_api_key",
        'secretKey' => "your_secret_key",
        'memo' => "your_memo",
        'timeoutSecond' => 5,
        'logger' => [
            'enabled' => true,
            'format' => 'simple',  // Use simple format for easy viewing
            'outputToConsole' => true,
        ]
    ]));
}
```

## Backward Compatibility

- If logging is not enabled, exception information will still use simple `echo` output (backward compatible)
- If you need behavior similar to the original `xdebug => true`, use `logger => ['enabled' => true, 'format' => 'simple']`

## Notes

1. **Log file directory**: If `logFile` is specified, ensure the directory has write permissions
2. **Performance impact**: In production environments, it is recommended to disable detailed logging or only output to files
3. **Sensitive information**: Logs may contain sensitive information such as API keys, so protect log files accordingly
4. **Log rotation**: In production environments, it is recommended to configure log rotation to avoid log files becoming too large

## Environment Variable Configuration

You can control logging through environment variables:

```php
$config = new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => getenv('BITMART_API_KEY'),
    'secretKey' => getenv('BITMART_SECRET_KEY'),
    'memo' => getenv('BITMART_MEMO'),
    'logger' => [
        'enabled' => getenv('ENABLE_LOGGING') !== '0',
        'format' => getenv('LOG_FORMAT') ?: 'default',
        'logFile' => getenv('LOG_FILE') ?: null,
    ]
]);
```

## Migration Guide

### Migrating from older versions

**Old code (using xdebug):**
```php
$config = new CloudConfig([
    'xdebug' => true
]);
```

**New code (maintaining same behavior):**
```php
$config = new CloudConfig([
    'logger' => [
        'enabled' => true,
        'format' => 'simple',  // Use simple format to maintain original output style
        'outputToConsole' => true,
    ]
]);
```

**New code (using new features):**
```php
$config = new CloudConfig([
    'logger' => [
        'enabled' => true,
        'format' => 'default',  // Use more structured format
    ]
]);
```

