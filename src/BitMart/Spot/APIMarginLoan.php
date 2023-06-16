<?php


namespace BitMart\Spot;




use BitMart\Auth;
use BitMart\CloudConst;
use BitMart\Lib\CloudClient;
use BitMart\Lib\CloudConfig;

class APIMarginLoan
{
    static $cloudClient ;

    public function __construct(CloudConfig $cloudConfig)
    {
        self::$cloudClient = new CloudClient($cloudConfig);
    }


    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/margin/isolated/borrow
     * Margin Borrow (Isolated) (SIGNED) - Applicable to isolated margin account borrowing operations
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $currency : Borrowing currency, selected according to the borrowing trading pair(like BTC or USDT)
     * @param $amount : Amount of borrowing (precision: 8 decimal places)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function marginIsolatedBorrow($symbol, $currency, $amount): array
    {
        $params = [
            'symbol' => $symbol,
            'currency' => $currency,
            'amount' => $amount,
        ];
        return self::$cloudClient->request(CloudConst::API_MARGIN_ISOLATED_BORROW_URL, CloudConst::POST, $params, Auth::SIGNED);
    }

    /**
     * url: POST https://api-cloud.bitmart.com/spot/v1/margin/isolated/repay
     * Margin Repay (Isolated) (SIGNED) - Applicable to isolated margin account repayment operations
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $currency : Borrowing currency, selected according to the borrowing trading pair(like BTC or USDT)
     * @param $amount : Amount of borrowing (precision: 8 decimal places)
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function marginIsolatedRepay($symbol, $currency, $amount): array
    {
        $params = [
            'symbol' => $symbol,
            'currency' => $currency,
            'amount' => $amount,
        ];
        return self::$cloudClient->request(CloudConst::API_MARGIN_ISOLATED_REPAY_URL, CloudConst::POST, $params, Auth::SIGNED);

    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/margin/isolated/borrow_record
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $borrowId : Borrow order id
     * @param $startTime : Query start time: Timestamp
     * @param $endTime : Query end time: Timestamp
     * @param $n : Query record size, allowed range[1-100]. Default is 50
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getMarginIsolatedBorrowRecord($symbol, $borrowId, $startTime, $endTime, $n): array
    {
        $params = [
            'symbol' => $symbol,
            'borrow_id' => $borrowId,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'N' => $n,
        ];
        return self::$cloudClient->request(CloudConst::API_MARGIN_ISOLATED_BORROW_RECORD_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/margin/isolated/repay_record
     * Get Repayment Record(Isolated) (KEYED) - Applicable to the inquiry of repayment records of isolated margin account
     * @param $symbol : Trading pair (e.g. BMX_USDT)
     * @param $repayId : Repayment ID
     * @param $currency : Currency
     * @param $startTime : Query start time: Timestamp
     * @param $endTime : Query end time: Timestamp
     * @param $n : Query record size, allowed range[1-100]. Default is 50
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getMarginIsolatedRepayRecord($symbol, $repayId, $currency, $startTime, $endTime, $n): array
    {
        $params = [
            'symbol' => $symbol,
            'repay_id' => $repayId,
            'currency' => $currency,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'N' => $n,
        ];
        return self::$cloudClient->request(CloudConst::API_MARGIN_ISOLATED_REPAY_RECORD_URL, CloudConst::GET, $params, Auth::KEYED);
    }

    /**
     * url: GET https://api-cloud.bitmart.com/spot/v1/margin/isolated/pairs
     * Get Trading Pair Borrowing Rate and Amount (KEYED) - Applicable for checking the borrowing rate and borrowing amount of trading pairs
     * @param $symbol : It can be multiple-choice; if not filled in, then return all, like BTC_USDT, ETH_USDT
     * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
     */
    public function getMarginLoanSymbol($symbol): array
    {
        $params = [
            'symbol' => $symbol,
        ];
        return self::$cloudClient->request(CloudConst::API_MARGIN_ISOLATED_PAIRS_URL, CloudConst::GET, $params, Auth::KEYED);
    }

}