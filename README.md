[![Logo](logo.png)](https://bitmart.com)

BitMart-PHP-SDK-API
=========================
<p align="left">
    <a href='#'><img src='https://travis-ci.org/meolu/walle-web.svg?branch=master' alt="Build Status"></a>  
</p>

PHP client for the [BitMart Cloud API](http://developer-pro.bitmart.com).



Feature
=========================
- Provides exchange quick trading API
- Easier withdrawal
- Efficiency, higher speeds, and lower latencies
- Priority in development and maintenance
- Dedicated and responsive technical support
- Provide webSocket apis calls

Installation
=========================

* 1.Php 5.5+ support

* 2.Clone
```git
git clone https://github.com/bitmartexchange/bitmart-php-sdk-api.git
composer install
```

* 3.Run Test
[![Test](test.png)](#)

Usage
=========================
* An example of a spot trade API
* Replace it with your own API KEY
* Run


#### API Example
```php
<?php

namespace Tests;

use BitMart\APISpot;
use BitMart\CloudConfig;

class APISpotClient
{
    protected $APISpot;

    protected function __construct()
    {
        $this->APISpot = new APISpot(new CloudConfig(
            CloudConst::WS_URL_PRO, // Use Https Url: "https://api-cloud.bitmart.com"
            "Your Access Key",
            "Your Secret Key",
            "Your Memo"
        ));
    }

    public function testPostSubmitOrderLimitBuy()
    {
         $this->APISpot->postSubmitOrderLimitBuy(
            'BTC_USDT',
            '0.01',
            '9200'
        )['response']->code;
    }

}
```

#### WebSocket Example
```php
// Cli Run: php tests/BitMart/CloudWebsocketTest.php start
$cloudWebsocket = new CloudWebsocket(new CloudConfig(
     CloudConst::WS_URL_PRO, // Use WebSocket Url: "wss://ws-manager-compress.bitmart.com/api?protocol=1.1"
     "",
     "",
     ""
));

$cloudPrivateWebsocket = new CloudWebsocket(new CloudConfig(
     CloudConst::WS_URL_PRIVATE_PRO, // Use WebSocket Url: "wss://ws-manager-compress.bitmart.com/user?protocol=1.1"
     "Your Access Key",
     "Your Secret Key",
     "Your Memo"
));

// Subscribe Public Channels
$cloudWebsocket->subscribeWithoutLogin(
    [
        'op' => "subscribe",
        'args' => [
             // Public Channel
            "spot/ticker:BTC_USDT",
        ]
    ],
    function ($data) {
        echo "----------------\n";
        print_r($data);
        echo "----------------\n";
    }
);

// Subscribe Private Channels
$cloudPrivateWebsocket->subscribeWithLogin(
    [
        'op' => "subscribe",
        'args' => [
            // Private Channel
            "spot/user/order:BTC_USDT",
        ]
    ],
    function ($data) {
        echo "----------------\n";
        print_r($data);
        echo "----------------\n";
    }
);
```

Release Notes
=========================

###### 2020-07-16
- Interface Spot API `Cancel Order` update to v2 version that is `POST https://api-cloud.bitmart.com/spot/v2/cancel_order`
- UserAgent set "BitMart-PHP-SDK/1.0.1"


###### 2020-09-21
- Interface Spot API `/spot/v1/symbols/book` add `size` parameter, which represents the number of depths


###### 2021-01-19
- New endpoints for Spot WebSocket
    - Public - ticket channels
    - Public - K channel
    - Public - trading channels
    - Public - depth channels
    - Login
    - User - Trading Channel


###### 2021-11-06
- Update endpoints for Spot WebSocket
    - Public-Depth Channel:
        - spot/depth50     50 Level Depth Channel
        - spot/depth100    100 Level Depth Channel
    - User-Trade Channel:
        - Eligible pushes add new orders successfully


###### 2021-11-24
- New endpoints for Spot
    - <code>/spot/v2/orders</code>Get User Order History V2
    - <code>/spot/v1/batch_orders</code>Batch Order
- Update endpoints for Spot
    - <code>/spot/v1/symbols/kline</code>Add new field 'quote_volume'
    - <code>/spot/v1/symbols/trades</code>Add optional parameter N to return the number of items, the default is up to 50 items
    - <code>/spot/v1/order_detail</code>Add new field 'unfilled_volume'
    - <code>/spot/v1/submit_order</code>The request parameter type added limit_maker and ioc order types
- New endpoints for Account
    - <code>/account/v2/deposit-withdraw/history</code>Get Deposit And Withdraw  History V2
- Update endpoints for Account
    - <code>/account/v1/wallet</code>Remove the account_type,Only respond to currency accounts; you can bring currency parameters (optional)


###### 2022-01-18
- websocket public channel address<code>wss://ws-manager-compress.bitmart.com?protocol=1.1</code>will be taken down on 2022-02-28 UTC time,The new address is<code>wss://ws-manager-compress.bitmart.com/api?protocol=1.1</code>


###### 2022-01-20
- Update endpoints for Spot
    - <code>/spot/v1/symbols/details</code>Add a new respond parameter trade_status, to show the trading status of a trading pair symbol.
    
License
=========================
