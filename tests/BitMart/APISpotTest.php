<?php

namespace BitMart;

use PHPUnit\Framework\TestCase;

class APISpotTest extends TestCase
{
    protected $APISpot;

    protected function setUp()
    {
        $this->APISpot = new APISpot(new CloudConfig(
            CloudConst::API_URL_TEST,
            "80618e45710812162b04892c7ee5ead4a3cc3e56",
            "6c6c98544461bbe71db2bca4c6d7fd0021e0ba9efc215f9c6ad41852df9d9df9",
            "test001"
        ));
    }

    // ------------ Public API

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

    public function testGetKlineStep()
    {
        $this->assertEquals(1000, $this->APISpot->getKlineStep()['response']->code);
    }

    public function testGetSymbolKline()
    {
        $this->assertEquals(1000, $this->APISpot->getSymbolKline(
            'BTC_USDT',
            1591789435,
            1591875835,
            60
        )['response']->code);
    }

    public function testGetSymbolBook()
    {
        $this->assertEquals(1000, $this->APISpot->getSymbolBook(
            'BTC_USDT',
            null // Or 6,7,8
        )['response']->code);
    }

    public function testGetSymbolTrades()
    {
        $this->assertEquals(1000, $this->APISpot->getSymbolTrades(
            'BTC_USDT'
        )['response']->code);
    }


    // ------------ Balance API

    public function testGetWallet()
    {
        $this->assertEquals(1000, $this->APISpot->getWallet()['response']->code);
    }



    // ------------ Trading API

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

    public function testPostCancelOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelOrder(
            'BTC_USDT',
            2147622493
        )['response']->code);
    }

    public function testPostCancelAllOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelAllOrder(
            'BTC_USDT',
            'buy'
        )['response']->code);
    }

    public function testGetOrderDetail()
    {
        $this->assertEquals(1000, $this->APISpot->getOrderDetail(
            'BTC_USDT',
            2147622493
        )['response']->code);
    }

    public function testGetUserOrder()
    {
        $this->assertEquals(1000, $this->APISpot->getUserOrder(
            'BTC_USDT',
            '1',
            1,
            10
        )['response']->code);
    }

    public function testGetUserTrade()
    {
        $this->assertEquals(1000, $this->APISpot->getUserTrade(
            'BTC_USDT',
            1,
            10
        )['response']->code);
    }

    public function testGetUserOrderTrade()
    {
        $this->assertEquals(1000, $this->APISpot->getUserOrderTrade(
            'BTC_USDT',
            2147622493
        )['response']->code);
    }



}
