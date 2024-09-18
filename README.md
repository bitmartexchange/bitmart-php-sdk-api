[![Logo](https://img.bitmart.com/static-file/public/sdk/sdk_logo.png)](https://bitmart.com)



BitMart-PHP-SDK-API
=========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)



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
  - Spot WebSocket Market Stream
  - Spot User Data Stream
  - Contract User Data Stream
  - Contract WebSocket Market Stream
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

// Querying aggregated tickers of a particular trading pair
$response = $APISpot->getV3Ticker("BTC_USDT")['response'];

```


#### Spot / Margin Trading Endpoints

```php
<?php
use BitMart\Lib\CloudConfig;
use BitMart\Param\SpotOrderParam;
use BitMart\Spot\APISpot;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APISpot = new APISpot(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APISpot->postSubmitOrder(new SpotOrderParam([
    'symbol' => 'BTC_USDT',
    'side' => 'buy',
    'type' => 'limit',
    'size' => '0.1',
    'price' => '8800',
    'clientOrderId' => 'test20000000001'
]))['response'];

echo json_encode($response);

```

Please find example/spot/ folder to check for more endpoints.


---

#### Spot WebSocket Subscribe Private Channels


```php
<?php

use BitMart\Websocket\Spot\WsSpotPrv;

require_once __DIR__ . '/../../../vendor/autoload.php';

$ws = new WsSpotPrv([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
    'xdebug' => false
]);

// Subscribe Private Channels
$ws->subscribe(
    [
        'op' => "subscribe",
        'args' => [
            // Only Support Private Channel
            "spot/user/order:BTC_USDT",
        ]
    ],
    function ($data) {
        echo "-------------------------" . PHP_EOL;
        print_r($data);
    }
);

```


#### Spot WebSocket Subscribe Public Channels


```php
<?php
use BitMart\Websocket\Spot\WsSpotPub;

require_once __DIR__ . '/../../../vendor/autoload.php';

$ws = new WsSpotPub();

// Subscribe Public Channels
$ws->subscribe(
    [
        'op' => "subscribe",
        'args' => [
            // Only Support Public Channel
            "spot/ticker:BTC_USDT",
        ]
    ],
    function ($data) {
        echo "-------------------------" . PHP_EOL;
        echo print_r($data);
    }
);

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
use BitMart\Param\ContractOrderParam;

require_once __DIR__ . '/../../../vendor/autoload.php';

$APIContract = new APIContractTrading(new CloudConfig([
    'accessKey' => "<your_api_key>",
    'secretKey' => "<your_secret_key>",
    'memo' => "<your_memo>",
]));

$response = $APIContract->submitOrder(new ContractOrderParam([
    'symbol' => "BTCUSDT",
    'clientOrderId' => "test3000000001",
    'type' => "limit",
    'side' => 1,
    'leverage' => "1",
    'openType' => "isolated",
    'mode' => 1,
    'price' => "10",
    'size' => 1,
]))['response'];

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
]);


// Subscribe Public Channels
$ws->subscribe(
    [
        'action' => "subscribe",
        'args' => [
            "futures/asset:USDT"
        ]
    ],
    function ($data) {
        echo "-------------------------" . PHP_EOL;
        echo print_r($data);
    }
);

```


#### Futures WebSocket Subscribe Public Channels


```php
<?php

use BitMart\Websocket\Futures\WsContractPub;


include_once __DIR__ . '/../../../vendor/autoload.php';

$ws = new WsContractPub();


// Subscribe Public Channels
$ws->subscribe(
    [
        'action' => "subscribe",
        'args' => [
            // Only Support Public Channel
            "futures/ticker"
        ]
    ],
    function ($data) {
        echo "-------------------------" . PHP_EOL;
        echo print_r($data);
    }
);

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
          'xdebug' => true
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