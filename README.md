[![Logo](logo.png)](https://bitmart.com)

BitMart-PHP-SDK-API
=========================
<p align="left">
    <a href='#'><img src='https://travis-ci.org/meolu/walle-web.svg?branch=master' alt="Build Status"></a>  
</p>

PHP client for the [BitMart Cloud API](http://developer-pro.bitmart.com).



Feature
=========================
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
            "https://api-cloud.bitmart.com",
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


License
=========================
