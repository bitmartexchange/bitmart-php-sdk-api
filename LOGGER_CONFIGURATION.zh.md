# CloudLogger 配置指南

## 概述

`CloudClient` 现在使用 `CloudLogger` 替代了原来的 `echo` 和 `print_r`，提供了更灵活和可配置的日志功能。

## 配置方式

### 方式 1: 使用 logger 配置（推荐）

通过 `logger` 配置项自定义日志行为：

```php
$config = new CloudConfig([
    'url' => CloudConst::API_URL_V2_PRO,
    'accessKey' => "your_api_key",
    'secretKey' => "your_secret_key",
    'memo' => "your_memo",
    'logger' => [
        'enabled' => true,
        'outputToConsole' => true,
        'logFile' => __DIR__ . '/logs/api.log',  // 可选：保存到文件
    ]
]);
```

## 日志格式

### 1. default 格式（默认）

结构化的日志格式，包含时间戳和格式化数据：

```
[2024-01-01 12:00:00] REQUEST: [GET] https://api-cloud-v2.bitmart.com/contract/public/details
{
    "method": "GET",
    "url": "https://api-cloud-v2.bitmart.com/contract/public/details",
    "headers": {...}
}
--------------------------------------------------------------------------------
```

### 2. simple 格式

简洁格式，兼容原有的 xdebug 输出：

```
[GET] https://api-cloud-v2.bitmart.com/contract/public/details
RequestHeader:
Array
(
    ...
)
```

### 3. json 格式

JSON 格式，便于程序解析：

```json
{
    "timestamp": "2024-01-01 12:00:00",
    "message": "REQUEST: [GET] https://api-cloud-v2.bitmart.com/contract/public/details",
    "data": {
        "method": "GET",
        "url": "...",
        "headers": {...}
    }
}
```

## 配置选项说明

| 选项 | 类型 | 默认值 | 说明 |
|------|------|--------|------|
| `enabled` | bool | false | 是否启用日志 |
| `format` | string | 'default' | 日志格式：'default', 'simple', 'json' |
| `outputToConsole` | bool | true | 是否输出到控制台 |
| `outputToFile` | bool | false | 是否输出到文件 |
| `logFile` | string\|null | null | 日志文件路径 |

## 使用示例

### 示例 1: 基本使用（测试环境）

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

### 示例 2: 开发环境（详细日志）

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

### 示例 3: 生产环境（保存到文件，不输出到控制台）

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
        'outputToConsole' => false,  // 生产环境不输出到控制台
        'outputToFile' => true,
    ]
]);
```

### 示例 4: 单元测试

```php
// 在测试的 setUp 方法中
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
            'format' => 'simple',  // 使用简单格式，便于查看
            'outputToConsole' => true,
        ]
    ]));
}
```

## 向后兼容性

- 如果未启用日志，异常信息仍会使用简单的 `echo` 输出（向后兼容）
- 如果需要类似原来 `xdebug => true` 的行为，使用 `logger => ['enabled' => true, 'format' => 'simple']`

## 注意事项

1. **日志文件目录**：如果指定了 `logFile`，确保目录有写权限
2. **性能影响**：在生产环境建议禁用详细日志或只输出到文件
3. **敏感信息**：日志可能包含 API 密钥等敏感信息，注意保护日志文件
4. **日志轮转**：生产环境建议配置日志轮转，避免日志文件过大

## 环境变量配置

可以通过环境变量控制日志：

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

## 迁移指南

### 从旧版本迁移

**旧代码（使用 xdebug）：**
```php
$config = new CloudConfig([
    'xdebug' => true
]);
```

**新代码（保持相同行为）：**
```php
$config = new CloudConfig([
    'logger' => [
        'enabled' => true,
        'format' => 'simple',  // 使用简单格式，保持原有输出风格
        'outputToConsole' => true,
    ]
]);
```

**新代码（使用新功能）：**
```php
$config = new CloudConfig([
    'logger' => [
        'enabled' => true,
        'format' => 'default',  // 使用更结构化的格式
    ]
]);
```

