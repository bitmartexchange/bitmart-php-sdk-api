<?php

namespace BitMart\Tests;

use BitMart\Spot\APIMarginLoan;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;

class APIMarginLoanTest extends TestCase
{
    protected $APIMarginLoan;

    protected function setUp(): void
    {
        $this->APIMarginLoan = new APIMarginLoan(TestConfig::getSpotConfig());
    }

    public function testMarginIsolatedBorrow()
    {
        $this->assertEquals(1000, $this->APIMarginLoan->marginIsolatedBorrow(
            "BTC_USDT",
            "BTC",
            "1"
        )['response']->code);
    }

    public function testMarginIsolatedRepay()
    {
        $this->assertEquals(1000, $this->APIMarginLoan->marginIsolatedRepay(
            "BTC_USDT",
            "BTC",
            "1"
        )['response']->code);
    }

    public function testTetMarginIsolatedBorrowRecord()
    {
        $endTime = round(microtime(true) * 1000);
        $startTime = $endTime - (60*60*1000);
        $this->assertEquals(1000, $this->APIMarginLoan->getMarginIsolatedBorrowRecord(
            "BTC_USDT",
            null,
            $startTime,
            $endTime,
            "1"
        )['response']->code);
    }

    public function testGetMarginIsolatedRepayRecord()
    {
        $endTime = round(microtime(true) * 1000);
        $startTime = $endTime - (60*60*1000);
        $this->assertEquals(1000, $this->APIMarginLoan->getMarginIsolatedRepayRecord(
            "BTC_USDT",
            null,
            "BTC",
            $startTime,
            $endTime,
            "1"
        )['response']->code);
    }

    public function testGetMarginLoanSymbol()
    {
        $this->assertEquals(1000, $this->APIMarginLoan->getMarginLoanSymbol(
            "BTC_USDT",
        )['response']->code);
    }
}