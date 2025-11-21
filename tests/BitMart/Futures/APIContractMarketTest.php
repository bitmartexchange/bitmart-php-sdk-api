<?php

namespace BitMart\Tests;

use BitMart\Futures\APIContractMarket;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;

class APIContractMarketTest extends TestCase
{
    protected $APIContract;

    protected function setUp(): void
    {
        $this->APIContract = new APIContractMarket(TestConfig::getFuturesConfig());

    }

    public function testGetContractDetails()
    {
        $this->assertEquals(1000, $this->APIContract->getContractDetails([
            'symbol' => "BTCUSDT",
        ])['response']->code);
    }

    public function testGetContractDepth()
    {
        $this->assertEquals(1000, $this->APIContract->getContractDepth("BTCUSDT")['response']->code);
    }

    public function testGetContractOpenInterest()
    {
        $this->assertEquals(1000, $this->APIContract->getContractOpenInterest("BTCUSDT")['response']->code);
    }

    public function testGetContractFundingRate()
    {
        $this->assertEquals(1000, $this->APIContract->getContractFundingRate("BTCUSDT")['response']->code);
    }

    public function testGetContractFundingRateHistory()
    {
        $this->assertEquals(1000, $this->APIContract->getContractFundingRateHistory("BTCUSDT", [
            "limit" => 20,
        ])['response']->code);
    }

    public function testGetContractKline()
    {
        $endTime = round(microtime(true));
        $startTime = $endTime - (60*60);
        $this->assertEquals(1000, $this->APIContract->getContractKline(
            "BTCUSDT",
            "15",
            $startTime,
            $endTime
        )['response']->code);
    }

    public function testGetContractMarkPriceKline()
    {
        $endTime = round(microtime(true));
        $startTime = $endTime - (60*60);
        $this->assertEquals(1000, $this->APIContract->getContractMarkPriceKline(
            "BTCUSDT",
            "15",
            $startTime,
            $endTime
        )['response']->code);
    }

    public function testGetContractLeverageBracket()
    {
        $this->assertEquals(1000, $this->APIContract->getContractLeverageBracket([
            'symbol' => "BTCUSDT"
        ])['response']->code);
    }

    public function testGetContractMarketTrade()
    {
        $this->assertEquals(1000, $this->APIContract->getContractMarketTrade("BTCUSDT")['response']->code);

        $this->assertEquals(1000, $this->APIContract->getContractMarketTrade("BTCUSDT", [
            'limit' => 2,
        ])['response']->code);
    }


}
