<?php


namespace BitMart;


class APIAccount
{
    static $cloudClient ;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/currencies
     * Gets the currency of the asset for withdrawal
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getCurrencies()
    {
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_CURRENCIES_URL, CloudConst::GET, [], Auth::NONE);
    }



    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/wallet
     * Gets Account Balance
     * @param $currency: Token symbol, e.g., 'BTC'
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getWallet($currency)
    {
        $params = [
            'currency' => $currency
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_WALLET_URL, CloudConst::GET, $params, Auth::KEYED);
    }



    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/deposit/address
     * Gets Deposit Address
     * @param $currency: Token symbol, e.g., 'BTC'
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getDepositAddress($currency)
    {
        $params = [
            'currency' => $currency
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_DEPOSIT_ADDRESS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/withdraw/charge
     * Query withdraw quota for currencies
     * @param $currency: Token symbol, e.g., 'BTC'
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getWithdrawQuota($currency)
    {
        $params = [
            'currency' => $currency
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_WITHDRAW_CHARGE_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/account/v1/withdraw/apply
     * Creates a withdraw request from spot account to an external address
     * @param $currency: Token symbol, e.g., 'BTC'
     * @param $amount: The amount of currency to withdraw
     * @param $destination:To Digital Address=Withdraw to the digital currency address
     * @param $address: Address (only the address added on the official website is supported)
     * @param $addressMemo: Tag(tag Or payment_id Or memo)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postWithdraw($currency, $amount, $destination, $address, $addressMemo)
    {
        $params = [
            'currency' => $currency,
            'amount' => $amount,
            'destination' => $destination,
            'address' => $address,
            'address_memo' => $addressMemo,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_WITHDRAW_APPLY_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/v2/deposit-withdraw/history
     * Search for all existed withdraws and deposits and return their latest status.
     * @param $currency: Token symbol, e.g., 'BTC'
     * @param $operationType: Type deposit=deposit; withdraw=withdraw
     * @param $N: Recent N records (value range 1-100)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getCurrencyDepositWithdrawHistory($currency, $operationType, $N)
    {
        $params = [
            'currency' => $currency,
            'operation_type' => $operationType,
            'N' => $N,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_DEPOSIT_WITHDRAW_HISTORY_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/v2/deposit-withdraw/history
     * Search for all existed withdraws and deposits and return their latest status.
     * @param $operationType: Type deposit=deposit; withdraw=withdraw
     * @param $N: Recent N records (value range 1-100)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getDepositWithdrawHistory($operationType, $N)
    {
        $params = [
            'operation_type' => $operationType,
            'N' => $N,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_DEPOSIT_WITHDRAW_HISTORY_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/deposit-withdraw/detail
     * Query a single charge record
     * @param $id: withdraw_id or deposit_id
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getDepositWithdrawDetail($id)
    {
        $params = [
            'id' => $id,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_DEPOSIT_WITHDRAW_DETAIL, CloudConst::GET, $params, Auth::KEYED);
    }

}