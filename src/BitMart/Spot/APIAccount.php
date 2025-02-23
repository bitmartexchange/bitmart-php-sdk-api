<?php


namespace BitMart\Spot;




use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;

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
     * @param array $options
     *  currencies: - Single query, such as BTC; multiple queries, such as BTC,ETH,BMX, can have a maximum of 20.
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getCurrencies(array $options = []): array
    {
        $params = $options;
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_CURRENCIES_URL, CloudConst::GET, $params);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/wallet
     * Gets Account Balance
     * @param $currency: Token symbol, e.g., 'BTC'
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getWallet(string $currency): array
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
    public function getDepositAddress(string $currency): array
    {
        $params = [
            'currency' => $currency
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_DEPOSIT_ADDRESS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/withdraw/address/list
     * Gets Withdraw Address List
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getWithdrawAddress(): array
    {
        $params = [];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_WITHDRAW_ADDRESS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/withdraw/charge
     * Query withdraw quota for currencies
     * @param $currency: Token symbol, e.g., 'BTC'
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getWithdrawQuota(string $currency): array
    {
        $params = [
            'currency' => $currency
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_WITHDRAW_CHARGE_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/account/v1/withdraw/apply
     * Creates a withdraw request from spot account to an external address
     * @param string $currency: Token symbol, e.g., 'BTC'
     * @param string $amount: The amount of currency to withdraw
     * @param array $options
     *  destination: -To Digital Address=Withdraw to the digital currency address
     *  address: Address (only the address added on the official website is supported)
     *  address_memo: Tag(tag Or payment_id Or memo)
     *  type: Account type
                        1=CID
                        2=Email
                        3=Phone
     *  value: Account
     *  areaCode: Phone area code, required when account type is phone, e.g.: 61
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postWithdraw(string $currency, string $amount, array $options = []): array
    {
        $params = array_merge(
            [
                'currency' => $currency,
                'amount' => $amount,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_WITHDRAW_APPLY_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/v2/deposit-withdraw/history
     * Search for all existed withdraws and deposits and return their latest status.
     * @param string $operationType: Type deposit=deposit; withdraw=withdraw
     * @param int $N: Recent N records (value range 1-1000)
     * @param array $options :
     *  currency: Token symbol, e.g., 'BTC'
     *  startTime: Default: 90 days from current timestamp (milliseconds)
     *  endTime: Default: present timestamp (milliseconds)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getDepositWithdrawHistory(string $operationType, int $N, array $options = []): array
    {
        $params = array_merge(
            [
                'operation_type' => $operationType,
                'N' => $N,
            ],
            $options
        );

        return self::$cloudClient->request(CloudConst::API_ACCOUNT_DEPOSIT_WITHDRAW_HISTORY_URL, CloudConst::GET, $params, Auth::KEYED);
    }


    /**
     * url: GET https://api-cloud.bitmart.com/account/v1/deposit-withdraw/detail
     * Query a single charge record
     * @param string $id: withdraw_id or deposit_id
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getDepositWithdrawDetail(string $id): array
    {
        $params = [
            'id' => $id,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_DEPOSIT_WITHDRAW_DETAIL_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/margin/isolated/account
     * Get Margin Account Details(Isolated) (KEYED) - Applicable for isolated margin account inquiries
     * @param $symbol : Trading pair (e.g. BMX_USDT), no symbol is passed, and all isolated margin assets are returned
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getMarginIsolatedAccountDetail($symbol): array
    {
        $params = [
            'symbol' => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_MARGIN_ISOLATED_ACCOUNT_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/margin/isolated/transfer
     * Margin Asset Transfer (SIGNED) - For fund transfers between a margin account and spot account
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $currency : Currency
     * @param $amount : Amount of transfers (precision: 8 decimal places)
     * @param $side : Transfer direction (in/out)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postMarginAssetTransfer($symbol, $currency, $amount, $side): array
    {
        $params = [
            'symbol' => $symbol,
            'currency' => $currency,
            'amount' => $amount,
            'side' => $side,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_MARGIN_ISOLATED_TRANSFER_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/user_fee
     * Get Basic Fee Rate (KEYED) - For querying the base rate of the current user
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getBasicFeeRate(): array
    {
        return self::$cloudClient->request(CloudConst::API_SPOT_USER_FEE_URL, CloudConst::GET, [], Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/trade_fee
     * Get Actual Trade Fee Rate (KEYED) - For the actual fee rate of the trading pairs
     * @param @symbol : Trading pair (e.g. BMX_USDT)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getActualTradeFeeRate($symbol): array
    {
        $params = [
            'symbol' => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_SPOT_ACTUAL_TRADE_FEE_URL, CloudConst::GET, $params, Auth::KEYED);
    }


}