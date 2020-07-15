<?php

namespace BitMart;

use PHPUnit\Framework\TestCase;

class APIAccountTest extends TestCase
{
    protected $APIAccount;

    protected function setUp()
    {
        $this->APIAccount = new APIAccount(new CloudConfig(
            "http://api-cloud.bitmartdev.com",
            "80618e45710812162b04892c7ee5ead4a3cc3e56",
            "6c6c98544461bbe71db2bca4c6d7fd0021e0ba9efc215f9c6ad41852df9d9df9",
            "test001"
        ));
    }

    public function testGetCurrencies()
    {
        $this->assertEquals(1000, $this->APIAccount->getCurrencies()['response']->code);
    }

    public function testGetWallet()
    {
        $this->assertEquals(1000, $this->APIAccount->getWallet("1")['response']->code);
    }

    public function testGetDepositAddress()
    {
        $this->assertEquals(1000, $this->APIAccount->getDepositAddress("USDT")['response']->code);
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
            "0xe57b69a8776b37860407965B73cdFFBDFe668Bb5",
            ""
        )['response']->code);
    }

    public function testGetCurrencyDepositWithdrawHistory()
    {
        $this->assertEquals(1000, $this->APIAccount->getCurrencyDepositWithdrawHistory("USDT-ERC20", "withdraw", 1, 10)['response']->code);
    }


    public function testGetDepositWithdrawHistory()
    {
        $this->assertEquals(1000, $this->APIAccount->getDepositWithdrawHistory( "withdraw", 1, 10)['response']->code);
    }

    public function testGetDepositWithdrawDetail()
    {
        $this->assertEquals(1000, $this->APIAccount->getDepositWithdrawDetail( 1680007)['response']->code);
    }
}