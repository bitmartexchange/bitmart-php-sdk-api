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
            "https://api-cloud.bitmart.com", // Ues Https Url
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

Release Notes
=========================

###### 2020-07-16 
- Interface Spot API `Cancel Order` update to v2 version that is `POST https://api-cloud.bitmart.com/spot/v2/cancel_order`
- UserAgent set "BitMart-PHP-SDK/1.0.1"
             
         
###### 2020-09-21
- Interface Spot API `/spot/v1/symbols/book` add `size` parameter, which represents the number of depths

    
License
=========================
