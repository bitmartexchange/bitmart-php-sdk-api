[![Logo](https://img.bitmart.com/static-file/public/sdk/sdk_logo.png)](https://bitmart.com)



BitMart-PHP-SDK-API
=========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Telegram](https://img.shields.io/badge/Telegram-Join%20Us-blue?logo=Telegram)](https://t.me/bitmart_api)



[BitMart Exchange official](https://bitmart.com) PHP client for the BitMart Cloud API.




Feature
=========================
- Provides exchange quick trading API
- Easier withdrawal
- Efficiency, higher speeds, and lower latencies
- Priority in development and maintenance
- Dedicated and responsive technical support
- Provide webSocket apis calls
- Supported APIs:
  - `/spot/*`
  - `/contract/*`
  - `/account/*`
- Supported websockets:
  - Spot WebSocket Market Stream
  - Spot User Data Stream
  - futures User Data Stream
  - futures WebSocket Market Stream
- Test cases and examples



Installation
=========================

```php
composer require bitmartexchange/bitmart-php-sdk-api
```

Documentation
=========================
[API Documentation](https://developer-pro.bitmart.com/en/spot/#change-log)


Example
=========================
#### Spot Public API Example
```php
<?php
use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'timeoutSecond' => 5,
]));

// Get a list of all cryptocurrencies on the platform
$response = $APISpot->getCurrencies()['response'];
echo json_encode($response);
// Querying aggregated tickers of a particular trading pair
$response = $APISpot->getV3Ticker("BTC_USDT")['response'];
echo json_encode($response);
```


#### Spot / Margin Trading Endpoints

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

Please find example/spot/ folder to check for more endpoints.


---

#### Spot WebSocket Subscribe Private Channels


```php
<?php
use BitMart\Websocket\Spot\WsSpotPrv;
require_once __DIR__ . '/../../../vendor/autoload.php';
// Create Spot Websocket Client
$ws = new WsSpotPrv([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
    'callback' => function ($data) {
        echo "-------------------------" . PHP_EOL;
        print_r($data);
    },
]);

// Login
$ws->login();

// Subscribe Private Channels
$ws->send('{"op": "subscribe", "args": ["spot/user/balance:BALANCE_UPDATE"]}');

$ws->send('{"op": "subscribe", "args": ["spot/user/order:BTC_USDT"]}');



```


#### Spot WebSocket Subscribe Public Channels

```php
<?php
use BitMart\Websocket\Spot\WsSpotPub;
require_once __DIR__ . '/../../../vendor/autoload.php';
// Create Spot Websocket Client
$ws = new WsSpotPub([
    'callback' => function ($data) {
        echo "-------------------------".PHP_EOL;
        print_r($data);
    },
    'pong' => function ($data) {
        echo "-------------------------".$data.PHP_EOL;
    }
]);


// Subscribe Public Channels
$ws->send('{"op": "subscribe", "args": ["spot/ticker:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/kline1m:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/depth5:BTC_USDT"]}');
$ws->send('{"op": "subscribe", "args": ["spot/trade:BTC_USDT"]}');

```

Please find example/spot/Websocket/ folder to check for more endpoints.


---

#### Futures Market Data Endpoints

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



#### Futures Trading Endpoints


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


Please find example/futures/ folder to check for more endpoints.

---

#### Futures WebSocket Subscribe Private Channels


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
// Login
$ws->login();

// Subscribe Private Channels
$ws->send('{
    "action": "subscribe",
    "args":["futures/asset:USDT", "futures/asset:BTC", "futures/asset:ETH"]
}');
```


#### Futures WebSocket Subscribe Public Channels


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
// Subscribe Public Channels
$ws->send('{"action":"subscribe","args":["futures/ticker"]}');
$ws->send('{"action":"subscribe","args":["futures/depth20:BTCUSDT"]}');
$ws->send('{"action":"subscribe","args":["futures/trade:BTCUSDT"]}');
$ws->send('{"action":"subscribe","args":["futures/klineBin1m:BTCUSDT"]}');




```

Please find example/futures/Websocket/ folder to check for more endpoints.



Extra Options
=========================

### Authentication
How to set API KEY?

```php
$APISpot = new APISpot(new CloudConfig(
      [
          'accessKey' => "your_api_key",
          'secretKey' => "your_secret_key",
          'memo' => "your_memo",
      ]
  ));
```

### Timeout
Set HTTP `connection timeout` and `read timeout`.

```php
$APISpot = new APISpot(new CloudConfig(
      [
          'timeoutSecond' => 5
      ]
  ));
```

### Logging
If you want to `debug` the data requested by the API and the corresponding data returned by the API,
you can set it like this:

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

### Domain
How to set API domain name? The domain name parameter is optional,
the default domain name is `https://api-cloud.bitmart.com`.


```php
$APISpot = new APISpot(new CloudConfig(
      [
          'url' => 'https://api-cloud.bitmart.com'
      ]
  ));
```


### Custom request headers
You can add your own request header information here, but please do not fill in `X-BM-KEY, X-BM-SIGN, X-BM-TIMESTAMP`

```php
$APISpot = new APISpot(new CloudConfig([
    'customHeaders' => array(
        "Your-Custom-Header1" => "value1",
        "Your-Custom-Header2" => "value2",
    ),
]));
```


### Response Metadata

The bitmart API server provides the endpoint rate limit usage in the header of each response.
This information can be obtained from the headers property.
`x-bm-ratelimit-remaining` indicates the number of times the current window has been used,
`x-bm-ratelimit-limit` indicates the maximum number of times the current window can be used,
and `x-bm-ratelimit-reset` indicates the current window time.


##### Example:

```
x-bm-ratelimit-mode: IP
x-bm-ratelimit-remaining: 10
x-bm-ratelimit-limit: 600
x-bm-ratelimit-reset: 60
```

This means that this IP can call the endpoint 600 times within 60 seconds, and has called 10 times so far.


```php
$response = $APISpot->getV3Ticker("BTC_USDT");

echo $response['limit']['Remaining'];
echo $response['limit']['Limit'];
echo $response['limit']['Reset'];
echo $response['limit']['Mode'];

```