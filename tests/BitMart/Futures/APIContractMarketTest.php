<?php

namespace BitMart\Tests;

use BitMart\Futures\APIContractMarket;
use BitMart\Lib\CloudConfig;
use PHPUnit\Framework\TestCase;

class APIContractMarketTest extends TestCase
{
    protected $APIContract;

    protected function setUp()
    {
        $this->APIContract = new APIContractMarket(new CloudConfig(
            [
                'timeoutSecond' => 5,
                'xdebug' => true
            ]
        ));
    }

    public function testGetContractDetails()
    {
        $this->assertEquals(1000, $this->APIContract->getContractDetails("BTCUSDT")['response']->code);
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


}
