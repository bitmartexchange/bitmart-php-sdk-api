<?php


namespace BitMart\Finance;


use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;

/**
 * Finance (Savings / Earn) endpoints.
 *
 * Served from the V1 host (https://api-cloud.bitmart.com). Construct this class
 * with a CloudConfig pointing at CloudConst::API_URL_PRO (the default).
 */
class APIFinance
{
    static $cloudClient;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    // ----------- Finance Account

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/earn
     * Get Finance Account Holdings (KEYED) - Query the savings/earn account holdings
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getEarnAccount(): array
    {
        return self::$cloudClient->request(CloudConst::API_FINANCE_EARN_URL, CloudConst::GET, [], Auth::KEYED);
    }


    // ----------- Flexible Savings (活期)

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/saving/product
     * Get Flexible Savings Product List (KEYED)
     * @param int $currentPage : Current page number
     * @param int $sizePage : Records per page, max 100
     * @param array $options
     *  coinName : Filter by currency name (e.g. "USDT")
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSavingProducts(int $currentPage, int $sizePage, array $options = []): array
    {
        $params = array_merge(
            [
                'currentPage' => $currentPage,
                'sizePage' => $sizePage,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_PRODUCT_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/newearn/cloud/v1/saving/subscribe
     * Subscribe Flexible Savings (SIGNED)
     * @param string $productId : Product ID
     * @param string $amount : Subscribe amount
     * @param string $requestNo : Unique request number, 20-digit numeric, for idempotency
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function subscribeSaving(string $productId, string $amount, string $requestNo): array
    {
        $params = [
            'productId' => $productId,
            'amount' => $amount,
            'requestNo' => $requestNo,
        ];
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_SUBSCRIBE_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/newearn/cloud/v1/saving/redeem
     * Redeem Flexible Savings (SIGNED)
     * @param string $earnId : Earn order ID
     * @param string $amount : Redeem amount
     * @param string $requestNo : Unique request number, 20-digit numeric, for idempotency
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function redeemSaving(string $earnId, string $amount, string $requestNo): array
    {
        $params = [
            'earnId' => $earnId,
            'amount' => $amount,
            'requestNo' => $requestNo,
        ];
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_REDEEM_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/saving/earn
     * Get Flexible Savings Holdings (KEYED)
     * @param int $currentPage : Current page number
     * @param int $sizePage : Records per page, max 100
     * @param array $options
     *  coinName : Filter by currency name (e.g. "USDT")
     *  productId : Filter by product ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSavingHoldings(int $currentPage, int $sizePage, array $options = []): array
    {
        $params = array_merge(
            [
                'currentPage' => $currentPage,
                'sizePage' => $sizePage,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_EARN_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/saving/record
     * Get Flexible Savings History Records (KEYED)
     * @param string $type : Record type (subscribe/redeem/interest)
     * @param int $currentPage : Current page number
     * @param int $sizePage : Records per page, max 100
     * @param array $options
     *  startTime : Start time, millisecond timestamp
     *  endTime : End time, millisecond timestamp
     *  coinName : Filter by currency name (e.g. "USDT")
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSavingRecords(string $type, int $currentPage, int $sizePage, array $options = []): array
    {
        $params = array_merge(
            [
                'type' => $type,
                'currentPage' => $currentPage,
                'sizePage' => $sizePage,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_RECORD_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/newearn/cloud/v1/saving/subscribe/operate
     * Toggle Auto-Subscribe for a Flexible Product (SIGNED)
     * @param string $productId : Product ID
     * @param string $autoSubscribe : Auto-subscribe type (open/close)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function setSavingAutoSubscribe(string $productId, string $autoSubscribe): array
    {
        $params = [
            'productId' => $productId,
            'autoSubscribe' => $autoSubscribe,
        ];
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_SUBSCRIBE_OPERATE_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/saving/subscribe/status
     * Get Auto-Subscribe Status for a Flexible Product (KEYED)
     * @param string $productId : Product ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSavingAutoSubscribeStatus(string $productId): array
    {
        $params = [
            'productId' => $productId,
        ];
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_SUBSCRIBE_STATUS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/newearn/cloud/v1/saving/subscribe/batch/operate
     * Toggle Global Flexible Auto-Subscribe (SIGNED)
     * @param string $autoSubscribe : Auto-subscribe type (open/close)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function setSavingAutoSubscribeBatch(string $autoSubscribe): array
    {
        $params = [
            'autoSubscribe' => $autoSubscribe,
        ];
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_SUBSCRIBE_BATCH_OPERATE_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/saving/subscribe/batch
     * Get Global Flexible Auto-Subscribe Status (KEYED)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getSavingAutoSubscribeBatchStatus(): array
    {
        return self::$cloudClient->request(CloudConst::API_FINANCE_SAVING_SUBSCRIBE_BATCH_URL, CloudConst::GET, [], Auth::KEYED);
    }


    // ----------- Fixed Savings (定期)

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/saving/fixed/product
     * Get Fixed Savings Product List (KEYED)
     * @param int $currentPage : Current page number
     * @param int $sizePage : Records per page, max 100
     * @param array $options
     *  coinName : Filter by currency name (e.g. "USDT")
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getFixedProducts(int $currentPage, int $sizePage, array $options = []): array
    {
        $params = array_merge(
            [
                'currentPage' => $currentPage,
                'sizePage' => $sizePage,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_FINANCE_FIXED_PRODUCT_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/newearn/cloud/v1/saving/fixed/subscribe
     * Subscribe Fixed Savings (SIGNED)
     * @param string $productId : Product ID
     * @param string $amount : Subscribe amount
     * @param string $requestNo : Unique request number, 20-digit numeric, for idempotency
     * @param string $autoSubscribe : Auto-renewal type (OFF/REINVEST_FLEXIBLE/REINVEST_FIXED)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function subscribeFixed(string $productId, string $amount, string $requestNo, string $autoSubscribe): array
    {
        $params = [
            'productId' => $productId,
            'amount' => $amount,
            'requestNo' => $requestNo,
            'autoSubscribe' => $autoSubscribe,
        ];
        return self::$cloudClient->request(CloudConst::API_FINANCE_FIXED_SUBSCRIBE_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/saving/fixed/earn
     * Get Fixed Savings Holdings (KEYED)
     * @param int $currentPage : Current page number
     * @param int $sizePage : Records per page, max 100
     * @param array $options
     *  coinName : Filter by currency name (e.g. "USDT")
     *  productId : Filter by product ID
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getFixedHoldings(int $currentPage, int $sizePage, array $options = []): array
    {
        $params = array_merge(
            [
                'currentPage' => $currentPage,
                'sizePage' => $sizePage,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_FINANCE_FIXED_EARN_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/newearn/cloud/v1/saving/fixed/record
     * Get Fixed Savings History Records (KEYED)
     * @param string $type : Record type (subscribe/redeem/interest)
     * @param int $currentPage : Current page number
     * @param int $sizePage : Records per page, max 100
     * @param array $options
     *  startTime : Start time, millisecond timestamp
     *  endTime : End time, millisecond timestamp
     *  coinName : Filter by currency name (e.g. "USDT")
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getFixedRecords(string $type, int $currentPage, int $sizePage, array $options = []): array
    {
        $params = array_merge(
            [
                'type' => $type,
                'currentPage' => $currentPage,
                'sizePage' => $sizePage,
            ],
            $options
        );
        return self::$cloudClient->request(CloudConst::API_FINANCE_FIXED_RECORD_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/newearn/cloud/v1/saving/fixed/redeem
     * Early Redeem Fixed Savings (SIGNED)
     * @param string $earnId : Earn order ID
     * @param string $requestNo : Unique request number, 20-digit numeric, for idempotency
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function redeemFixed(string $earnId, string $requestNo): array
    {
        $params = [
            'earnId' => $earnId,
            'requestNo' => $requestNo,
        ];
        return self::$cloudClient->request(CloudConst::API_FINANCE_FIXED_REDEEM_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/newearn/cloud/v1/saving/fixed/subscribe/operate
     * Modify Fixed Savings Auto-Renewal (SIGNED)
     * @param string $earnId : Earn order ID
     * @param string $autoSubscribe : Auto-renewal type (OFF/REINVEST_FLEXIBLE/REINVEST_FIXED)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function modifyFixedAutoRenewal(string $earnId, string $autoSubscribe): array
    {
        $params = [
            'earnId' => $earnId,
            'autoSubscribe' => $autoSubscribe,
        ];
        return self::$cloudClient->request(CloudConst::API_FINANCE_FIXED_SUBSCRIBE_OPERATE_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

}
