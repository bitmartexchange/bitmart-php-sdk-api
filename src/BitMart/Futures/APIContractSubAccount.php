<?php


namespace BitMart\Futures;


use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;

/**
 * Contract (futures) sub-account endpoints.
 *
 * These are served from the futures V2 host (https://api-cloud-v2.bitmart.com).
 * Construct this class with a CloudConfig pointing at CloudConst::API_URL_V2_PRO.
 */
class APIContractSubAccount
{
    static $cloudClient;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    // ----------- Contract Sub-Account

    /**
     * url: POST https://api-cloud-v2.bitmart.com/account/contract/sub-account/main/v1/sub-to-main
     * Sub-Account to Main-Account (For Main Account) (SIGNED) - Futures wallet transfer from a sub-account to the main account
     * @param string $requestNo : UUID or other unique identifier, max length 64
     * @param string $amount : Transfer amount
     * @param string $currency : Currency (only USDT is supported)
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
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_CONTRACT_SUB_MAIN_SUB_TO_MAIN_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/account/contract/sub-account/main/v1/main-to-sub
     * Main-Account to Sub-Account (For Main Account) (SIGNED) - Futures wallet transfer from the main account to a sub-account
     * @param string $requestNo : UUID or other unique identifier, max length 64
     * @param string $amount : Transfer amount
     * @param string $currency : Currency (only USDT is supported)
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
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_CONTRACT_SUB_MAIN_MAIN_TO_SUB_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud-v2.bitmart.com/account/contract/sub-account/sub/v1/sub-to-main
     * Sub-Account to Main-Account (For Sub-Account) (SIGNED) - Futures wallet transfer from the sub-account to the main account
     * @param string $requestNo : UUID or other unique identifier, max length 64
     * @param string $amount : Transfer amount
     * @param string $currency : Currency (only USDT is supported)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function postSubToMainForSub(string $requestNo, string $amount, string $currency): array
    {
        $params = [
            'requestNo' => $requestNo,
            'amount' => $amount,
            'currency' => $currency,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_CONTRACT_SUB_SUB_TO_MAIN_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/account/contract/sub-account/main/v1/wallet
     * Get Contract Sub-Account Wallet (For Main Account) (KEYED) - Query a sub-account futures wallet balance
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
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_CONTRACT_SUB_MAIN_WALLET_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/account/contract/sub-account/main/v1/transfer-list
     * Get Contract Sub-Account Transfer History (For Main Account) (KEYED) - Query sub-account futures transfer records
     * @param string $subAccount : Sub-account username
     * @param int $limit : Number of latest records, allowed range [1,100]
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSubTransferList(string $subAccount, int $limit): array
    {
        $params = [
            'subAccount' => $subAccount,
            'limit' => $limit,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_CONTRACT_SUB_MAIN_TRANSFER_LIST_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud-v2.bitmart.com/account/contract/sub-account/v1/transfer-history
     * Get Contract Account Transfer History (For Main and Sub-Account) (KEYED) - Query account futures transfer records
     * @param int $limit : Number of latest records, allowed range [1,100]
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSubTransferHistory(int $limit): array
    {
        $params = [
            'limit' => $limit,
        ];
        return self::$cloudClient->request(CloudConst::API_ACCOUNT_CONTRACT_SUB_TRANSFER_HISTORY_URL, CloudConst::GET, $params, Auth::KEYED);
    }

}
