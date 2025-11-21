<?php

namespace BitMart\Tests;

use BitMart\Futures\APIContractTrading;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;

class APIContractTradingTest extends TestCase
{
    protected $APIContract;

    protected function setUp(): void
    {
        $this->APIContract = new APIContractTrading(TestConfig::getFuturesConfig());
    }

    /**
     * output the last API response if the test is not successful
     */
    protected function onNotSuccessfulTest(\Throwable $t): void
    {
        if ($this->APIContract && method_exists($this->APIContract, 'getLastResponse')) {
            echo "\n=== Last API Response ===\n";
            print_r($this->APIContract->getLastResponse());
            echo "\n";
        }
        parent::onNotSuccessfulTest($t);
    }


    public function testGetContractAssets()
    {
        $this->assertEquals(1000, $this->APIContract->getContractAssets()['response']->code);
    }

    public function testGetContractTradeFeeRate()
    {
        $this->assertEquals(1000, $this->APIContract->getContractTradeFeeRate("BTCUSDT")['response']->code);
    }

    public function testGetContractOrderDetail()
    {
        $this->assertEquals(1000, $this->APIContract->getContractOrderDetail("BTCUSDT", "220609666322019")['response']->code);

        $this->assertEquals(1000, $this->APIContract->getContractOrderDetail("BTCUSDT", "220609666322019", [
            'account' => 'futures',
        ])['response']->code);
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

        $this->assertEquals(1000, $this->APIContract->getContractOrderHistory(
            "BTCUSDT",
           [
               'account' => 'futures',
               'order_id' => '220609666322019',
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
                'account' => 'futures',
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
                'account' => 'futures',
            ]
        )['response']->code);
    }

    public function testGetContractTrades()
    {

        $this->assertEquals(1000, $this->APIContract->getContractTrades(
            [
                'symbol' => "BTCUSDT",
            ]
        )['response']->code);

        $endTime = round(microtime(true) );
        $startTime = $endTime - (60*60);
        $this->assertEquals(1000, $this->APIContract->getContractTrades(
            [
                'symbol' => "BTCUSDT",
                'account' => 'futures',
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]
        )['response']->code);

        $this->assertEquals(1000, $this->APIContract->getContractTrades(
            [
                'account' => 'futures',
            ]
        )['response']->code);
    }

    public function testGetContractTransactionHistory()
    {
        $this->assertEquals(1000, $this->APIContract->getContractTransactionHistory(
        )['response']->code);

        $endTime = round(microtime(true) ) * 1000;
        $startTime = $endTime - (60*60)*1000;
        $this->assertEquals(1000, $this->APIContract->getContractTransactionHistory(
            [
                'account' => 'futures',
                'flow_type' => 0,
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
                //'client_order_id' => "test3000000002",
                'type' => "limit",
                'leverage' => "10",
                'open_type' => "isolated",
                'mode' => 1,
                'price' => "91400",
                'size' => 1,
                'stp_mode' => 1,
            ]
        )['response']->code);
    }

    public function testCancelOrder()
    {
        $this->assertEquals(1000, $this->APIContract->cancelOrder("BTCUSDT", "79224087421")['response']->code);
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

    public function testSubmitTrailOrder()
    {
        $this->assertEquals(1000, $this->APIContract->submitTrailOrder(
            [
                'symbol' => "BTCUSDT",
                'side' => 1,
                'leverage' => "5",
                'open_type' => "isolated",
                'size' => 1,
                'activation_price' => "80000",
                'callback_rate' => "2",
                'activation_price_type' => 1,
            ]
        )['response']->code);
    }

    public function testCancelTrailOrder()
    {
        $this->assertEquals(1000, $this->APIContract->cancelTrailOrder("BTCUSDT", [
            "order_id" => "60633000005"
        ])['response']->code);
    }

    public function testModifyLimitOrder()
    {
        $this->assertEquals(1000, $this->APIContract->modifyLimitOrder("BTCUSDT", [
            "order_id" => "220609666322019",
            "price" => "50000",
            "size" => 1,
        ])['response']->code);
    }

    public function testCancelAllAfter()
    {
        $this->assertEquals(1000, $this->APIContract->cancelAllAfter("BTCUSDT", 360)['response']->code);
    }

    public function testGetPositionMode()
    {
        $this->assertEquals(1000, $this->APIContract->getPositionMode()['response']->code);
    }

    public function testSetPositionMode()
    {
        $this->assertEquals(1000, $this->APIContract->setPositionMode("one_way_mode")['response']->code);
    }

    public function testGetContractPositionV2()
    {
        $this->assertEquals(1000, $this->APIContract->getContractPositionV2()['response']->code);

        $this->assertEquals(1000, $this->APIContract->getContractPositionV2(
            [
                'symbol' => 'BTCUSDT',
            ]
        )['response']->code);
    }


}
