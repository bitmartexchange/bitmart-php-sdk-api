<?php

namespace BitMart\Tests;

use BitMart\Lib\CloudConfig;
use BitMart\Param\SpotOrderParam;
use BitMart\Param\MarginOrderParam;
use BitMart\Spot\APISpot;
use PHPUnit\Framework\TestCase;

class APISpotTest extends TestCase
{
    protected $APISpot;

    protected function setUp(): void
    {
        $this->APISpot = new APISpot(new CloudConfig(
            [
                'accessKey' => "your_api_key",
                'secretKey' => "your_secret_key",
                'memo' => "your_memo",
                'timeoutSecond' => 5,
                'xdebug' => true
            ]
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

    public function testGetV3Tickers()
    {
        $this->assertEquals(1000, $this->APISpot->getV3Tickers()['response']->code);
    }

    public function testGetV3Ticker()
    {
        $this->assertEquals(1000, $this->APISpot->getV3Ticker('BTC_USDT')['response']->code);
    }

    public function testGetKlineStep()
    {
        $this->assertEquals(1000, $this->APISpot->getKlineStep()['response']->code);
    }

    public function testGetV3LatestKline()
    {
        $before = round(microtime(true));
        $after = $before - (60*60);
        $this->assertEquals(1000, $this->APISpot->getV3LatestKline(
            'BTC_USDT',
            $before,
            $after,
            15,
            1
        )['response']->code);
    }

    public function testGetV3HistoryKline()
    {
        $before = round(microtime(true));
        $after = $before - (60*60);
        $this->assertEquals(1000, $this->APISpot->getV3HistoryKline(
            'BTC_USDT',
            $before,
            $after,
            15,
            1
        )['response']->code);
    }

    public function testGetV3Book()
    {
        $this->assertEquals(1000, $this->APISpot->getV3Book(
            'BTC_USDT',
            5
        )['response']->code);
    }

    public function testGetV3Trades()
    {
        $this->assertEquals(1000, $this->APISpot->getV3Trades(
            'BTC_USDT',
            1
        )['response']->code);
    }


    // ------------ Balance API

    public function testGetWallet()
    {
        $this->assertEquals(1000, $this->APISpot->getWallet()['response']->code);
    }


    // ------------ Trading API

    public function testPostSubmitOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postSubmitOrder(new SpotOrderParam(
            [
                'symbol' => 'BTC_USDT',
                'side' => 'buy',
                'type' => 'limit',
                'size' => '0.1',
                'price' => '8800',
                'clientOrderId' => 'test20000000001'
            ]
        ))['response']->code);
    }

    public function testPostSubmitMarginOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postSubmitMarginOrder(new MarginOrderParam(
            [
                'symbol' => 'BTC_USDT',
                'side' => 'buy',
                'type' => 'limit',
                'size' => '0.1',
                'price' => '8800',
                'clientOrderId' => 'test200000000022221'
            ]
        ))['response']->code);
    }

    public function testPostSubmitBatchOrder()
    {
        $orderParam = array();

        $orderParam[] = new SpotOrderParam(
            [
                'symbol' => 'BTC_USDT',
                'side' => 'buy',
                'type' => 'limit',
                'size' => '0.1',
                'price' => '8800',
                'clientOrderId' => 'test0000000001'
            ]
        );

        $orderParam[] = new SpotOrderParam(
            [
                'symbol' => 'BTC_USDT',
                'side' => 'buy',
                'type' => 'limit',
                'size' => '0.2',
                'price' => '8800',
                'clientOrderId' => 'test0000000002'
            ]
        );

        $this->assertEquals(1000, $this->APISpot->postSubmitBatchOrder($orderParam)['response']->code);
    }

    public function testPostCancelOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelOrder(
            'BTC_USDT',
            '137478201134228205',
            null
        )['response']->code);
    }

    public function testPostCancelAllOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelAllOrder(
            'BTC_USDT',
            'buy'
        )['response']->code);
    }

    public function testGetOrderByOrderId()
    {
        $this->assertEquals(1000, $this->APISpot->getOrderByOrderId(
            '137478201134228205',
            'open',
            5000
        )['response']->code);
    }

    public function testGetOrderByClientOrderId()
    {
        $this->assertEquals(1000, $this->APISpot->getOrderByClientOrderId(
            '1231233242342423232',
            'open',
            5000
        )['response']->code);
    }

    public function testGetCurrentOpenOrders()
    {
        $endTime = round(microtime(true) * 1000);
        $startTime = $endTime - (60*60*1000);
        $this->assertEquals(1000, $this->APISpot->getCurrentOpenOrders(
            'BTC_USDT',
            'spot',
            $startTime,
            $endTime,
            1,
            5000
        )['response']->code);
    }

    public function testGetAccountOrders()
    {
        $endTime = round(microtime(true) * 1000);
        $startTime = $endTime - (60*60*1000);
        $this->assertEquals(1000, $this->APISpot->getAccountOrders(
            'BTC_USDT',
            'spot',
            $startTime,
            $endTime,
            1,
            5000
        )['response']->code);
    }

    public function testGetAccountTradeList()
    {
        $endTime = round(microtime(true) * 1000);
        $startTime = $endTime - (60*60*1000);
        $this->assertEquals(1000, $this->APISpot->getAccountTradeList(
            'BTC_USDT',
            'spot',
            $startTime,
            $endTime,
            1,
            5000
        )['response']->code);
    }


    public function testGetOrderTradeList()
    {
        $this->assertEquals(1000, $this->APISpot->getOrderTradeList(
            '137478201134228205',
            5000
        )['response']->code);
    }





}
