<?php

namespace BitMart\Tests;

use BitMart\Lib\CloudConfig;
use BitMart\Spot\APIAccount;
use PHPUnit\Framework\TestCase;

class APIAccountTest extends TestCase
{
    protected $APIAccount;

    protected function setUp(): void
    {
        $this->APIAccount = new APIAccount(new CloudConfig(
            [
                'accessKey' => "your_api_key",
                'secretKey' => "your_secret_key",
                'memo' => "your_memo",
                'timeoutSecond' => 5,
                'xdebug' => true
            ]
        ));
    }

    public function testGetCurrencies()
    {
        $this->assertEquals(1000, $this->APIAccount->getCurrencies()['response']->code);
    }

    public function testGetWallet()
    {
        $this->assertEquals(1000, $this->APIAccount->getWallet("BTC")['response']->code);
    }

    public function testGetDepositAddress()
    {
        $this->assertEquals(1000, $this->APIAccount->getDepositAddress("USDT-TRC20")['response']->code);
    }

    public function testGetWithdrawQuota()
    {
        $this->assertEquals(1000, $this->APIAccount->getWithdrawQuota("USDT")['response']->code);
    }

    public function testPostWithdraw()
    {
        $this->assertEquals(1000, $this->APIAccount->postWithdraw(
            "USDT-ERC20",
            "40",
            "To Digital Address",
            "0xe57b69a8776b37860407965B73cdFFBDF****",
            ""
        )['response']->code);
    }

    public function testGetCurrencyDepositWithdrawHistory()
    {
        $this->assertEquals(1000, $this->APIAccount->getDepositWithdrawHistory("USDT-ERC20", "withdraw", 100)['response']->code);
    }


    public function testGetDepositWithdrawDetail()
    {
        $this->assertEquals(1000, $this->APIAccount->getDepositWithdrawDetail( 1680007)['response']->code);
    }

    public function testGetMarginIsolatedAccountDetail()
    {
        $this->assertEquals(1000, $this->APIAccount->getMarginIsolatedAccountDetail( "BTC_USDT")['response']->code);
    }

    public function testPostMarginAssetTransfer()
    {
        $this->assertEquals(1000, $this->APIAccount->postMarginAssetTransfer(
            "BTC_USDT",
            "BTC",
            "10",
            "in"
        )['response']->code);
    }

    public function testGetBasicFeeRate()
    {
        $this->assertEquals(1000, $this->APIAccount->getBasicFeeRate()['response']->code);
    }

    public function testGetActualTradeFeeRate()
    {
        $this->assertEquals(1000, $this->APIAccount->getActualTradeFeeRate("BTC_USDT")['response']->code);
    }
}