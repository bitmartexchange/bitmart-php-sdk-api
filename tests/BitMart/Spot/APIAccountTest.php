<?php

namespace BitMart\Tests;

use BitMart\Spot\APIAccount;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;

class APIAccountTest extends TestCase
{
    protected $APIAccount;

    protected function setUp(): void
    {
        $this->APIAccount = new APIAccount(TestConfig::getSpotConfig());
    }

    public function testGetCurrencies()
    {
        $this->assertEquals(1000, $this->APIAccount->getCurrencies()['response']->code);
        $this->assertEquals(1000, $this->APIAccount->getCurrencies([
            'currencies' => "BTC"
        ])['response']->code);
    }

    public function testGetWallet()
    {
        $this->assertEquals(1000, $this->APIAccount->getWallet('BTC')['response']->code);
    }

    public function testGetDepositAddress()
    {
        $this->assertEquals(1000, $this->APIAccount->getDepositAddress('USDT-TRC20')['response']->code);
    }

    public function testGetWithdrawAddress()
    {
        $this->assertEquals(1000, $this->APIAccount->getWithdrawAddress()['response']->code);
    }

    public function testGetWithdrawQuota()
    {
        $this->assertEquals(1000, $this->APIAccount->getWithdrawQuota('USDT')['response']->code);
    }

    public function testPostWithdraw()
    {
        $this->assertEquals(1000, $this->APIAccount->postWithdraw(
            'USDT-ERC20',
            '40',
            [
                'address' => "0xe57b69a8776b37860407965B73cdFFBDF",
                'address_memo' => '123',
                'destination' => 'To Digital Address',
            ],
        )['response']->code);


        $this->assertEquals(1000, $this->APIAccount->postWithdraw(
            'USDT-ERC20',
            '40',
            [
                'type' => 1,
                'value' => '876940329',
                'areaCode' => '',
            ],
        )['response']->code);
    }

    public function testGetCurrencyDepositWithdrawHistory()
    {
        $endTime = round(microtime(true) * 1000);
        $startTime = $endTime - (60*60*1000);

        $this->assertEquals(1000, $this->APIAccount->getDepositWithdrawHistory( "withdraw", 100)['response']->code);
        $this->assertEquals(1000, $this->APIAccount->getDepositWithdrawHistory( "withdraw", 100, [
            'currency' => "USDT",
            'startTime' => $startTime,
            'endTime' => $endTime,
        ])['response']->code);
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