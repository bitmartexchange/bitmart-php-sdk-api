<?php

namespace BitMart\Tests;

use BitMart\Finance\APIFinance;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;

class APIFinanceTest extends TestCase
{
    protected $APIFinance;

    protected function setUp(): void
    {
        // Finance endpoints are served from the V1 host (api-cloud.bitmart.com)
        $this->APIFinance = new APIFinance(TestConfig::getSpotConfig());
    }

    // ------------ Finance Account

    public function testGetEarnAccount()
    {
        $this->assertEquals(1000, $this->APIFinance->getEarnAccount()['response']->code);
    }

    // ------------ Flexible Savings

    public function testGetSavingProducts()
    {
        $this->assertEquals(1000, $this->APIFinance->getSavingProducts(1, 10, [
            'coinName' => 'USDT',
        ])['response']->code);
    }

    public function testSubscribeSaving()
    {
        $this->assertEquals(1000, $this->APIFinance->subscribeSaving(
            '1001',
            '100',
            '20000009000000300000'
        )['response']->code);
    }

    public function testRedeemSaving()
    {
        $this->assertEquals(1000, $this->APIFinance->redeemSaving(
            '200001',
            '50',
            '20000009000000300001'
        )['response']->code);
    }

    public function testGetSavingHoldings()
    {
        $this->assertEquals(1000, $this->APIFinance->getSavingHoldings(1, 10, [
            'coinName' => 'USDT',
        ])['response']->code);
    }

    public function testGetSavingRecords()
    {
        $this->assertEquals(1000, $this->APIFinance->getSavingRecords('subscribe', 1, 10, [
            'coinName' => 'USDT',
        ])['response']->code);
    }

    public function testSetSavingAutoSubscribe()
    {
        $this->assertEquals(1000, $this->APIFinance->setSavingAutoSubscribe('1001', 'open')['response']->code);
    }

    public function testGetSavingAutoSubscribeStatus()
    {
        $this->assertEquals(1000, $this->APIFinance->getSavingAutoSubscribeStatus('1001')['response']->code);
    }

    public function testSetSavingAutoSubscribeBatch()
    {
        $this->assertEquals(1000, $this->APIFinance->setSavingAutoSubscribeBatch('open')['response']->code);
    }

    public function testGetSavingAutoSubscribeBatchStatus()
    {
        $this->assertEquals(1000, $this->APIFinance->getSavingAutoSubscribeBatchStatus()['response']->code);
    }

    // ------------ Fixed Savings

    public function testGetFixedProducts()
    {
        $this->assertEquals(1000, $this->APIFinance->getFixedProducts(1, 10, [
            'coinName' => 'USDT',
        ])['response']->code);
    }

    public function testSubscribeFixed()
    {
        $this->assertEquals(1000, $this->APIFinance->subscribeFixed(
            '1001',
            '10',
            '20000009000000300002',
            'OFF'
        )['response']->code);
    }

    public function testGetFixedHoldings()
    {
        $this->assertEquals(1000, $this->APIFinance->getFixedHoldings(1, 10, [
            'coinName' => 'USDT',
        ])['response']->code);
    }

    public function testGetFixedRecords()
    {
        $this->assertEquals(1000, $this->APIFinance->getFixedRecords('subscribe', 1, 10, [
            'coinName' => 'USDT',
        ])['response']->code);
    }

    public function testRedeemFixed()
    {
        $this->assertEquals(1000, $this->APIFinance->redeemFixed(
            '200001',
            '20000009000000300003'
        )['response']->code);
    }

    public function testModifyFixedAutoRenewal()
    {
        $this->assertEquals(1000, $this->APIFinance->modifyFixedAutoRenewal(
            '200001',
            'REINVEST_FIXED'
        )['response']->code);
    }

}
