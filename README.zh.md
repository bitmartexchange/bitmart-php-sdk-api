[![Logo](https://img.bitmart.com/static-file/public/sdk/sdk_logo.png)](https://bitmart.com)



BitMart-PHP-SDK-API
=========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Telegram](https://img.shields.io/badge/Telegram-Join%20Us-blue?logo=Telegram)](https://t.me/bitmart_api)



[BitMart 交易所官方](https://bitmart.com) PHP 客户端，用于 BitMart 云 API。




功能特性
=========================
- 提供交易所快速交易 API
- 更便捷的提现功能
- 高效、高速、低延迟
- 优先开发和维护
- 专业且响应迅速的技术支持
- 提供 WebSocket API 调用
- 支持的 API：
  - `/spot/*`
  - `/contract/*`
  - `/account/*`
- 支持的 WebSocket：
  - 现货 WebSocket 市场数据流
  - 现货用户数据流
  - 合约用户数据流
  - 合约 WebSocket 市场数据流
- 测试用例和示例代码



安装
=========================

```php
composer require bitmartexchange/bitmart-php-sdk-api
```

文档
=========================
[API 文档](https://developer-pro.bitmart.com/en/spot/#change-log)


示例
=========================
#### 现货公共 API 示例
```php
<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'timeoutSecond' => 5,
]));

// 获取平台上所有加密货币列表
$response = $APISpot->getCurrencies()['response'];
echo json_encode($response);
// 查询特定交易对的聚合行情
$response = $APISpot->getV3Ticker("BTC_USDT")['response'];
echo json_encode($response);
```


#### 现货/杠杆交易接口

```php
<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));


$response = $APISpot->postSubmitOrder(
    'BTC_USDT',
    'buy',
    'limit',
    [
        'size' => '0.1',
        'price' => '8800',
        'client_order_id' => 'test20000000005'
    ]
)['response'];

echo json_encode($response);


$response = $APISpot->postSubmitOrder(
    'BTC_USDT',
    'buy',
    'market',
    [
        'size' => '0.1',
        'notional' => '8800',
        'client_order_id' => 'test20000000006'
    ]
)['response'];

echo json_encode($response);

```

更多接口示例请查看 [example/spot/Trading](https://github.com/bitmartexchange/bitmart-php-sdk-api/tree/master/examples/spot/Trading) 文件夹。


---

#### 现货 WebSocket 订阅私有频道


```php
<?php
use BitMart\Websocket\Spot\WsSpotPrv;
require_once __DIR__ . '/../../../vendor/autoload.php';
// 创建现货 WebSocket 客户端
$ws = new WsSpotPrv([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
    'callback' => function ($data) {
        echo "-------------------------" . PHP_EOL;
        print_r($data);
    },
]);

// 登录
$ws->login();

// 订阅私有频道
$ws->send('{"op": "subscribe", "args": ["spot/user/balance:BALANCE_UPDATE"]}');

$ws->send('{"op": "subscribe", "args": ["spot/user/order:BTC_USDT"]}');



```


#### 现货 WebSocket 订阅公共频道

```php
<?php
use BitMart\Websocket\Spot\WsSpotPub;
require_once __DIR__ . '/../../../vendor/autoload.php';
// 创建现货 WebSocket 客户端
$ws = new WsSpotPub([
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
    'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);


// 订阅公共频道
$ws->send('{"op": "subscribe", "args": ["spot/ticker:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/kline1m:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/depth5:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/trade:BTC_USDT"]}');

```

更多接口示例请查看 [example/spot/Websocket/](https://github.com/bitmartexchange/bitmart-php-sdk-api/tree/master/examples/spot/Websocket) 文件夹。


---

#### 合约市场数据接口

```php
<?php

use BitMart\Futures\APIContractMarket;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractMarket(new CloudConfig([
    'timeoutSecond' => 5,
]));

$response = $APIContract->getContractDetails("BTCUSDT")['response'];

echo json_encode($response);

```



#### 合约交易接口


```php
<?php

use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->submitOrder(
    'BTCUSDT',
    1,
    [
        'client_order_id' => "test3000000001",
        'type' => "limit",
        'leverage' => "1",
        'open_type' => "isolated",
        'mode' => 1,
        'price' => "10",
        'size' => 1,
    ]
)['response'];

echo json_encode($response);
```


更多接口示例请查看 [example/futures/Trading](https://github.com/bitmartexchange/bitmart-php-sdk-api/tree/master/examples/futures/Trading) 文件夹。

---

#### 合约 WebSocket 订阅私有频道


```php
<?php
use BitMart\Websocket\Futures\WsContractPrv;
include_once __DIR__ . '/../../../vendor/autoload.php';
$ws = new WsContractPrv([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
    'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);
// 登录
$ws->login();

// 订阅私有频道
$ws->send('{
    "action": "subscribe",
    "args":["futures/asset:USDT", "futures/asset:BTC", "futures/asset:ETH"]
}');
```


#### 合约 WebSocket 订阅公共频道


```php
<?php
use BitMart\Websocket\Futures\WsContractPub;
include_once __DIR__ . '/../../../vendor/autoload.php';
$ws = new WsContractPub([
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
        'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);
// 订阅公共频道
$ws->send('{"action":"subscribe","args":["futures/ticker"]}');
$ws->send('{"action":"subscribe","args":["futures/depth20:BTCUSDT"]}');
$ws->send('{"action":"subscribe","args":["futures/trade:BTCUSDT"]}');
$ws->send('{"action":"subscribe","args":["futures/klineBin1m:BTCUSDT"]}');




```

更多接口示例请查看 [example/futures/Websocket/](https://github.com/bitmartexchange/bitmart-php-sdk-api/tree/master/examples/futures/Websocket) 文件夹。



额外配置选项
=========================

### 身份验证
如何设置 API KEY？

```php
$APISpot = new APISpot(new CloudConfig(
      [
          'accessKey' => "your_api_key",
          'secretKey' => "your_secret_key",
          'memo' => "your_memo",
      ]
  ));
```

### 超时设置
设置 HTTP `连接超时` 和 `读取超时`。

```php
$APISpot = new APISpot(new CloudConfig(
      [
          'timeoutSecond' => 5
      ]
  ));
```

### 日志记录
如果您想要 `调试` API 请求的数据和 API 返回的相应数据，
可以这样设置：

```php
$APISpot = new APISpot(new CloudConfig(
      [
          'logger' => [
              'enabled' => true,
              'outputToConsole' => true,
              'outputToFile' => true,
              'logFile' => __DIR__ . '/../../../logs/test.log',
          ]
      ]
  ));
```

### 域名设置
如何设置 API 域名？域名参数是可选的，
默认域名是 `https://api-cloud.bitmart.com`。


```php
$APISpot = new APISpot(new CloudConfig(
      [
          'url' => 'https://api-cloud.bitmart.com'
      ]
  ));
```


### 自定义请求头
您可以在此处添加您自己的请求头信息，但请不要填写 `X-BM-KEY, X-BM-SIGN, X-BM-TIMESTAMP`

```php
$APISpot = new APISpot(new CloudConfig([
    'customHeaders' => array(
        "Your-Custom-Header1" => "value1",
        "Your-Custom-Header2" => "value2",
    ),
]));
```


### 响应元数据

BitMart API 服务器在每个响应的响应头中提供端点速率限制使用情况。
此信息可以从 headers 属性中获取。
`x-bm-ratelimit-remaining` 表示当前窗口已使用的次数，
`x-bm-ratelimit-limit` 表示当前窗口可以使用的最大次数，
`x-bm-ratelimit-reset` 表示当前窗口时间。


##### 示例：

```
x-bm-ratelimit-mode: IP
x-bm-ratelimit-remaining: 10
x-bm-ratelimit-limit: 600
x-bm-ratelimit-reset: 60
```

这表示此 IP 在 60 秒内可以调用该端点 600 次，目前已调用 10 次。


```php
$response = $APISpot->getV3Ticker("BTC_USDT");

echo $response['limit']['Remaining'];
echo $response['limit']['Limit'];
echo $response['limit']['Reset'];
echo $response['limit']['Mode'];

```

