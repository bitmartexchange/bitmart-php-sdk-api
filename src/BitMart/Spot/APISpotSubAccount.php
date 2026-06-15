<?php


namespace BitMart\Spot;


use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;

class APISpotSubAccount
{
    static $cloudClient;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    // ----------- Spot Sub-Account

    /**
     * url: POST https://api-cloud.bitmart.com/account/sub-account/main/v1/sub-to-main
     * Sub-Account to Main-Account (For Main Account) (SIGNED) - Spot wallet transfer from a sub-account to the main account
     * @param string $requestNo : UUID or other unique identifier, max length 64
     * @param string $amount : Transfer amount
     * @param string $currency : Currency
     * @param string $subAccount : Sub-account username
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubToMain(string $requestNo, string $amount, string $currency, string $subAccount): array
    {
        $params = [
            'requestNo' => $requestNo,
            'amount' => $amount,
            'currency' => $currency,
            'subAccount' => $subAccount,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_SUB_MAIN_SUB_TO_MAIN_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/account/sub-account/sub/v1/sub-to-main
     * Sub-Account to Main-Account (For Sub-Account) (SIGNED) - Spot wallet transfer from the sub-account to the main account
     * @param string $requestNo : UUID or other unique identifier, max length 64
     * @param string $amount : Transfer amount
     * @param string $currency : Currency
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubToMainForSub(string $requestNo, string $amount, string $currency): array
    {
        $params = [
            'requestNo' => $requestNo,
            'amount' => $amount,
            'currency' => $currency,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_SUB_SUB_TO_MAIN_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/account/sub-account/main/v1/main-to-sub
     * Main-Account to Sub-Account (For Main Account) (SIGNED) - Spot wallet transfer from the main account to a sub-account
     * @param string $requestNo : UUID or other unique identifier, max length 64
     * @param string $amount : Transfer amount
     * @param string $currency : Currency
     * @param string $subAccount : Sub-account username
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postMainToSub(string $requestNo, string $amount, string $currency, string $subAccount): array
    {
        $params = [
            'requestNo' => $requestNo,
            'amount' => $amount,
            'currency' => $currency,
            'subAccount' => $subAccount,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_SUB_MAIN_MAIN_TO_SUB_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/account/sub-account/main/v1/sub-to-sub
     * Sub-Account to Sub-Account (For Main Account) (SIGNED) - Spot wallet transfer between two sub-accounts
     * @param string $requestNo : UUID or other unique identifier, max length 64
     * @param string $amount : Transfer amount
     * @param string $currency : Currency
     * @param string $fromAccount : Source sub-account username
     * @param string $toAccount : Target sub-account username
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubToSub(string $requestNo, string $amount, string $currency, string $fromAccount, string $toAccount): array
    {
        $params = [
            'requestNo' => $requestNo,
            'amount' => $amount,
            'currency' => $currency,
            'fromAccount' => $fromAccount,
            'toAccount' => $toAccount,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_SUB_MAIN_SUB_TO_SUB_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/sub-account/main/v1/transfer-list
     * Get Sub-Account Transfer History (For Main Account) (KEYED) - Query sub-account spot transfer records
     * @param string $moveType : Transfer type (e.g. "spot to spot")
     * @param int $n : Number of latest records, allowed range [1,100]
     * @param array $options
     *  accountName : Sub-account username (default: query all sub-accounts)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSubTransferList(string $moveType, int $n, array $options = []): array
    {
        $params = array_merge(
            [
                'moveType' => $moveType,
                'N' => $n,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_SUB_MAIN_TRANSFER_LIST_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/sub-account/v1/transfer-history
     * Get Account Transfer History (For Main and Sub-Account) (KEYED) - Query account spot transfer records
     * @param string $moveType : Transfer type (e.g. "spot to spot")
     * @param int $n : Number of latest records, allowed range [1,100]
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSubTransferHistory(string $moveType, int $n): array
    {
        $params = [
            'moveType' => $moveType,
            'N' => $n,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_SUB_TRANSFER_HISTORY_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/sub-account/main/v1/wallet
     * Get Sub-Account Spot Wallet (For Main Account) (KEYED) - Query a sub-account spot wallet balance
     * @param string $subAccount : Sub-account username
     * @param array $options
     *  currency : Currency
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSubWallet(string $subAccount, array $options = []): array
    {
        $params = array_merge(
            [
                'subAccount' => $subAccount,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_SUB_MAIN_WALLET_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/account/sub-account/main/v1/subaccount-list
     * Get Sub-Account List (For Main Account) (KEYED) - Query the sub-account list under the main account
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSubAccountList(): array
    {
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_SUB_MAIN_SUBACCOUNT_LIST_URL, CloudConst::GET, [], Auth::KEYED);
    }

}
