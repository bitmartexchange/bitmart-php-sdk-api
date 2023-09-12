<?php

namespace BitMart\Tests;

use BitMart\Futures\APIContractMarket;
use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;
use BitMart\Param\ContractOrderParam;
use BitMart\Param\ContractPlanOrderParam;
use PHPUnit\Framework\TestCase;

class APIContractMarketTradingTest extends TestCase
{
    protected $APIContract;

    protected function setUp(): void
    {
        $this->APIContract = new APIContractTrading(new CloudConfig(
            [
                'accessKey' => "your_api_key",
                'secretKey' => "your_secret_key",
                'memo' => "your_memo",
                'timeoutSecond' => 5,
                'xdebug' => true
            ]
        ));
    }


    public function testGetContractAssets()
    {
        $this->assertEquals(1000, $this->APIContract->getContractAssets()['response']->code);
    }

    public function testGetContractOrderDetail()
    {
        $this->assertEquals(1000, $this->APIContract->getContractOrderDetail("BTCUSDT", "220609666322019")['response']->code);
    }

    public function testGetContractOrderHistory()
    {
        $endTime = round(microtime(true) );
        $startTime = $endTime - (60*60);
        $this->assertEquals(1000, $this->APIContract->getContractOrderHistory(
            "BTCUSDT",
            $startTime,
            $endTime
        )['response']->code);
    }

    public function testGetContractOpenOrders()
    {
        $this->assertEquals(1000, $this->APIContract->getContractOpenOrders(
            "BTCUSDT",
            "limit",
            "all",
            1
        )['response']->code);
    }

    public function testGetContractPosition()
    {
        $this->assertEquals(1000, $this->APIContract->getContractPosition(
            "BTCUSDT",
        )['response']->code);
    }

    public function testGetContractTrades()
    {
        $endTime = round(microtime(true) );
        $startTime = $endTime - (60*60);
        $this->assertEquals(1000, $this->APIContract->getContractTrades(
            "BTCUSDT",
            $startTime,
            $endTime
        )['response']->code);
    }

    public function testGetContractTransferList()
    {
        $endTime = round(microtime(true) * 1000);
        $startTime = $endTime - (60*60*1000);
        $this->assertEquals(1000, $this->APIContract->getContractTransferList(
            "USDT",
            $startTime,
            $endTime,
            1,
            10,
            5000
        )['response']->code);
    }

    public function testSubmitOrder()
    {
        $this->assertEquals(1000, $this->APIContract->submitOrder(new ContractOrderParam(
            [
                'symbol' => "BTCUSDT",
                'clientOrderId' => "test3000000001",
                'type' => "limit",
                'side' => 1,
                'leverage' => "1",
                'openType' => "isolated",
                'mode' => 1,
                'price' => "10",
                'size' => 1,
            ]
        ))['response']->code);
    }

    public function testCancelOrder()
    {
        $this->assertEquals(1000, $this->APIContract->cancelOrder("BTCUSDT", "230614362545891")['response']->code);
    }

    public function testCancelAllOrder()
    {
        $this->assertEquals(1000, $this->APIContract->cancelAllOrder("BTCUSDT")['response']->code);
    }

    public function testContractPlanOrderParam()
    {
        $this->assertEquals(1000, $this->APIContract->submitPlanOrder(new ContractPlanOrderParam(
            [
                'symbol' => "ETHUSDT",
                'type' => "limit",
                'side' => 4,
                'leverage' => "1",
                'openType' => "isolated",
                'mode' => 1,
                'price' => "10",
                'size' => 1,
                'triggerPrice' => "2000",
                'executivePrice' => "1800",
                'priceWay' => 1,
                'priceType' => 1,
            ]

        ))['response']->code);
    }

    public function testCancelPlanOrder()
    {
        $this->assertEquals(1000, $this->APIContract->cancelPlanOrder("ETHUSDT", "230614362668695")['response']->code);
    }


    public function testTransfer()
    {
        $this->assertEquals(1000, $this->APIContract->transfer(
            "USDT",
            "1",
            "spot_to_contract",
            5000
        )['response']->code);
    }

    public function testSubmitLeverage()
    {
        $this->assertEquals(1000, $this->APIContract->submitLeverage(
            "USDT",
            "cross",
            "1",
        )['response']->code);
    }




}
