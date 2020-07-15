<?php

namespace BitMart;

use PHPUnit\Framework\TestCase;

class APISpotTest extends TestCase
{
    protected $APISpot;

    protected function setUp()
    {
        $this->APISpot = new APISpot(new CloudConfig(
            "http://api-cloud.bitmartdev.com",
            "80618e45710812162b04892c7ee5ead4a3cc3e56",
            "6c6c98544461bbe71db2bca4c6d7fd0021e0ba9efc215f9c6ad41852df9d9df9",
            "test001"
        ));
    }

    public function testGetCurrencies()
    {
        $this->assertEquals(1000, $this->APISpot->getCurrencies()['response']->code);
    }

    public function testGetSymbol()
    {
        $this->assertEquals(1000, $this->APISpot->getSymbol()['response']->code);
    }

    public function testGetSymbolDetail()
    {
        $this->assertEquals(1000, $this->APISpot->getSymbolDetail()['response']->code);
    }



    public function testGetTicker()
    {
        $this->assertEquals(1000, $this->APISpot->getTicker()['response']->code);
    }

    public function testGetSymbolTicker()
    {
        $this->assertEquals(1000, $this->APISpot->getSymbolTicker('BTC_USDT')['response']->code);
    }


    public function testPostSubmitOrderLimitBuy()
    {
        $this->assertEquals(1000, $this->APISpot->postSubmitOrderLimitBuy(
            'BTC_USDT',
            '0.01',
            '9200'
        )['response']->code);
    }

    public function testPostSubmitOrderLimitSell()
    {
        $this->assertEquals(1000, $this->APISpot->postSubmitOrderLimitSell(
            'BTC_USDT',
            '0.01',
            '9200'
        )['response']->code);
    }


    public function testPostSubmitOrderMarketBuy()
    {
        $this->assertEquals(1000, $this->APISpot->postSubmitOrderMarketBuy(
            'BTC_USDT',
            '10'
        )['response']->code);
    }


    public function testPostSubmitOrderMarketSell()
    {
        $this->assertEquals(1000, $this->APISpot->postSubmitOrderMarketSell(
            'BTC_USDT',
            '0.01'
        )['response']->code);
    }


}
