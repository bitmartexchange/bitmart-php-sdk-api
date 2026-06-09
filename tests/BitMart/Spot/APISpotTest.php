<?php

namespace BitMart\Tests;

use BitMart\Spot\APISpot;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;

class APISpotTest extends TestCase
{
    protected $APISpot;

    protected function setUp(): void
    {
        $this->APISpot = new APISpot(TestConfig::getSpotConfig());
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


    public function testGetV3LatestKline()
    {
        $before = round(microtime(true));
        $after = $before - (60*60);
        $this->assertEquals(1000, $this->APISpot->getV3LatestKline(
            'BTC_USDT',
            $before,
            $after,
            15,
            10
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
            10
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
        $this->assertEquals(1000, $this->APISpot->postSubmitOrder(
            'BTC_USDT',
            'buy',
            'limit',
            [
                'size' => '0.1',
                'price' => '8800',
                'client_order_id' => 'test20000000005'
            ]
        )['response']->code);
    }

    public function testPostSubmitMarginOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postSubmitMarginOrder(
            'BTC_USDT',
            'buy',
            'limit',
            [
                'size' => '0.1',
                'price' => '8800',
                'clientOrderId' => 'test200000000022221'
            ]
        )['response']->code);
    }

    public function testPostSubmitBatchOrder()
    {
        $orderParam = array();

        $orderParam[] =
            [
                'symbol' => 'BTC_USDT',
                'side' => 'buy',
                'type' => 'limit',
                'size' => '0.1',
                'price' => '8800',
                'clientOrderId' => 'test0000000003'
            ];

        $orderParam[] =
            [
                'symbol' => 'BTC_USDT',
                'side' => 'sell',
                'type' => 'market',
                'size' => '0.2',
                'notional' => '5',
                'clientOrderId' => 'test0000000004'
            ];

        $this->assertEquals(1000, $this->APISpot->postSubmitBatchOrder('BTC_USDT', $orderParam, [
            'recvWindow' => 5000
        ])['response']->code);

        // 732599977008000256
        // 732599977024777472
    }

    public function testPostCancelOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelOrder(
            'BTC_USDT',
            [
                'order_id' => '137478201134228205',
            ]
        )['response']->code);

        $this->assertEquals(1000, $this->APISpot->postCancelOrder(
            'BTC_USDT',
            [
                'client_order_id' => '137478201134228205',
            ]
        )['response']->code);
    }

    public function testPostCancelBatchOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelBatchOrder(
            'BTC_USDT',
            [
                'orderIds' => ["1231231231", "12312312312"]
            ]
        )['response']->code);

        $this->assertEquals(1000, $this->APISpot->postCancelBatchOrder(
            'BTC_USDT',
            [
                'clientOrderIds' => ["1231231231", "12312312312"]
            ]
        )['response']->code);
    }

    public function testPostCancelAllOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelAllOrder()['response']->code);
        $this->assertEquals(1000, $this->APISpot->postCancelAllOrder(
            [
                'symbol' => 'BTC_USDT',
                'side' => 'buy',
            ]
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

    public function testPostSubmitAlgoOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postSubmitAlgoOrder(
            'BTC_USDT',
            'buy',
            'trigger',
            [
                'trigger_price' => '20000',
                'trigger_type' => 'limit',
                'price' => '20000',
                'size' => '0.1',
                'client_order_id' => 'test_algo_0001',
            ]
        )['response']->code);
    }

    public function testPostCancelAlgoOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelAlgoOrder(
            'BTC_USDT',
            '1223181',
            'trigger'
        )['response']->code);
    }

    public function testPostCancelAllAlgoOrder()
    {
        $this->assertEquals(1000, $this->APISpot->postCancelAllAlgoOrder(
            'trigger',
            [
                'symbol' => 'BTC_USDT',
            ]
        )['response']->code);
    }

    public function testGetAlgoOrderById()
    {
        $this->assertEquals(1000, $this->APISpot->getAlgoOrderById(
            '118100034543076010',
            [
                'queryState' => 'open',
            ]
        )['response']->code);
    }

    public function testGetAlgoOrderByClientOrderId()
    {
        $this->assertEquals(1000, $this->APISpot->getAlgoOrderByClientOrderId(
            'test_algo_0001',
            [
                'queryState' => 'open',
            ]
        )['response']->code);
    }

    public function testGetAlgoCurrentOpenOrders()
    {
        $this->assertEquals(1000, $this->APISpot->getAlgoCurrentOpenOrders(
            [
                'symbol' => 'BTC_USDT',
                'orderMode' => 'trigger',
                'limit' => 200,
            ]
        )['response']->code);
    }

    public function testGetAlgoHistoryOrders()
    {
        $this->assertEquals(1000, $this->APISpot->getAlgoHistoryOrders(
            [
                'symbol' => 'BTC_USDT',
                'orderMode' => 'trigger',
                'limit' => 200,
            ]
        )['response']->code);
    }

}
