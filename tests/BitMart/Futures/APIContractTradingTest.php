<?php

namespace BitMart\Tests;

use BitMart\CloudConst;
use BitMart\Futures\APIContractTrading;
use BitMart\Lib\CloudConfig;
use PHPUnit\Framework\TestCase;

class APIContractMarketTradingTest extends TestCase
{
    protected $APIContract;

    protected function setUp(): void
    {
        $this->APIContract = new APIContractTrading(new CloudConfig(
            [
                'url' => CloudConst::API_URL_V2_PRO,
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

    public function testGetContractTradeFeeRate()
    {
        $this->assertEquals(1000, $this->APIContract->getContractTradeFeeRate("BTCUSDT", "220609666322019")['response']->code);
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
           [
               'start_time' => $startTime,
               'end_time' => $endTime,
           ]
        )['response']->code);
    }

    public function testGetContractOpenOrders()
    {
        $this->assertEquals(1000, $this->APIContract->getContractOpenOrders()['response']->code);

        $this->assertEquals(1000, $this->APIContract->getContractOpenOrders(
            [
                'symbol' => "BTCUSDT",
                'type' => "limit",
                'order_state' => "all",
                'limit' => 1,
            ]
        )['response']->code);
    }

    public function testGetContractCurrentPlanOrder()
    {
        $this->assertEquals(1000, $this->APIContract->getContractCurrentPlanOrder()['response']->code);

        $this->assertEquals(1000, $this->APIContract->getContractCurrentPlanOrder(
            [
                'symbol' => "BTCUSDT",
                'type' => "limit",
                'limit' => 1,
            ]
        )['response']->code);
    }

    public function testGetContractPosition()
    {
        $this->assertEquals(1000, $this->APIContract->getContractPosition(
        )['response']->code);

        $this->assertEquals(1000, $this->APIContract->getContractPosition(
            [
                'symbol' => 'BTCUSDT',
            ]
        )['response']->code);
    }

    public function testGetContractPositionRisk()
    {
        $this->assertEquals(1000, $this->APIContract->getContractPositionRisk(
        )['response']->code);

        $this->assertEquals(1000, $this->APIContract->getContractPositionRisk(
            [
                'symbol' => 'BTCUSDT',
            ]
        )['response']->code);
    }

    public function testGetContractTrades()
    {

        $this->assertEquals(1000, $this->APIContract->getContractTrades(
            "BTCUSDT",
        )['response']->code);

        $endTime = round(microtime(true) );
        $startTime = $endTime - (60*60);
        $this->assertEquals(1000, $this->APIContract->getContractTrades(
            "BTCUSDT",
            [
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]
        )['response']->code);
    }

    public function testGetContractTransferList()
    {
        $this->assertEquals(1000, $this->APIContract->getContractTransferList(
            1,
            10,
        )['response']->code);

        $endTime = round(microtime(true) * 1000);
        $startTime = $endTime - (60*60*1000);
        $this->assertEquals(1000, $this->APIContract->getContractTransferList(
            1,
            10,
            [
                'currency' => 'USDT',
                'time_start' => $startTime,
                'time_end' => $endTime,
                'recvWindow' => 5000,
            ]
        )['response']->code);
    }

    public function testSubmitOrder()
    {
        $this->assertEquals(1000, $this->APIContract->submitOrder(
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
        )['response']->code);
    }

    public function testCancelOrder()
    {
        $this->assertEquals(1000, $this->APIContract->cancelOrder("BTCUSDT", "230614362545891")['response']->code);
    }

    public function testCancelAllOrder()
    {
        $this->assertEquals(1000, $this->APIContract->cancelAllOrder("BTCUSDT")['response']->code);
    }

    public function testContractSubmitPlanOrder()
    {
        $this->assertEquals(1000, $this->APIContract->submitPlanOrder(
            'ETHUSDT',
            4,
            [
                'type' => "limit",
                'leverage' => "5",
                'open_type' => "isolated",
                'mode' => 1,
                'price' => "10",
                'size' => 1,
                'trigger_price' => "2000",
                'executive_price' => "1800",
                'price_way' => 1,
                'price_type' => 1,
            ]
        )['response']->code);
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
        )['response']->code);

        $this->assertEquals(1000, $this->APIContract->transfer(
            "USDT",
            "1",
            "spot_to_contract",
            [
                'recvWindow' => 5000,
            ]
        )['response']->code);
    }

    public function testSubmitLeverage()
    {
        $this->assertEquals(1000, $this->APIContract->submitLeverage(
            "BTCUSDT",
            "cross",
            null,
        )['response']->code);
    }

    public function testSubmitTPOrSLOrder()
    {
        $this->assertEquals(1000, $this->APIContract->submitTPOrSLOrder(
            'BTCUSDT',
            'take_profit',
            2,
            [
                'size' => 10,
                'trigger_price' => '2000',
                'executive_price' => '1450',
                'price_type' => 1,
                'plan_category' => 1,
                'client_order_id' => '2132131231231212',
                'category' => 'limit',
            ]
        )['response']->code);
    }

    public function testModifyPlanOrder()
    {
        $this->assertEquals(1000, $this->APIContract->modifyPlanOrder(
            'ETHUSDT',
            [
                'trigger_price' => '2000',
                'executive_price' => '1450',
                'price_type' => 1,
                'client_order_id' => '2132131231231212',
                'type' => 'limit',
            ]
        )['response']->code);
    }

    public function testModifyPresetPlanOrder()
    {
        $this->assertEquals(1000, $this->APIContract->modifyPresetPlanOrder(
            'ETHUSDT',
            [
                'order_id' => 220609666322019,
                'preset_take_profit_price' => '2000',
                'preset_stop_loss_price' => '1900',
                'preset_take_profit_price_type' => 1,
                'preset_stop_loss_price_type' => 1,
            ]
        )['response']->code);
    }

    public function testModifyTpSlOrder()
    {
        $this->assertEquals(1000, $this->APIContract->modifyTpSlOrder(
            'ETHUSDT',
            [
                'order_id' => 220609666322019,
                'trigger_price' => '2000',
                'price_type' => 2,
                'plan_category' => 2,
                'category' => 'limit',
            ]
        )['response']->code);
    }




}
